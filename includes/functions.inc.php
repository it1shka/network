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

// additional functions

function db_count(mysqli $conn, $dbname) {
  $sql = "select count(*) from $dbname;";
  $result = $conn->query($sql);
  $total = ($result->fetch_array())[0];
  return $total;
}

function db_grab(mysqli $conn, $dbname, $start, $amount) {
  $sql = "select * from $dbname limit $start, $amount";
  $result = $conn->query($sql);
  $results = $result->fetch_all(MYSQLI_ASSOC);
  return $results;
}

function render_post($post) {
  $title = $post["title"];
  $message = $post["message"];
  $author_login = $post["author_login"];
  $author_name = $post["author_name"];
  echo "<section class=\"section post\">";
  echo "<a href=\"#\">$author_name @$author_login</a>";
  echo "<h2>$title</h2>";
  echo "<p>$message</p>";
  echo "</section>";
}

function render_pagination($page, $per_page, $count, $link) {
  echo "<ul class=\"section pagination\">Страницы:";
  for($current_page = $page - 2; $current_page <= $page + 2; $current_page++) {
    $current_start = $current_page * $per_page;
    if($current_start < 0 || $current_start >= $count) continue;
    echo "<li><a href=\"$link.php?page=$current_page\">$current_page</a></li>";
  }
  echo "</ul>";
}
