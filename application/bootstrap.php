<?php
session_start();
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
    $filename = strtolower($class_name) . '.php';
    $dirname = explode("_", $filename);
    $dirname = $dirname[0] . "s/";
    $file = BASE_PATH."/application/".$dirname.$filename;
    require ($file);
}