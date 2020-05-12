<?php
require_once "modules_class.php";

class SearchContent extends Modules {
	
	private $words;

	public function __construct($db) {
       parent::__construct($db);
	   $this->words = $this->data["words"];
	}
	
	protected function getTitle() {
		return "Результаты поиска: ".$this->words;
	}
	
	protected function getDescription() {
	  	return $this->words;
	}
	
	protected function getKeyWords() {
		return mb_strtolower($this->words);
	}
	
	protected function getMiddle() {
         $results = $this->article->searchArticles($this->words);
		 if ($results === false) return $this->getTemplate("search_notfound");
		 for ($i = 0; $i < count($results); $i++) {
		 $sr["link"] = $this->config->address."?view=article&amp;id=".$results[$i]["id"];
		 $sr["full_text"] = $results[$i]["full_text"];
		 $sr["title"] = $results[$i]["title"];
		 $text .= $this->getReplaceTemplate($sr, "search_item");
		 }
      $new_sr{"search_items"} = $text;
	  return $this->getReplaceTemplate($new_sr, "search_result");
	}
	

}
?>