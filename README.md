phpfinansist
============
О проекте:
---------
Web-приложение для учета личных финансов

Системные требования:
---------------------

Apache(с модулем mod_rewrite)

PHP => 5.2, PDO_MySQL

MySQL => 5.0


Установка:
----------
Поместите все файлы в директорию вашего web-сервера

Восстановите БД из дампа:

	mysql  phpfinansist  < scripts/createdb.sql

Скопируйте config.php.default в config.php и отредактируйте
