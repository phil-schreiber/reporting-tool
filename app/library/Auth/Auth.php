<?php
namespace reportingtool\Auth;

use Phalcon\Mvc\User\Component;
use reportingtool\Models\Feusers,
	reportingtool\Models\Successlogins,
	reportingtool\Models\Failedlogins,
	reportingtool\Modules\Modules\Frontend\Controllers\ControllerBase as controllerBase;
//use reportingtool\Models\RememberTokens;


/**
 * Vokuro\Auth\Auth
 * Manages Authentication/Identity Management in Vokuro
 */
class Auth extends Component
{

    /**
     * Checks the user credentials
     *
     * @param array $credentials
     * @return boolan
     */
    public function check($credentials)
    {	
		

        // Check if the user exist
        $user = Feusers::findFirstByEmail($credentials['username']);
        if ($user == false) {
            $this->registerUserThrottling(0);
            throw new Exception('Wrong email/password combination');
        }

        // Check the password
		//$this->security->checkHash($credentials['password'], $user->password)
        if ($this->checkPassword($user->password,$credentials['password'])) {
            
			$this->_registerSession($user);
					
            $this->flashSession->success(controllerBase::translate('welcome').' '.$user->username);
				
				
                //Forward to the 'invoices' controller if the user is valid
				
            
				
			// Check if the user was flagged
			$this->checkUserFlags($user);

			// Register the successful login
			$this->saveSuccessLogin($user);

			// Check if the remember me was selected
			if (isset($credentials['remember'])) {
				$this->createRememberEnviroment($user);
			}

			
			$this->response->redirect(""); 
			$this->view->disable(); 
		}else{
			$this->registerUserThrottling($user->uid);
			$this->flash->error('Wrong email/password');
            //throw new Exception('Wrong email/password combination');
		}

        
    }
	
	private function _registerSession($user)
    {
            
        
        
        $this->session->set('auth', array(
            'uid' => $user->uid,            
			'username' => $user->username,
			'identity' => true,
			'superuser' =>$user->superuser,
			'profile' =>$user->getProfile()->title,
			'usergroup' =>$user->usergroup,
        ));
    }
	
	private function checkPassword($hash, $password) {
	
    // first 29 characters include algorithm, cost and salt
    // let's call it $full_salt
    $full_salt = substr($hash, 0, 29);
 
    // run the hash function on $password
    $new_hash = crypt($password, $full_salt);
	
    // returns true or false
    return ($hash == $new_hash);
	}

    /**
     * Creates the remember me environment settings the related cookies and generating tokens
     *
     * @param reportingtool\Models\Feusers $user
     */
    public function saveSuccessLogin($user)
    {
        $successLogin = new Successlogins();
        $successLogin->userid = $user->uid;
        $successLogin->ipaddress = $this->request->getClientAddress();
        $successLogin->useragent = $this->request->getUserAgent();
		
		$successLogin->crdate = time();
		$successLogin->useragent = $_SERVER['HTTP_USER_AGENT'];
        if (!$successLogin->save()) {
            $messages = $successLogin->getMessages();
            throw new Exception($messages[0]);
        }
    }

    /**
     * Implements login throttling
     * Reduces the efectiveness of brute force attacks
     *
     * @param int $userid
     */
    public function registerUserThrottling($userid)
    {
		
        $failedLogin = new Failedlogins();
        $failedLogin->userid = $userid;		
        $failedLogin->ipaddress = $this->request->getClientAddress();
        $failedLogin->attempted = time();
		$failedLogin->crdate = time();
		$failedLogin->useragent = $_SERVER['HTTP_USER_AGENT'];
		
		
        $attempts = Failedlogins::count(array(
            'ipaddress = ?0 AND attempted >= ?1',
            'bind' => array(
                $this->request->getClientAddress(),
                time() - 3600 * 6
            )
        ));

        switch ($attempts) {
            case 1:
            case 2:
                // no delay
                break;
            case 3:
            case 4:
                sleep(2);
                break;
            default:
                sleep(4);
                break;
        }
    }

    /**
     * Creates the remember me environment settings the related cookies and generating tokens
     *
     * @param Vokuro\Models\Users $user
     */
    public function createRememberEnviroment(Users $user)
    {
        $userAgent = $this->request->getUserAgent();
        $token = md5($user->email . $user->password . $userAgent);

        $remember = new RememberTokens();
        $remember->usersId = $user->id;
        $remember->token = $token;
        $remember->userAgent = $userAgent;

        if ($remember->save() != false) {
            $expire = time() + 86400 * 8;
            $this->cookies->set('RMU', $user->id, $expire);
            $this->cookies->set('RMT', $token, $expire);
        }
    }

    /**
     * Check if the session has a remember me cookie
     *
     * @return boolean
     */
    public function hasRememberMe()
    {
        return $this->cookies->has('RMU');
    }

    /**
     * Logs on using the information in the coookies
     *
     * @return Phalcon\Http\Response
     */
    public function loginWithRememberMe()
    {
        $userId = $this->cookies->get('RMU')->getValue();
        $cookieToken = $this->cookies->get('RMT')->getValue();

        $user = Feusers::findFirstById($userId);
        if ($user) {

            $userAgent = $this->request->getUserAgent();
            $token = md5($user->email . $user->password . $userAgent);

            if ($cookieToken == $token) {

                $remember = RememberTokens::findFirst(array(
                    'usersId = ?0 AND token = ?1',
                    'bind' => array(
                        $user->id,
                        $token
                    )
                ));
                if ($remember) {

                    // Check if the cookie has not expired
                    if ((time() - (86400 * 8)) < $remember->createdAt) {

                        // Check if the user was flagged
                        $this->checkUserFlags($user);

                        // Register identity
                        $this->session->set('auth', array(
                            'uid' => $user->id,
                            'username' => $user->name,
                            'profile' => $user->profile->name
                        ));

                        // Register the successful login
                        $this->saveSuccessLogin($user);

                        return $this->response->redirect('users');
                    }
                }
            }
        }

        $this->cookies->get('RMU')->delete();
        $this->cookies->get('RMT')->delete();

        return $this->response->redirect('session/login');
    }

    /**
     * Checks if the user is banned/inactive/suspended
     *
     * @param Vokuro\Models\Feusers $user
     */
    public function checkUserFlags(Feusers $user)
    {
        if ($user->hidden != 0) {
            throw new Exception('The user is inactive');
        }

        
    }

    /**
     * Returns the current identity
     *
     * @return array
     */
    public function getIdentity()
    {
        return $this->session->get('auth');
    }

    /**
     * Returns the current identity
     *
     * @return string
     */
    public function getName()
    {
        $identity = $this->session->get('auth');
        return $identity['name'];
    }

    /**
     * Removes the user identity information from session
     */
    public function remove()
    {
        if ($this->cookies->has('RMU')) {
            $this->cookies->get('RMU')->delete();
        }
        if ($this->cookies->has('RMT')) {
            $this->cookies->get('RMT')->delete();
        }

        $this->session->remove('auth');
    }

    /**
     * Auths the user by his/her id
     *
     * @param int $id
     */
    public function authUserById($id)
    {
        $user = Feusers::findFirstById($id);
        if ($user == false) {
            throw new Exception('The user does not exist');
        }

        $this->checkUserFlags($user);

        $this->session->set('auth', array(
            'uid' => $user->id,
            'username' => $user->name,
            'profile' => $user->profile->name
        ));
    }

    
}