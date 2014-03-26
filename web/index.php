<?php
ini_set('display_errors', 1);
define('BASE_URL', 'http://' . $_SERVER["SERVER_NAME"] . 
    rtrim(dirname($_SERVER["SCRIPT_NAME"]), '/') . '/');
//phpinfo();
define("BASE_PATH", realpath(dirname(__FILE__) . '/../') . '/');
require "../config.php";

require_once '../application/bootstrap.php';
