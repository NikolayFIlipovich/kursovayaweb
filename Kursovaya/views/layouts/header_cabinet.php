<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/templates/style.css">
    <title>DMS</title>
</head>

<body>
    <header>
        <a href="/" class="logo">
            Document<br>Management<br>System
        </a>

        <div class="welcome">
            <div class="welcome__container">
                Добрый день, <?php echo $user['name_user']; ?><br>
                <?php echo $currentDate; ?>
            </div>
            <a href="/logout" class="logout"><img src="/templates/img/logout.png" alt=""></a>
        </div>
    </header>