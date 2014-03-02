phpfinansist
============
О проекте:
---------
Web-приложение для учета личных финансов

Системные требования:
---------------------

Apache(с модулем mod_rewrite)

PHP 5.2 (должна быть включена директива short_open_tag), PDO_MySQL

MySQL 5.0


Установка:
----------
Поместите все файлы в директорию вашего web-сервера

Восстановите БД из дампа:

	mysql -u %user% -p phpfinansist  < scripts/createdb.sql

Отредактируйте файл config.php.default и переименуйте его в config.php
