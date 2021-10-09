<?php include_once "header.php" ?>

<?php
  require_once "includes/functions.inc.php";
  define("USERS_PER_PAGE", 15);
  $page = (int)$_GET["page"];
  $start = $page * USERS_PER_PAGE;
?>

<?php if($page === 0): ?>
<section class="section hovered">
  <h1>Пользователи:</h1>
</section>
<?php endif; ?>

<?php
include "includes/db.inc.php";
$count = db_count($conn, "users");
if($start >= $count || $start < 0) {
  echo "<h1>Упс... Здесь пусто...</h1>";
  exit();
}

// rendering users... 

$users = db_grab($conn, "users", $start, USERS_PER_PAGE);
echo "<section><ul class=\"section\">";
foreach($users as $user) {
  $name = $user["name"];
  $login = $user["login"];
  echo "<a class=\"pag-link\" href=\"#\"><li class=\"hovered pag-row\"><p>$name</p> <p>@$login</p></li></a>";
}
echo "</ul></section>";

// rendering pagination...

render_pagination($page, USERS_PER_PAGE, $count, "members");

?>

<?php include_once "footer.php" ?>