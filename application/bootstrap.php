<?php
session_start();
set_include_path(BASE_PATH . 'application'. PATH_SEPARATOR . get_include_path());


try
{
    $db = new PDO("mysql:host=$hostname; dbname=$dbName", $username, $password);
    $db->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("set names utf8");
}
catch(PDOException $e)
{
    echo "Не могу подключиться к БД " . $e->getMessage();
}

require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
Route::start(); // запускаем маршрутизатор

function __autoload($class_name) {
    require_once str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)) . '.php';
}