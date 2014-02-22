<?php
class Controller {
    public $model;
    public $view;
    
    protected function check_auth($action) {
	if(empty($_SESSION['user_id'])) {
	    header("Location: " . BASE_URL . "/user/login");
	    exit();
	}
    }
    
    public function exec_action($action) {
	$this->check_auth($action);
	call_user_func(array($this, $action));
    }
    
    function __construct()
    {
	$this->view = new View();
    }
    
    function action_index()
    {
    }
	
}
