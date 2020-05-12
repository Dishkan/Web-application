<?php
require_once "lib/database_class.php";
require_once "lib/manage_class.php";

   $db = new DataBase();
   $manage = new Manage($db);
   
 $login = $_GET["login"];
 $key = $_GET["key"];
 if($manage->checkActivateLink($login, $key)) {
   $manage->activateUser($login);
   $_SESSION['success_act'] = 1;
 }
 else {
 $_SESSION['error_act'] = 1;
 $r = $manage->showUser();
 }
 
  $manage->redirect($r);
?>