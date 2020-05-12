<?php 
require_once "modules_class.php";

class MessageContent extends Modules {
	
	private $message_title;
	private $message_text;
	
	public function __construct($db) {
       parent::__construct($db);
	   $this->message_title = $this->message->getTitle($_SESSION["page_message"]);
	   $this->message_text = $this->message->getText($_SESSION["page_message"]);
	}
	
	protected function getTitle() {
		return $this->message_title;
	}
	
	protected function getDescription() {
	  	return $this->message_text;
	}
	
	protected function getKeyWords() {
		return mb_strtolower($this->message_text);
	}
	
	protected function getMiddle() {
		$sr["title"] = $this->message_title;
		$sr["text"] = $this->message_text;
        return $this->getReplaceTemplate($sr, "message");
	}	
}
?>