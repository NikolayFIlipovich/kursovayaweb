<?php require_once(ROOT . '/views/layouts/header_cabinet.php') ?>

<table class="flatTable">
    <form action="#" method="POST">
        <tr class="titleTr">
            <td class="titleTd">Фильтры</td>
            <td>
                <select class="filter" name="type_filter">
                    <option value="'%'">Тип</option>
                    <?php if (is_array($typeList)) : ?>
                        <?php foreach ($typeList as $type) : ?>
                            <option value="<?php echo $type['idtype_documents']; ?>" <?php if ($type_filter === $type['idtype_documents']) echo 'selected'; ?>>
                                <?php echo $type['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </td>
            <td>
                <select class="filter" name="user_filter">
                    <option value="'%'">Автор</option>
                    <?php if (is_array($authorList)) : ?>
                        <?php foreach ($authorList as $author) : ?>
                            <option value="<?php echo $author['iduser']; ?>" <?php if ($user_filter === $author['iduser']) echo 'selected'; ?>>
                                <?php echo $author['name_user']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </td>
            <td>
                <select class="filter" name="status_filter">
                    <option value="'%'">Статус</option>
                    <?php if (is_array($statusList)) : ?>
                        <?php foreach ($statusList as $status) : ?>
                            <option value="<?php echo $status['idstatus']; ?>" <?php if ($status_filter === $status['idstatus']) echo 'selected'; ?>>
                                <?php echo $status['name_status']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </td>
            <td> <a href="/cabinet" class="filter filter-btn-reset">Сбросить</a> </td>
            <td class="plusTd button-open-form"></td>
        </tr>
        <tr class="titleTr">
            <td class="titleTd">Сортировать по:</td>
            <td>
                <select class="filter" name="sort_by">
                    <option value="iddocuments" <?php if ($sort_by === 'iddocuments') echo 'selected' ?>>По ID</option>
                    <option value="created_date_documents" <?php if ($sort_by === 'created_date_documents') echo 'selected' ?>>По дате</option>
                </select>
            </td>
            <td>
                <select class="filter" name="sort_type">
                    <option value="ASC" <?php if ($sort_type === 'ASC') echo 'selected' ?>>По возрастанию</option>
                    <option value="DESC" <?php if ($sort_type === 'DESC') echo 'selected' ?>>По убыванию</option>
                </select>
            </td>
            </td><td>
            <td> <input type="submit" name="filter" class="filter filter-btn" value="Найти"> </td>
            <td></td>
        </tr>
    </form>
    <tr class="headingTr">
        <td>ID</td>
        <td>ДАТА ЗАГРУЗКИ</td>
        <td>ТИП</td>
        <td>ДОБАВИЛ</td>
        <td>СТАТУС</td>
        <td></td>
    </tr>
    <?php foreach ($documentsList as $document) :  ?>
        <tr>
            <td><?php echo $document['iddocuments']; ?></td>
            <td><?php echo $document['created_date_documents']; ?></td>
            <td><?php echo $document['type']; ?></td>
            <td><?php echo $document['user']; ?></td>
            <td><?php echo $document['status']; ?></td>
            <td class="controlTd">
                <div class="settingsIcons">
                    <a href="#" class="settingsIcon"><img src="/templates/img/x.png" alt="X" /></a>
                    <a href="cabinet/document/delete/<?php echo $document['iddocuments']; ?>" class="settingsIcon"><img src="/templates/img/trash.png" alt="placeholder icon" /></a>
                    <!-- <a href="#" class="settingsIcon"><img src="/templates/img/edit.png" alt="placeholder icon" /></a> -->
                    <a href="cabinet/document/show/<?php echo $document['iddocuments']; ?>" class="settingsIcon"><img src="/templates/img/eye.png" alt="placeholder icon" /></a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div id="sForm" class="sForm sFormPadding">
    <span class="button-close-form close"><img src="/templates/img/x.png" alt="X" class="" /></span>

    <h2 class="title">Новый документ</h2>
    <form action="#" method="POST" enctype="multipart/form-data">
        <label for="type_documents">Тип файла:</label>
        <select name="type_documents">
            <?php if (is_array($typeList)) : ?>
                <?php foreach ($typeList as $type) : ?>
                    <option value="<?php echo $type['idtype_documents']; ?>">
                        <?php echo $type['name']; ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <label for="status_documents">Статус:</label>
        <select name="status_documents">
            <?php if (is_array($statusList)) : ?>
                <?php foreach ($statusList as $status) : ?>
                    <option value=" <?php echo $status['idstatus']; ?>">
                        <?php echo $status['name_status']; ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>

        <!-- <a href="" id="file-btn" class="btn">Загрузить файл</a> -->
        <input type="file" name="file" id="file">
        <input type="submit" value="Создать запись" name="submit">
    </form>
</div>

<?php require_once(ROOT . '/views/layouts/footer_cabinet.php') ?>