<?php

// signup functions

function some_are_missing(...$args) {
  foreach($args as $arg)
    if(empty(trim($arg))) return true;
  return false;
}

function invalid_name($name) {
  return !preg_match('/^[a-zA-Z]{4,16}$/', $name);
}

function invalid_login($login) {
  return !preg_match('/^[a-zA-Z0-9]{4,16}$/', $login);
}

function invalid_password($password) {
  if(strlen($password) < 8)
    return true;
  $upper = preg_match('/[A-Z]/', $password);
  $lower = preg_match('/[a-z]/', $password);
  $number = preg_match('/[0-9]/', $password);
  $spec = preg_match('/[^\w]/', $password);

  return (!$upper || !$lower || !$number || !$spec);
}

function not_confirmed($password, $confirm) {
  return $password != $confirm;
}

// db function

function pull_user_info_by_login(mysqli $conn, $login) {
  $sql = "select * from users where login = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $login);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->fetch_assoc();
}

function login_already_exists($conn, $login) {
  $data = pull_user_info_by_login($conn, $login);
  return !empty($data);
}

// main sign up function

function sign_up_user(mysqli $conn, $name,$login,$password) {
  $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
  $sql = "insert into users values(?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $name,$login,$hashed_pwd);
  $stmt->execute();
}

function login_user($data) {
  session_start();
  $_SESSION["loggedin"] = true;
  $_SESSION["login"] = $data["login"];
  $_SESSION["name"] = $data["name"];
}
