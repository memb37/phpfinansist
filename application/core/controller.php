<?php
class Controller {
  
		
		
    public $model;
    public $view;
    
	static function auth()
	{
		global $db;
		if(isset($_SESSION['id']) and isset($_SESSION['hash']))
		{   
			try
			{
    			$stmt = $db->prepare("SELECT user_id, hash FROM users WHERE user_id = ?  LIMIT 1");
				$stmt->bindValue(1, intval($_SESSION['id']), PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt -> fetch(PDO::FETCH_ASSOC);
   			}

			catch(PDOException $e)
			{
				echo $e->getMessage();
			}

			if(($row['hash'] !== $_SESSION['hash']) or ($row['user_id'] !== $_SESSION['id']))
			{
	   			session_destroy();
				header("Location: /MVC"); exit();
			}
			else
			{
				echo "<form method=\"POST\" action=\"".MAINPAGE."/user/logout\">
					<input type=\"submit\" name=\"logout\"  value = \"Выход\">
				</form>";
				echo "<a href= \"".MAINPAGE."/user/profile\">Профиль</a>";
			}
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
