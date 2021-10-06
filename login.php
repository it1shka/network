<?php include_once "header.php" ?>

<div class="container">
<main>
  <form action="includes/login.inc.php" method="post" class="section form">

    <p class="form__subphrase">Нет аккаунта? <a href="signup.php">Зарегестрируйтесь</a>.</p>
    <h1>Вход</h1>
    <p>
      <div><label for="login">Ваш логин: </label></div>
      <input id="login" name="login" type="text" required>
    </p>
    <p>
      <div><label for="password">Ваш пароль: </label></div>
      <input id="password" name="password" type="password" required>
    </p>
    <input type="submit" name="submit" value="Войти">
  </form>

  <?php if(isset($_GET["error"])): ?>
  <section class="section">
  <?php
    include_once "includes/errors.inc.php";
    $error = get_error_desc($_GET["error"]);
    echo $error;
  ?>
  </section>
  <?php endif; ?>
  
</main>
</div>

<?php include_once "footer.php" ?>