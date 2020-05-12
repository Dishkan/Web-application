<?php
require_once "modules_class.php";

class PollContent extends Modules {
	
	private $poll_info;

	public function __construct($db) {
       parent::__construct($db);
	   $this->poll_info = $this->poll->get($this->data["id"]);
	    if(!$this->poll_info) $this->notfound();
	}
	
	protected function getTitle() {
		return "Результаты голосования: ".$this->poll_info["title"];
	}
	
	protected function getDescription() {
	  	return $this->poll_info["title"];
	}
	
	protected function getKeyWords() {
		return mb_strtolower($this->poll_info["title"]);
	}
	
	protected function getMiddle() {
         $variants = $this->poll_variant->getAllOnPollID($this->poll_info["id"]);
		 for ($i = 0; $i < count($variants); $i++){
			 $sr["title"] = $variants[$i]["title"];
			 $sr["votes"] = $variants[$i]["votes"];
			 $text .= $this->getReplaceTemplate($sr, "poll_item");
		 }
		 $new_sr["items"] = $text;
		 return $this->getReplaceTemplate($new_sr, "poll_result");
	}
}
?>