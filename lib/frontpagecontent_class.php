<?php
require_once "modules_class.php";

	class FrontPageContent extends Modules {
	
	private $articles;
	private $page;

	public function __construct($db) {
       parent::__construct($db);
	   $this->articles = $this->article->getAllSortDate();
	   $this->page = (isset($this->data["page"]))? $this->data["page"]: 1;
	}
	
	protected function getTitle() {
		if ($this->page > 1) return "Dishkan - Page ".$this->page;
		else 
	    return "Dishkan";
	}
	
	protected function getDescription() {
	  	return "Справочник функции по PHP";
	}
	
	protected function getKeywords() {
		return "справочник php, справочник php функции";
	}
	
	protected function getTop() {
		return $this->getTemplate("main_article");
	}
	
	protected function getMiddle() {
		return $this->getBlogArticles($this->articles, $this->page);
	}
	
	protected function getBottom() {
		return $this->getPagination(count($this->articles), $this->config->count_blog, $this->config->address);//пармаметры страницы ($count, $count_on_page, $link)
	}
}

?>