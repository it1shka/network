<?php

require_once "functions.inc.php";

if(isset($_POST["submit"])) {
  $login = $_POST["login"];
  $password = $_POST["password"];


  if(some_are_missing($login, $password))
    exit_with_error("emptyinput", "../login.php");

  require_once "db.inc.php";
  
  $user_data = pull_user_info_by_login($conn, $login);
  if(empty($user_data))
    exit_with_error("nosuchlogin", "../login.php");
  
  $hashed_pwd = $user_data["password"];
  if(!password_verify($password, $hashed_pwd)) {
    exit_with_error("wrongpassword", "../login.php");
  }

  // finally we can login our user

  login_user($user_data);
  header("location: ../index.php");

} else {
  header("location: ../login.php");
}
