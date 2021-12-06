<?php
class DocumentStatus
{
    /**
     * Возвращает массив категорий для списка на сайте
     * @return array <p>Массив с категориями</p>
     */
    public static function getCategoriesList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT idstatus, name_status FROM status');

        // Получение и возврат результатов
        $i = 0;
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['idstatus'] = $row['idstatus'];
            $categoryList[$i]['name_status'] = $row['name_status'];
            $i++;
        }
        return $categoryList;
    }
}