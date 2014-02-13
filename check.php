
<?

require_once "connect.php";
$auth=0;

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))

{   

    $query = mysql_query("SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");

    $userdata = mysql_fetch_assoc($query);


    if(($userdata['hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))

    {

        setcookie("id", "", time() - 3600*24*30*12, "/");

        setcookie("hash", "", time() - 3600*24*30*12, "/");

       
    }

    else

    {

        		$auth=1;
    }

}

else

{
	
    print "Включите куки";

}

?>
