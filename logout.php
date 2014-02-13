<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<form method="POST" action="logout.php">
<input type="submit" value="Выход" name="logout">
</form>
<?
if (isset($_POST['logout']))
{
	setcookie("id");
	setcookie("ps");
	header("Location: ".$_SERVER['HTTP_REFERER']); exit();
}
?>
<body>
</html>