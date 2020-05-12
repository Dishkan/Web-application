<?php
require_once "modules_class.php";

class GetPassContent extends Modules {
	
	public function __construct($db) {
       parent::__construct($db);
	}
	
	protected function getTitle() {
		return "Восстановления пароля";
	}
	
	protected function getDescription() {
	  	return "Восстановления пароля.";
	}
	
	protected function getKeyWords() {
		return "Восстановления пароля, восстановления пароля пользователя";
	}
	
	protected function getMiddle(){
		$sr["message"] = $this->getMessage();
        return $this->getReplaceTemplate($sr, "form_getpass");
	}	
}
?>