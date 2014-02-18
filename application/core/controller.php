<?php
class Controller {
  
		
		
    public $model;
    public $view;
    
	static function auth()
	{
		global $db;
		if(isset($_SESSION['id']))
		{   
				echo "<form method=\"POST\" action=\"".MAINPAGE."/user/logout\">
					<input type=\"submit\" name=\"logout\"  value = \"Выход\">
				</form>";
				echo "<a href= \"".MAINPAGE."/user/profile\">Профиль</a>";
		}
		else {header("Location: ".MAINPAGE."/user/login"); exit();};
	}
    function __construct()
    {
		
		$this->view = new View();
    }
    
    function action_index()
    {
    }
	
}
