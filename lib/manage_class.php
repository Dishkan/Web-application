<?php 
require_once "config_class.php";
require_once "user_class.php";
require_once "poll_class.php";
require_once "pollvariant_class.php";

class Manage {
	
private $config;
private $user;
private $data;
private $db;
public function __construct($db) {
	    session_start();
        $this->config =	new Config();
        $this->user = new User($db);
        $this->poll = new Poll($db);
        $this->poll_variant = new PollVariant($db);		
		$this->data = $this->secureData(array_merge($_POST, $_GET));
      $this->db = new mysqli($this->config->host, $this->config->user, $this->config->password, $this->config->db);
      $this->db->query("SET NAMES `utf8`"); 
	}
	private function query($query) {
	    return $this->mysqli->query($query);
	}
    private function secureData($data) {  //Проверка и изменения всех входящих данных
	   foreach($data as $key => $value) {
	      if (is_array($value)) $this->secureData($value);
          else $data[$key] = htmlspecialchars($value);		  
	   }
	   return $data;
   }
   
   public function redirect($link){
      header("Location: $link");
	   exit;
   }
   ///////////////////////////////////////////////////////////////////////////////////////////////////
   public function regUser(){
	 $link_reg = $this->config->address."?view=reg";
	 $captcha = $this->data["captcha"];
     if (($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")) {
		 return $this->returnMessage("ERROR_CAPTCHA", $link_reg);
	 }	
     $login = $this->data["login"];
	 $activation = $this->getActivateLink($login);
	 $key = $_GET["key"];
	 $email = $this->data["email"];
   if(!preg_match("/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9-]+)*\.)+[a-z]+/i", $email))
   {
     return $this->returnMessage("ERROR_EMAIL", $link_reg);       
   }
	 if ($login == "") return $this->returnMessage("EXISTSS_LOGIN", $link_reg);
	 $password = $this->data["password"];
	 if ($password == "") return $this->returnMessage("EXISTS_PASSWORD", $link_reg);
	 $password = $this->hashPassword($password);
	 $result = $this->user->addUser($login, $password, $activation, $email, time());
	 mail("$login@mail.ru", "Регистрация на сайте", "http://test.local/act.php?login=$login&key=$activation");
     if ($result) return $this->returnPageMessage("SUCCESS_REG", $this->config->address."?view=message");
	 if ($this->user->isExistsUser($login)) return $this->returnMessage("EXISTS_LOGIN", $link_reg);
	 else return $this->unknownError($link_reg);
///////////////////////////////////////////////////////////////// 
   }
   
  public function setPassword($login, $password){
   if(($login == "")&&($password == "")) return false;
   $updatepass = $this->db->query("UPDATE `lesson_users` SET `password`='$password' WHERE `login` = '$login'"); 
  }
   
  public function getPageToUpdatePass() {
       $link_update = $this->config->address."?view=password";
 	   $email = $this->data["email"];
   if(!preg_match("/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9-]+)*\.)+[a-z]+/i", $email))
   {
     return $this->returnMessage("ERROR_EMAIL", $link_update);       
   }
	   $login = $this->getLoginOnEmail($email); 
	   $new_password = substr(md5(time()), 0, 6);
	   $this->setPassword($login, $this->hashPassword($new_password));
	   $to = $email;
	   $from = "dishkan.com";
     $subject = "Ваш новый пароль"; 
	 $subject = "?windows-1251?B?".base64_encode($subject)."?=";
	 $headers = "From: $from\r\nReply-to: $from\r\nContent-type: text/plain; charset=windows1251\r\n";
	 $message = "Ваш новый пароль: $new_password";
	 mail($to, $subject, $message, $headers);
	 $success = true;
	 if($success){
	     return $this->returnMessage("SUCCESS_UPDATEPASS", $link_update); 
	 }
  }
   
  public function getLoginOnEmail($email){
 $result_set = $this->db->query("SELECT `login` FROM `lesson_users` WHERE `email` = '$email'"); 
 $row = $result_set->fetch_assoc(); 
 $result_set->close();
 if ($this->mysqli) $this->mysqli->close();
 return $row["login"];
 }

public function showUser() {
	 $link_reg = $this->config->address."?view=reg";	
	 
     if($_SESSION['success_act'] == 1){
 return $this->returnMessage("SUCCESS_ACT", $link_reg);   
 unset($_SESSION['success_act']);
     } 
	 
   if($_SESSION['error_act'] == 1) {
 return $this->returnMessage("ERROR_ACT", $link_reg);
 unset($_SESSION['error_act']);
     }  
	 
   }

   public function getActivateLinkFromTable($login){
 $result_set = $this->db->query("SELECT `activation` FROM `lesson_users` WHERE `login` = '$login'"); 
 $row = $result_set->fetch_assoc(); 
 $result_set->close();
if ($this->mysqli) $this->mysqli->close();	
 return $row["activation"];
   }

   public function checkActivateLink($login, $key){
   $real_key = $this->getActivateLinkFromTable($login);
   return $real_key === $key;
   }
   
   public function activateUser($login) {
 $update = $this->db->query("UPDATE `lesson_users` SET `activation`='' WHERE `login` = '$login'");
   }
   
   public function getActivateLink($login) {
   $secret = "billion";
   return md5($secret.$login);
   } 
   
 
      public function login() {
	  $login = $this->data["login"];
	  $password = $this->data["password"];
	  $password = $this->hashPassword($password);
	  $r = $_SERVER["HTTP_REFERER"];
      if ($this->user->checkUser($login, $password)) {
		   session_start();
		   $_SESSION["login"] = $login;
		   $_SESSION["password"] = $password;
		   return $r;
		     }
	  else {
		  $_SESSION["error_auth"] = 1;
		  return $r;
	  }
   }
   
   public function logout() {
   unset($_SESSION["login"]);
   unset($_SESSION["password"]);
   return $_SERVER["HTTP_REFERER"];
   }
   
    public function poll() {
	   $id = $this->data["variant"];
	   $variant = $this->poll_variant->get($id);
	   $poll_id = $variant["poll_id"];
	   $this->poll_variant->setVotes($id, $variant["votes"] + 1);
	   return $this->config->address."?view=poll&id=$poll_id";
   }  
   
   private function hashPassword($password) {
	 return md5($password.$this->config->secret);  
   }
   
   private function unknownError($r) {
	   return $this->returnMessage("UNKNOWN_ERROR", $r);
   }
	
   private function returnMessage($message, $r) {
	   $_SESSION["message"] = $message;
	   return $r;
   }
   
   private function returnPageMessage($message, $r) {
	   $_SESSION["page_message"] = $message;
	   return $r;
   }
}
?>