<?php include_once "header.php" ?>

<?php

  define("USERS_PER_PAGE", 5);
  function count_users(mysqli $conn) {
    $sql = "select count(*) from users;";
    $result = $conn->query($sql);
    $total = ($result->fetch_array())[0];
    return $total;
  }

  function grab_users(mysqli $conn, $start, $limit) {
    $sql = "select * from users limit $start, $limit";
    $result = $conn->query($sql);
    $users = $result->fetch_all(MYSQLI_ASSOC);
    return $users;
  }

  $page = (int)$_GET["page"];
  $start = $page * USERS_PER_PAGE;

?>

<div class="container">
<main>
  <?php if($page === 0): ?>
  <section class="section hovered">
    <h1>Пользователи:</h1>
  </section>
  <?php endif; ?>

  <?php
  include "includes/db.inc.php";
  $count = count_users($conn);
  if($start >= $count || $start < 0) {
    echo "<h1>Упс... Здесь пусто...</h1>";
    exit();
  }

  // rendering users... 

  $users = grab_users($conn, $start, USERS_PER_PAGE);
  echo "<section><ul class=\"section\">";
  foreach($users as $user) {
    $name = $user["name"];
    $login = $user["login"];
    echo "<li class=\"hovered pag-row\"><p>$name</p> <p>@$login</p></li>";
  }
  echo "</ul></section>";

  // rendering pagination...

  echo "<ul class=\"section pagination\">Страницы:";
  for($current_page = $page - 2; $current_page <= $page + 2; $current_page++) {
    $current_start = $current_page * USERS_PER_PAGE;
    if($current_start < 0 || $current_start >= $count) continue;
    echo "<li><a href=\"members.php?page=$current_page\">$current_page</a></li>";
  }
  echo "</ul>";

  ?>

</main>
</div>

<?php include_once "footer.php" ?>