<?php

function exit_with_error($error) {
  header("location: ../login.php?error=$error");
  exit();
}

if(isset($_POST["submit"])) {
  $login = $_POST["login"];
  $password = $_POST["password"];

  require_once "functions.inc.php";

  if(some_are_missing($login, $password))
    exit_with_error("emptyinput");

  require_once "db.inc.php";
  
  $user_data = pull_user_info_by_login($conn, $login);
  if(empty($user_data))
    exit_with_error("nosuchlogin");
  
  $hashed_pwd = $user_data["password"];
  if(!password_verify($password, $hashed_pwd)) {
    exit_with_error("wrongpassword");
  }

  // finally we can login our user

  login_user($login);
  header("location: ../index.php");

} else {
  header("location: ../login.php");
}
