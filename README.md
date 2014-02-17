phpfinansist
============
Server Requirements:

PHP 5.4.6, MySQL 5.5.34, PHP PDO, PHP PDO MySQL


Installation:

Copy all files in your webserver’s directory

example /var/www/phpfinansist/
  
Create database : 
		
	mysql -u root -p
	mysql>CREATE DATABASE phpfinDB

Restore database from dump: 

	mysql -u root -p phpfinDB  < MyFinDB.sql

Edit file config.php.default and rename it to config.php
