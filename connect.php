<?
include "config.php";

mysql_connect($hostname,$username,$password) or die("Не могу создать соединение "); 
mysql_select_db($dbName) or die(mysql_error()); 
mysql_query("SET NAMES 'utf8'");
?>
