<?php

class Controller {
    public $model;
    public $view;

    protected function check_auth($action) {
        if(empty($_SESSION['user'])) {
            $this->go_page("user/login");
        }
    }

    public function exec_action($action) {
        $this->check_auth($action);
        call_user_func(array($this, $action));
    }

    function __construct() {
        $this->view = new View();
    }

    protected function go_page($page='main/index') {
        header('Location: '.BASE_URL.$page);
        exit();
    }

}
