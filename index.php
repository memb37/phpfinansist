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
require_once 'application/bootstrap.php';






