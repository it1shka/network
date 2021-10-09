<?php include_once "header.php" ?>

<?php if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true): ?>
  <section class="section hovered">
    <h1>Гостевой режим</h1>
    <p>
      Сейчас вы являетесь гостем. 
      Вы можете просматривать посты и 
      профили других, но не можете писать
      и у вас нет своего профиля.
      Войти можно <a href="login.php">здесь</a>.
    </p>
  </section>
<?php else: ?>
  <section class="section">
    <h1>Приветствуем тебя, <span class="colored"><?=$_SESSION["name"]?></span>!</h1>
    <h3>Твой логин: <span class="colored"><?=$_SESSION["login"]?></span></h3>
    <div><a href="includes/logout.inc.php">Выйти из аккаунта</a>.</div>
    <div><a href="includes/deleteacc.inc.php">Удалить аккаунт</a>.</div>
  </section>
<?php endif; ?>

<?php include_once "footer.php" ?>