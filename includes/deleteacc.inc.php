<?php
session_start();

require_once "functions.inc.php";

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["login"])) {
  include_once "db.inc.php";
  delete_account($conn, $_SESSION["login"]);
}

session_destroy();
$_SESSION = array();

header("location: ../signup.php?error=accdeleted");