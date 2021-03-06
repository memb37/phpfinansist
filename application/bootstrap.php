<?php
session_start();
set_include_path(BASE_PATH . 'application'. PATH_SEPARATOR . BASE_PATH . 'lib' . PATH_SEPARATOR . get_include_path());


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

require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
set_error_handler("Controller_Error::exception_error_handler");
set_exception_handler('Controller_Error::exception_handler');
register_shutdown_function('Controller_Error::FatalErrorHandler');
ob_start();
Route::start(); // запускаем маршрутизатор

function __autoload($class_name) {
    require_once str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)) . '.php';
}