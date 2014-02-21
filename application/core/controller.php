<?php
class Controller {
  
		
		
    public $model;
    public $view;
    
	static function auth()
	{
		global $db;
		if(isset($_SESSION['user_id']))
		{   

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
