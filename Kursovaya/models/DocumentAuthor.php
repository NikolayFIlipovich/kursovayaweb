<?php
class DocumentAuthor
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
        $result = $db->query('SELECT iduser, name_user FROM user');

        // Получение и возврат результатов
        $i = 0;
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['iduser'] = $row['iduser'];
            $categoryList[$i]['name_user'] = $row['name_user'];
            $i++;
        }
        return $categoryList;
    }
}
