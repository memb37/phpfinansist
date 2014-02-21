<?php
ini_set('display_errors', 1);
include "config.php";

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

$s = explode("/", $_SERVER['SCRIPT_NAME']);
$mp = ""; $depth = 0;
for ($i = 1; $i < count($s)-1; $i++)
{
	$mp.="/".$s[$i];
	$depth++;
}

$mp="http://".$_SERVER['HTTP_HOST'].$mp;
define("MAINPAGE", $mp); define("DEPTH", $depth);

require_once 'application/bootstrap.php';






