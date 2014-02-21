<?
require realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'config.php');
$sqlfile = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'createdb.sql');

$mysqli = new mysqli($hostname, $username, $password, $dbName);
$mysqli->multi_query(file_get_contents($sqlfile));
