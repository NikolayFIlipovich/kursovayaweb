<?php

/**
 * Класс Document - модель для работы с документами
 */
class Document
{
    public static function getDocumentsList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        $sql = "SELECT iddocuments, created_date_documents, " .
            "(SELECT name FROM type_documents WHERE type_documents.idtype_documents  = documents.type_documents ) AS type, " .
            " (SELECT name_status FROM status WHERE status.idstatus = documents.status_documents) AS status, " .
            " (SELECT name_user FROM user WHERE user.iduser = documents.iduser_documents) AS user " .
            "FROM documents ORDER BY iddocuments ASC";

        // Тот же execute, но не для вложенного запроса 
        $result = $db->query($sql);

        // Задаем переменную-массив для списка документов
        $documentsList = array();

        $i = 0;


        // // "Пока есть следующая строка" заполняем массив
        while ($row = $result->fetch()) {

            $documentsList[$i]['iddocuments'] = $row['iddocuments'];
            $documentsList[$i]['created_date_documents'] = $row['created_date_documents'];
            $documentsList[$i]['type'] = $row['type'];
            $documentsList[$i]['user'] = $row['user'];
            $documentsList[$i]['status'] = $row['status'];
            $i++;
        }

        return  $documentsList;
    }

    public static function documentCreate($type_documents, $status_documents, $user)
    {
        //подключение к б д
        $db = Db::getConnection();
        //текст запроса (подготовленный запрос)

        // $sql = "SELECT * FROM user WHERE login_user = :email AND password_user = :password";
        // вставить в таблицу user данные в поля
        $sql = "INSERT INTO  documents (type_documents, status_documents ,iduser_documents) VALUES (:type_documents, :status_documents,:iduser_documents)";

        $result = $db->prepare($sql);
        //ключ, переменная, тип данных
        $result->bindParam(':type_documents', $type_documents, PDO::PARAM_INT);
        $result->bindParam(':status_documents', $status_documents, PDO::PARAM_INT);
        $result->bindParam(':iduser_documents', $user, PDO::PARAM_INT);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            $id = $db->lastInsertId();
            return $id;
        }

        // выполнение запроса
        return 0;
    }

    public static function documentDelete($iddocuments)
    {
        //подключение к б д
        $db = Db::getConnection();
        //текст запроса (подготовленный запрос)

        // Текст запроса к БД
        $sql = 'DELETE FROM documents WHERE iddocuments = :iddocuments';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':iddocuments', $iddocuments, PDO::PARAM_INT);
        return $result->execute();
    }

    // Фильтр
    public static function getDocumentFilter($iduser = '%', $status = '%', $type = '%',  $sort_by, $sort_type)
    {
        //подключение к б д
        $db = Db::getConnection();
        //текст запроса (подготовленный запрос)

        // Текст запроса к БД
        $sql = "SELECT iddocuments, created_date_documents, " .
            "(SELECT name FROM type_documents WHERE type_documents.idtype_documents  = documents.type_documents ) AS type, " .
            " (SELECT name_status FROM status WHERE status.idstatus = documents.status_documents) AS status, " .
            " (SELECT name_user FROM user WHERE user.iduser = documents.iduser_documents) AS user " .
            "FROM documents WHERE iduser_documents LIKE ".$iduser." and status_documents LIKE ".$status." and type_documents LIKE ".$type." ORDER BY ".$sort_by." ".$sort_type;

        // Тот же execute, но не для вложенного запроса 
        $result = $db->query($sql);

        // Задаем переменную-массив для списка документов
        $documentsList = array();

        $i = 0;

        // "Пока есть следующая строка" заполняем массив
        while ($row = $result->fetch()) {

            $documentsList[$i]['iddocuments'] = $row['iddocuments'];
            $documentsList[$i]['created_date_documents'] = $row['created_date_documents'];
            $documentsList[$i]['type'] = $row['type'];
            $documentsList[$i]['user'] = $row['user'];
            $documentsList[$i]['status'] = $row['status'];
            $i++;
        }

        return  $documentsList;
    }


    /**
     * Возвращает путь к файлу
     * @param integer $id
     * @return string <p>Путь к файлу</p>
     */
    public static function getFile($id)
    {
        // Название изображения-пустышки
        $noFile = 'no-file';

        // Путь к папке с товарами
        $path = '/upload/documents/';

        // Путь к изображению товара
        $pathToFile = $path . $id . '.png';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToFile)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToFile;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noFile;
    }
}
