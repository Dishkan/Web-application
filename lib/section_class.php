<?php
require_once "global_class.php";
  
  class Section extends GlobalClass {
	 public function __construct($db) {
		 parent::__construct("sections", $db);
	 }
  }
?>