<?php
require_once "globalmessage_class.php";

  class Email extends GlobalMessage {
	  
	  public function __construct() {
		  parent::__construct("emails");
	  }
  }

?>