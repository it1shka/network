<?php include_once "header.php" ?>

<?php
define("POSTS_PER_PAGE", 8);
function count_posts(mysqli $conn) {
  $sql = "select count(*) from posts;";
  $result = $conn->query($sql);
  $total = ($result->fetch_array())[0];
  return $total;
}

function grab_posts(mysqli $conn, $start, $limit) {
  $sql = "select author_login,author_name,title,message
   from posts limit $start, $limit";
  $result = $conn->query($sql);
  $users = $result->fetch_all(MYSQLI_ASSOC);
  return $users;
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

$page = (int)$_GET["page"];
$start = $page * POSTS_PER_PAGE;

?>

<div class="container">
<main>

<?php if($_SESSION["loggedin"]): ?>
<section class="section hovered">
  <h3>Вы вошли как @<?=$_SESSION["login"]?></h3>
  <p>Есть что сказать? <a href="createpost.php">Напишите пост</a>!</p>
</section>
<?php endif; ?>

<?php

include "includes/db.inc.php";
$count = count_posts($conn);
if($start >= $count || $start < 0) {
  echo "<section class=\"section hovered\"><h1>Упс... Здесь пусто...</h1></section>";
  exit();
}

$posts = grab_posts($conn, $start, POSTS_PER_PAGE);
foreach($posts as $post) {
  render_post($post);
}

echo "<ul class=\"section pagination\">Страницы:";
for($current_page = $page - 2; $current_page <= $page + 2; $current_page++) {
  $current_start = $current_page * POSTS_PER_PAGE;
  if($current_start < 0 || $current_start >= $count) continue;
  echo "<li><a href=\"posts.php?page=$current_page\">$current_page</a></li>";
}
echo "</ul>";

?>

</main>
</div>

<?php include_once "footer.php" ?>