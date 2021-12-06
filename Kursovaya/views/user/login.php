<?php
require_once(ROOT . '/views/layouts/header.php');
?>



<div class="login">

  

  <form action="" method="POST">
    <span class="title">Авторизация</span>
    <input type="email" name="email" id="email" placeholder="E-mail" value="<?php echo $email; ?>">
    <input type="password" name="password" id="password" placeholder="Пароль">


    <!--  Вывод ошибок, если они существуют -->
    <?php if (isset($errors) && is_array($errors)) : ?>
      <ul class="error">
        <?php foreach ($errors as $error) : ?>
          <li class="error-item"><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <input type="submit" name="submit" value="Вход">

    <span class="no-acc">Нет аккаунта?<br><a href="/register">Зарегистрируйтесь!</a></span>

  </form>
</div>

<?php
require_once(ROOT . '/views/layouts/footer.php');
?>