<?php
require_once "global_class.php";
  
  class PollVariant extends GlobalClass {
	 public function __construct($db) {
		 parent::__construct("poll_variants", $db);
	 }
	 
	 public function getAllOnPollID($poll_id){
		 return $this->getAllOnField("poll_id", $poll_id);
	 }
	 
	 public function setVotes($id, $votes) {
		if (!$this->valid->validVotes($votes)) return false;
        return $this->setFieldOnID($id, "votes", $votes);		
	 }
  }
?>