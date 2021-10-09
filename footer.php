    
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

    <footer class="footer">
      <p style="color: #ccc">
        Соцсеть. Школьный проект написанный Белоусовым Тихоном
        <a style="color: #ccc" href="https://github.com/it1shka">
          @it1shka
        </a>.
      </p>
    </footer>
    </div>
  </body>
</html>