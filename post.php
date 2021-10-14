<?php include_once "header.php" ?>

<?php 

require_once "includes/functions.inc.php";

if(empty($_GET["postid"])) {
  echo "<h1>Пост не найден</h1>";
} else {
  $post_id = $_GET["postid"];

  require_once "includes/db.inc.php";

  // render post message
  $post_data = grab_post_with_id($conn, $post_id);
  render_post($post_data);

  // render comments
  $comments_data = grab_comments_with_id($conn, $post_id);
  if(empty($comments_data)) {
    echo "<h3 class=\"section hovered\">Комментариев нет. Добавите свой?</h3>";
  } else {
    echo "<h3 class=\"section hovered\">Комментарии к посту:</h3>";
    echo "<section class=\"section comments\">";
    foreach($comments_data as $comment) {
      render_comment($comment);
    }
    echo "</section>";
  }

  // render write comment form
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>

  <form method="post" action="includes/addcomment.inc.php" class="section">
    <input type="hidden" name="postid" value="<?=$post_id?>">
    <h2>Напишите комментарий!</h2>
    <p>
      <div><label for="message">Сообщение:</labeL></div>
      <textarea required
        name="message" 
        id="message" 
        placeholder="Ваш комментарий...">Классный пост!</textarea>
    </p>
    <input type="submit" name="submit" value="Отправить">
  </form>

  <?php } else {
    echo "<h3>Вы в режиме гостя. 
    <a href=\"login.php\">Войдите в аккаунт</a>, чтобы оставлять
    комментарии.</h3>";
  }
}

?>

<?php include_once "footer.php" ?>