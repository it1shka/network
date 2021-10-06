<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "mysql";
$database = "network";

$conn = new mysqli($db_host, $db_user, $db_password, $database);

if($conn === false) {
  die("DB Connection Failed.");
}