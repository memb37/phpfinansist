<?php
class Controller_User extends Controller
{
    function __construct()
    {
        $this->model = new Model_User();
        $this->view = new View();
    }
function action_index()
{
	
}
function action_login() 
{	
	$this->view->generate('login_view.php', 'template_view.php');
	global $db;
	
	if(isset($_POST['username']) && isset($_POST['password'])) 
	{
	try
	{
    	$stmt = $db->prepare("SELECT user_id, password FROM users WHERE login = :login LIMIT 1");
		$stmt->bindParam(':login', $_POST['username']);
		$stmt->execute();
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	}

	catch (PDOException $e) 
			{
			echo $e->getMessage();
			}
	
    if($row['password'] === md5(md5($_REQUEST['password']))) 
	{
		$hash = md5(microtime().getmypid());
		try 
		{
	    	$stmt = $db->prepare("UPDATE users SET hash = :hash WHERE user_id = :user_id");
			$stmt->bindParam(':hash', $hash); 
			$stmt->bindParam(':user_id', $row['user_id']); 
			$stmt->execute();
		} 
		catch (PDOException $e) 
		{
			echo $e->getMessage();
		}        
		$_SESSION['id'] = $row['user_id'];
		$_SESSION['hash'] = $hash;



        
		header("Location: ".MAINPAGE); exit();
    } 
	else 
	{ 
        echo "Invalid";
		
    }
}
}

function action_logout()
{
		session_destroy();
    	header("Location: ".MAINPAGE); exit();
}

function action_profile()
{
        $data = $this->model->get_data();		
        $this->view->generate('profile_view.php', 'template_view.php', $data);
}
function action_register() 
{	
	if (isset($_POST['submit_reg']))
	{
	global $db;
		$err = array();
    # проверям логин

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }
  
	

	
    if($this->model->login_free())
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    if(count($err) == 0)
    {
        $this->model->add_user();

        header("Location: ".MAINPAGE.""); exit();
    }

    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
       
		foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
	
}

		$this->view->generate('register_view.php', 'template_view.php');
}
}
