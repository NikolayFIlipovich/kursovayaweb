<?php
require_once(ROOT . '/views/layouts/header.php');
?>

<div class="login">

  <?php if ($result == true) : ?>

    <div class="success-registration">
      <span class="text-success">Регистрация прошла успешно! <br><a href="/login">Войти!</a></span>
    </div>

  <?php else :  ?>
    <form action="#" method="POST">
      <span class="title">Регистрация</span>
      <input type="email" placeholder="E-mail" name="email" value="<?php echo $email; ?>">
      <input type="password" placeholder="Пароль" name="password">
      <input type="text" placeholder="Имя Фамилия" name="name" value="<?php echo $name; ?>">
      <input type="submit" name="submit" value="Регистрация">

      <!--  Вывод ошибок, если они существуют -->
      <?php if (isset($errors) && is_array($errors)) : ?>
        <ul class="error">
          <?php foreach ($errors as $error) : ?>
            <li class="error-item"><?php echo $error; ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <span class="no-acc">Уже есть аккаунт?<br><a href="/login">Войти!</a></span>


    <?php endif; ?>

</div>
<?php
require_once(ROOT . '/views/layouts/footer.php');
?>