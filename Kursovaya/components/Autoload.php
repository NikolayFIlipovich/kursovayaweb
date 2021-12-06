<?php

// Подключение классов
spl_autoload_register(function ($class_name) {
    $array_paths = array(
        '/models/',
        '/controllers/',
        '/components/',
    );

    //Перебор файлов из папок, указанных в array_paths
    foreach ($array_paths as $path){
        $path = ROOT. $path . $class_name . '.php';
        if(is_file($path)){
            include_once $path; 
        }
    }
});
