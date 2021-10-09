<?php include_once "header.php" ?>

<?php if(empty($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true): ?>
<section class="section hovered">
  <h1>Вы гость</h1>
  <p>
    Пока вы не войдёте
    в свой аккаунт, вы не
    можете писать посты. 
    Войти можно <a href="login.php">здесь</a>.
  </p>
</section>
<?php else: ?>
<section class="section">
<form method="post" action="includes/createpost.inc.php">
  <?php /*<input type="hidden" name="author_login" value="<?=$_SESSION["login"]?>">
  <input type="hidden" name="author_name"  value="<?=$_SESSION["name"]?>"> */ ?>
  <p>
    <label for="title">Заголовок: </label>
    <input id="title" name="title" required>
  </p>

  <p>
    <textarea name="message" style="width: 100%; min-height: 180px;" required></textarea>
  </p>

  <p>
    <input type="submit" name="submit" value="Запостить">
  </p>
</form>
</section>
<?php endif; ?>

<?php include_once "footer.php" ?>