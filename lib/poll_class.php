<?php
require_once "global_class.php";
  
  class Poll extends GlobalClass {
	 public function __construct($db) {
		 parent::__construct("poll", $db);
	 }
  }
?>