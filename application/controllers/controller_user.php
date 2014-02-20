<?php
class Controller_User extends Controller
{
    function __construct()
    {
        
        $this->view = new View();
    }
function action_index()
{
	$this->model = new Model_User();
	$data = $this->model->get_operations();
    $this->view->generate('lk_view.php', 'template_view.php', $data);
}
function action_login() 
{	
	
	global $db;$data=null;
	
	if(isset($_POST['login']) && isset($_POST['password'])) 
	{
		$this->model = new Model_User();
		$data = $this->model->get_user();
	    if($data['password'] === md5(md5($_REQUEST['password']))) 
		{  
			$_SESSION['user_id'] = $data['user_id'];
			$_SESSION['user_name'] = $data['user_name'];
			header("Location: ".MAINPAGE); exit();
    	} 
		else 
		{ 
    	    $data = array("message" => "Неверный логин или пароль") ;	
    	}
	}
	$this->view->generate('login_view.php', 'template_view.php', $data);
}


function action_logout()
{
		session_destroy();
    	header("Location: ".MAINPAGE); exit();
}

function action_profile()
{
		$this->model = new Model_User();
        $data = $this->model->get_data();		
        $this->view->generate('profile_view.php', 'template_view.php', $data);
}
function action_register() 
{	
	if (isset($_POST['submit_reg']))
	{
	$this->model = new Model_User();
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
