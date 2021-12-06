<?php require_once(ROOT . '/views/layouts/header_cabinet.php') ?>

<div class="notice">
    <form action="" method="POST">

        <label for="submit">Вы действительно хотите удалить документ <span id="document-id">№<?php echo $id; ?></span>?</label>
        <input type="submit" name="submit" value="Да">
        <a href="/cabinet" class="btn">Нет</a>

    </form>
</div>

<?php require_once(ROOT . '/views/layouts/footer_cabinet.php') ?>