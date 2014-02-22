<?php
ini_set('display_errors', 1);
require "config.php";

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

define("BASE_URL", "http://{$_SERVER['HTTP_HOST']}" . dirname($_SERVER["SCRIPT_NAME"]));

require_once 'application/bootstrap.php';
