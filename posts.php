<?php include_once "header.php" ?>

<?php

require_once "includes/functions.inc.php";
define("POSTS_PER_PAGE", 8);
$page = (int)$_GET["page"];
$start = $page * POSTS_PER_PAGE;

?>

<?php if($_SESSION["loggedin"]): ?>
<section class="section hovered">
  <h3>Вы вошли как @<?=$_SESSION["login"]?></h3>
  <p>Есть что сказать? <a href="createpost.php">Напишите пост</a>!</p>
</section>
<?php endif; ?>

<?php

include "includes/db.inc.php";
$count = db_count($conn, "posts");
if($start >= $count || $start < 0) {
  echo "<section class=\"section hovered\"><h1>Упс... Здесь пусто...</h1></section>";
  exit();
}

$posts = db_grab($conn, "posts", $start, POSTS_PER_PAGE);
foreach($posts as $post) {
  render_post($post);
}

render_pagination($page, POSTS_PER_PAGE, $count, "posts");

?>

<?php include_once "footer.php" ?>