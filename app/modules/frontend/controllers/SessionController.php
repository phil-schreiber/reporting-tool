<?php
namespace reportingtool\Modules\Modules\Frontend\Controllers;
use Phalcon\Tag as Tag;
use reportingtool\Models\Feusers as Feusers,
	reportingtool\Auth\Exception as AuthException;
class SessionController extends ControllerBase
{
	private $_loginForm;
	
	public function initialize()
	{
	$this->_loginForm = new LoginForm();
	Tag::setTitle('Sign Up/Sign In');
        parent::initialize();
        
        
        
    
	}

	public function indexAction(){
		$this->view->form = $this->_loginForm;
	}

    

	public function startAction()
	{
		
		if ($this->request->isPost()) {
			
			try {				
				$this->auth->check(array(
					'username' => $this->request->getPost('username'),
					'password' => $this->request->getPost('password')

				));
				if($this->request->getPost('redirect') != ''){
					$this->response->redirect($this->request->getPost('redirect')); 
				}else{
					$this->response->redirect(""); 
				}
                
				$this->view->disable();                            
			} catch (AuthException $e) {
				$this->flash->error($e->getMessage());
				
			}
		}
		
	}
	
	
    public function oldstartAction()
    {
		$request=$this->request;
        if ($this->request->isPost()) {

            //Receiving the variables sent by POST
            $email = $this->request->getPost('username', 'email');
            $rawpassword = $this->request->getPost('password');
			

            
            //Find the user in the database
            $feusers = Feusers::findFirst(array(
                "email = :email: AND deleted=0 AND hidden=0",
                "bind" => array('email' => $email)
            ));
	
			$checkedPasswords=$this->checkPassword($feusers->password, $rawpassword);
            if ($checkedPasswords != false) {

                $this->_registerSession($feusers);
					
                $this->flashSession->success($this->translate('welcome').$feusers->username);
				
				
                //Forward to the 'invoices' controller if the user is valid
				
                $this->response->redirect(""); 
				$this->view->disable(); 
            }else{

            $this->flash->error('Wrong email/password');
			}
        }

        return $this->forward('session/index');

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
	
	
	public function logoutAction()
    {
        //Destroy the whole session
		$this->flashSession->success($this->translate('logout'));
        $this->session->destroy();
		$this->response->redirect(""); 
				$this->view->disable(); 
    }
	
}