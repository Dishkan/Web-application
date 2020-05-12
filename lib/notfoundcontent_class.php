<?php
require_once "modules_class.php";

class NotFoundContent extends Modules {
	

	public function __construct($db) {
       parent::__construct($db);
	   header("HTTP/1.0 404 Not Found");
	}
	
	protected function getTitle() {
		return "Страница не найдено - 404";
	}
	
	protected function getDescription() {
	  	return "Запрошенная страница не существуетю";
	}
	
	protected function getKeyWords() {
		return "Страница не найдена, страница не существует, 404";
	}
	
	protected function getMiddle() {
        return $this->getTemplate("notfound");
	}
	

}
?>