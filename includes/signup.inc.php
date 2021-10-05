<?php

function exit_with_error($error) {
  header("location: ../signup.php?error=$error");
  exit();
}

if(isset($_POST["submit"])) {

  $name = $_POST["name"];
  $login = $_POST["login"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];

  require_once "functions.inc.php";

  if(some_are_missing($name,$login,$password,$confirm_password))
    exit_with_error("emptyinput");
  
  if(invalid_name($name))
    exit_with_error("invalidname");
  
  if(invalid_login($login))
    exit_with_error("invalidlogin");
  
  if(invalid_password($password))
    exit_with_error("invalidpassword");
  
  if(not_confirmed($password,$confirm_password))
    exit_with_error("invalidconfirm");
  
  // time to check if login already exists

  require_once "db.inc.php";

  if(login_already_exists($conn, $login))
    exit_with_error("loginistaken");
  
  // so, now we re ready to actually sign up

  sign_up_user($conn, $name, $login, $password);
  
  exit_with_error("success");
} else header("location: ../signup.php");