<?php
require_once "modules_class.php";

	class SectionContent extends Modules {
	
	private $articles;
	private $section_info;
	private $page;

	public function __construct($db) {
       parent::__construct($db);
	   $this->articles = $this->article->getAllOnSectionID($this->data["id"]);
	   $this->section_info = $this->section->get($this->data["id"]);
	   if(!$this->section_info) $this->notFound();
	   $this->page = (isset($this->data["page"]))? $this->data["page"]: 1;
	}
	
	protected function getTitle() {
		if ($this->page > 1) return $this->section_info["title"]." - Страница".$this->page;
		else return $this->section_info["title"];
	}
	
	protected function getDescription() {
	  	return $this->section_info["meta_desc"];
	}
	
	protected function getKeyWords() {
		return $this->section_info["meta_key"];
	}
	
	protected function getTop() {
		$sr["title"] = $this->section_info["title"];
		$sr["description"] = $this->section_info["description"];
		return $this->getReplaceTemplate($sr, "section");
	}
	
	protected function getMiddle() {
		return $this->getBlogArticles($this->articles, $this->page);
	}
	
	protected function getBottom() {
		return $this->getPagination(count($this->articles), $this->config->count_blog, $this->config->address."?view=section&amp;id=".$this->data["id"]);
	}
}

?>