<?php

spl_autoload_register(function ($class_name) {

    //class directories
    $source = $_SERVER['DOCUMENT_ROOT'];

    $subfolder = "/"; // format: /foldername
    $dirs = [
        $source . $subfolder . '/controller/',
        $source . $subfolder . '/model/',
    ];

    foreach ($dirs as $directory) {
    //see if the file exsists
        if (file_exists($directory . $class_name . '.php')) {
            require($directory . $class_name . '.php');
        }
    }
});
