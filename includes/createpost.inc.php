<?php

session_start();

require_once "functions.inc.php";

if(empty($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
  exit_with_error("mustbeloggedin", "../createpost.php");

if(isset($_POST["submit"])) {
  $title = trim($_POST["title"]);
  $message = trim($_POST["message"]);
  $author_login = $_SESSION["login"];
  $author_name = $_SESSION["name"];

  if(some_are_missing($title,$message,$author_login,$author_name))
    exit_with_error("emptyinput", "../createpost.php");
  
  require_once "db.inc.php";
  add_post($conn,$title,$message,$author_login,$author_name);
  exit_with_error("postsuccess", "../createpost.php");
} else header("location: ../createpost.php");