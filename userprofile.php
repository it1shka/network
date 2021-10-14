<?php include_once "header.php" ?>

<?php

require_once "includes/functions.inc.php";

$userlogin = $_GET["userlogin"];
if(empty($userlogin) && $_SESSION["loggedin"] === true)
  $userlogin = $_SESSION["login"];
if(empty($userlogin))
  exit_with_error("emptyuser", "members.php");

require_once "includes/db.inc.php";

$user_info = pull_user_info_by_login($conn, $userlogin);
if(empty($user_info))
  exit_with_error("invaliduser", "members.php");
?>

<section class="section">
  <h1 class="colored"><?=$user_info["name"]?></h1>
  <h2>Логин: @<?=$user_info["login"]?></h2>
  <?php if($_SESSION["loggedin"] === true && $_SESSION["login"] == $user_info["login"]): ?>
  <h3>Это ваш аккаунт.</h3>
  <div><a href="createpost.php">Напишите пост</a></div>
  <div><a href="includes/logout.inc.php">Выйти из аккаунта</a>.</div>
  <div><a href="includes/deleteacc.inc.php">Удалить аккаунт</a>.</div>
  <?php endif; ?>
</section>

<h1 class="section hovered">Посты пользователя:</h1>

<?php
// rendering posts of particular user

$posts = db_grab($conn, "select * from posts 
where author_login = \"" . $user_info["login"] . "\";");

if(empty($posts)) {
  echo "<h1>Этот пользователь не оставлял постов.</h1>";
}
else {
  foreach(array_reverse($posts) as $post) {
    render_post($post);
  }
}

?>

<?php include_once "footer.php" ?>