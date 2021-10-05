<?php

$host = "localhost";
$user = "root";
$password = "mysql";
$database = "network";

$conn = new mysqli($host, $user, $password, $database);

if($conn === false) {
  die("DB Connection Failed.");
}