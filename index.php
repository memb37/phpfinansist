<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?
require_once "check.php";
if ($auth) { header("Location: lk.php"); exit();}
?>
<a href="login.php"> Войти </a><br>
<a href="register.php"> Зарегистрироваться </a>




</body>
</html>
