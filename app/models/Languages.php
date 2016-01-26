<?php
namespace reportingtool\Models;

class Languages extends \Phalcon\Mvc\Model{
	/**
     * @var integer
     */
    public $uid;

    /**
     * @var integer
     */
    public $pid;

	/**
	 * @var integer
	 */
	public $tstamp;
	
	/**
	 * @var integer
	 */
	public $crdate;
	
	/**
	 * @var integer
	 */
	public $cruser_id;
	
	/**
	 * @var integer
	 */
	public $deleted;
	
	/**
	 * @var integer
	 */
	public $hidden;
	
	/*
	 * @var string
	 */
	public $title;
	
	/*
	 * @var string
	 */
	
	public $shorttitle;
	public function getUid() {
		return $this->uid;
	}

	public function setUid($uid) {
		$this->uid = $uid;
	}

	public function getPid() {
		return $this->pid;
	}

	public function setPid($pid) {
		$this->pid = $pid;
	}

	public function getTstamp() {
		return $this->tstamp;
	}

	public function setTstamp($tstamp) {
		$this->tstamp = $tstamp;
	}

	public function getCrdate() {
		return $this->crdate;
	}

	public function setCrdate($crdate) {
		$this->crdate = $crdate;
	}

	public function getCruser_id() {
		return $this->cruser_id;
	}

	public function setCruser_id($cruser_id) {
		$this->cruser_id = $cruser_id;
	}

	public function getDeleted() {
		return $this->deleted;
	}

	public function setDeleted($deleted) {
		$this->deleted = $deleted;
	}

	public function getHidden() {
		return $this->hidden;
	}

	public function setHidden($hidden) {
		$this->hidden = $hidden;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getShorttitle() {
		return $this->shorttitle;
	}

	public function setShorttitle($shorttitle) {
		$this->shorttitle = $shorttitle;
	}


}