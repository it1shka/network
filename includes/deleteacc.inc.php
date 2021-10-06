<?php
session_start();

function delete_account(mysqli $conn, $login) {
  $sql = "delete from users where login = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $login);
  $stmt->execute();
}

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["login"])) {
  include_once "db.inc.php";
  delete_account($conn, $_SESSION["login"]);
}

session_destroy();
$_SESSION = array();

header("location: ../signup.php?error=accdeleted");