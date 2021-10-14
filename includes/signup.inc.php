<?php

require_once "functions.inc.php";

if(isset($_POST["submit"])) {

  $name = $_POST["name"];
  $login = $_POST["login"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];

  if(some_are_missing($name,$login,$password,$confirm_password))
    exit_with_error("emptyinput", "../signup.php");
  
  if(invalid_name($name))
    exit_with_error("invalidname", "../signup.php");
  
  if(invalid_login($login))
    exit_with_error("invalidlogin", "../signup.php");
  
  if(invalid_password($password))
    exit_with_error("invalidpassword", "../signup.php");
  
  if(not_confirmed($password,$confirm_password))
    exit_with_error("invalidconfirm", "../signup.php");
  
  // time to check if login already exists

  require_once "db.inc.php";

  if(login_already_exists($conn, $login))
    exit_with_error("loginistaken", "../signup.php");
  
  // so, now we re ready to actually sign up

  sign_up_user($conn, $name, $login, $password);
  
  exit_with_error("success", "../signup.php");
} else header("location: ../signup.php");