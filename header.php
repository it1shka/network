<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Соцсеть</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">

  </head>

  <body>
    <div class="page">
    <header class="header">
      <h1>Моя Соцсеть</h1> 
      <nav>
        <ul class="nav">
          <li><a href="index.php">О проекте</a></li>
          <li><a href="posts.php">Посты</a></li>
          <li><a href="members.php">Участники</a></li>
          <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
          <li><a href="userprofile.php">Мой профиль</a></li>
          <?php } else { ?>
          <li><a href="login.php">Войти</a></li>
          <?php }?>
        </ul>
      </nav>
    </header>

    <div class="container">
    <main>