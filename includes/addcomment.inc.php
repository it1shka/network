<?php

session_start();

require_once "functions.inc.php";
require_once "db.inc.php";


$post_id = $_POST["postid"];

if(empty($_POST["submit"])) {
  header("location: ../post.php?postid=$post_id");
  exit();
}

if(empty(grab_post_with_id($conn, $post_id))) {
  header("location: ../post.php?postid=$post_id");
  exit();
}

if($_SESSION["loggedin"] !== true) {
  exit_with_error("mustbeloggedin", "../post.php");
}

$author_name = $_SESSION["name"];
$message = $_POST["message"];

add_comment($conn, $post_id, $author_name, $message);

header("location: ../post.php?error=postsuccess&postid=$post_id");