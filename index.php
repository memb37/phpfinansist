<?php
ini_set('display_errors', 1);
require "config.php";

define("BASE_URL", "http://{$_SERVER['HTTP_HOST']}" . dirname($_SERVER["SCRIPT_NAME"])."/");

require_once 'application/bootstrap.php';
