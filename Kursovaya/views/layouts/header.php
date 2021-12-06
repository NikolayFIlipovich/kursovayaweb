<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/templates/style.css">
    <title>Авторизация</title>
</head>

<body class="login-body">



    <div class="wrapper">
        <header>
            <a href="#" class="logo">
                Document Management System
            </a>

            <div class="nav-container">
                <nav class="nav">
                    <a href="/" class="nav__item">Главная</a>
                </nav>
                <div class="acc-links">

                    <?php if(User::checkGuest()):  ?>
                        <a href="/login" class="acc-links__item">Войти</a>
                        <a href="/register" class="acc-links__item">Зарегистрироваться</a>
                    <?php else: ?>
                        <a href="/cabinet" class="acc-links__item">Кабинет</a>
                        <a href="/logout" class="acc-links__item">Выход</a>
                    <?php endif; ?>
                </div>
            </div>
        </header>


        <div class="content">