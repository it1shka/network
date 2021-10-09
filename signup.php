<?php include_once "header.php" ?>

<form action="includes/signup.inc.php" method="post" class="section form">

  <p class="form__subphrase">Уже с нами? <a href="login.php">Войдите в аккаунт</a>.</p>
  <h1>Регистрация</h1>
  <p>
    <div><label for="name">Ваше имя: </label></div>
    <input id="name" name="name" type="text" required>
  </p>
  <p>
    <div><label for="login">Ваш логин: </label></div>
    <input id="login" name="login" type="text" required>
  </p>
  <p>
    <div><label for="password">Ваш пароль: </label></div>
    <input id="password" name="password" type="password" required>
  </p>
  <p>
    <div><label for="confirm_password">Подтвердите пароль: </label></div>
    <input id="confirm_password" name="confirm_password" type="password" required>
  </p>
  <input type="submit" name="submit" value="Зарегистрироваться">
</form>

<?php include_once "footer.php" ?>