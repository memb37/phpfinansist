
<?
include "header.php";
require_once "check.php";
if ($auth) { header("Location: lk.php"); exit();}
?>
<a href="login.php"> Войти </a><br>
<a href="register.php"> Зарегистрироваться </a>

<?include "footer.php";?>
