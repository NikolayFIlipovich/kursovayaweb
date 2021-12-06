<?php

/**
 * Класс User - модель для работы с пользователями
 */
class User
{

    // Функции валидации email
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

    public static function checkEmailRepetition($email)
    {
        //подключение к бд
        $db = Db::getConnection();

        $sql = "SELECT COUNT(*) FROM user WHERE login_user = :email";

        $result = $db->prepare($sql);

        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }

    // Функции валидации password
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }

        return false;
    }

    // Проверка пользователя на существование 
    public static function checkUser($email, $password)
    {
        //подключение к бд
        $db = Db::getConnection();
        //текст запроса (подготовленный запрос)
        $sql = "SELECT * FROM user WHERE login_user = :email AND password_user = :password";

        $result = $db->prepare($sql);
        //ключ, переменная, тип данных
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        //получает все записи - выводит одну подходящую
        $result->execute();

        // Обращаемся к записи (от 0 к 1)
        $user = $result->fetch();

        // Если не пустой - то возвращается id пользователя
        if ($user) {
            return $user['iduser'];
        }

        return false;
    }

    // Функция авторизации пользователя
    public static function userAuth($userid)
    {
        $_SESSION['user'] = $userid;
    }


    public static function userRegister($name, $email, $password)
    {
        //подключение к б д
        $db = Db::getConnection();
        //текст запроса (подготовленный запрос)

        // $sql = "SELECT * FROM user WHERE login_user = :email AND password_user = :password";
        // вставить в таблицу user данные в поля
        $sql = "INSERT INTO  user (name_user,login_user, password_user) VALUES (:name_user, :login_user, :password_user)";

        $result = $db->prepare($sql);
        //ключ, переменная, тип данных
        $result->bindParam(':name_user', $name, PDO::PARAM_STR);
        $result->bindParam(':login_user', $email, PDO::PARAM_STR);
        $result->bindParam(':password_user', $password, PDO::PARAM_STR);

        // выполнение запроса
        return $result->execute();
    }

    // Функции валидации name, принимает строку
    public static function checkName($str)
    {
        if (strlen($str) > 1) {
            return true;
        }

        return false;
    }
    //функция проверки сессии (если существует сессия, то возвращаем ID пользователя, иначе перенаправляем на /login)
    public static function checkSession()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /login");
    }

    public static function checkGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public static function getUserById($id)
    {
        //подключение к бд
        $db = Db::getConnection();
        //текст запроса (подготовленный запрос)
        $sql = "SELECT * FROM user WHERE iduser = :id";

        $result = $db->prepare($sql);
        //ключ, переменная, тип данных
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        //получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }
}
