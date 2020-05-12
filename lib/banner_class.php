<?php
  require_once "global_class.php";
  
  class Banner extends GlobalClass {
	  
	 public function __construct($db) {
		 parent::__construct("banners", $db);
	 }
  }
?>