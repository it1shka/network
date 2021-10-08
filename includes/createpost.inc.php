<?php

session_start();

function exit_with_error($error) {
  header("location: ../createpost.php?error=$error");
  exit();
}

function add_post(mysqli $conn,$title,$message,$auth_login,$auth_name) {
  $sql = "insert into posts(author_login,author_name,title,message)
  values (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss",$auth_login,$auth_name,$title,$message);
  $stmt->execute();
}

if(empty($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
  exit_with_error("mustbeloggedin");

if(isset($_POST["submit"])) {
  $title = trim($_POST["title"]);
  $message = trim($_POST["message"]);
  $author_login = $_SESSION["login"];
  $author_name = $_SESSION["name"];

  require_once "functions.inc.php";

  if(some_are_missing($title,$message,$author_login,$author_name))
    exit_with_error("emptyinput");
  
  require_once "db.inc.php";
  add_post($conn,$title,$message,$author_login,$author_name);
  exit_with_error("postsuccess");
} else header("location: ../createpost.php");