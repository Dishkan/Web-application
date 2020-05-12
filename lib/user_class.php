<?php
require_once "global_class.php";
require_once "config_class.php";
  
  class User extends GlobalClass {
  private $db;
	  
	 public function __construct($db) {
		 parent::__construct("users", $db);
      $this->db = new mysqli($this->config->host, $this->config->user, $this->config->password, $this->config->db);
      $this->db->query("SET NAMES `utf8`"); 
	 }
	private function query($query) {
	    return $this->mysqli->query($query);
	}

	 
	 public function addUser($login, $password, $activation, $email, $regdate) {
		 if(!$this->checkValid($login, $password, $regdate)) return false;
		 return $this->add(array("login" => $login, "password" => $password, "regdate" => $regdate, "activation" => $activation, "email" => $email));
	 }

	public function checkUser($login, $password) { 
	  $result_set = $this->db->query("SELECT `password` FROM `lesson_users` WHERE `login`='$login'");	
	  $user = $result_set->fetch_assoc();
	  $result_set->close();
	  if (!$user) return false;
	  return $user["password"] === $password;
	}
	 

	 public function editUser($id, $login, $password, $regdate) {
		if (!$this->checkValid($login, $password, $regdate)) return false;		
	    return $this->edit($id, array("login" => $login, "password" => $password, "regdate" => $regdate));
	 }
	 
	 public function isExistsUser($login) { 
		 return $this->isExists("login", $login);
	 }
	 
	 public function getUserOnLogin($login){//Функция получения всех данных пользователей по логину
		 $id = $this->getField("id", "login", $login);
		 return $this->get($id);
	 }
	 
	 private function checkValid($login, $password, $regdate) {
		if (!$this->valid->validLogin($login)) return false;
		if (!$this->valid->validHash($password)) return false;
		if (!$this->valid->validTimeStamp($regdate)) return false;
		return true;
	 }
  }
?>