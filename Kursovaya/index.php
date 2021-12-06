<?php

// FRONT CONTROLLER (обрабатывает любой запрос)

// Общие настройки
// Отображение ошибок
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// Отображение каких ошибок
error_reporting(E_ALL);

// Сессия
session_start(); 

// Подключение файлов системы
define('ROOT', dirname(__FILE__));

// Подключение всех классов, компонентов
require_once(ROOT . '/components/Autoload.php');

// Вызов Router
$router = new Router();
$router->run();
