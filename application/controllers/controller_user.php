<?php
require 'application/models/model_user.php';


class Controller_User extends Controller {
    protected function check_auth($action) {
        if(in_array($action, array('action_login', 'action_register'))) {
            return;
        }
        parent::check_auth($action);
    }

    public function action_index() {
        $user = new Model_User($_SESSION['user']['id']);
        $this->view->generate('user/profile.php', array('user' => $user));
    }

    public function action_login() {
        $error = array();
        if(!empty($_POST)) {
            $user = new Model_User(null, $_POST['login']);
            $error = $user->check($_REQUEST['password']);
            if (!$error) {
                header("Location: ".BASE_URL);
            }
        }
        $this->view->generate('user/login.php', $error);
    }

    public function action_logout() {
        Model_User::logoff();
        header("Location: ".BASE_URL);
        exit();
    }

    public function action_register() {
        $error = array();
        if(!empty($_POST)) {
            $user = new Model_User();
            $user->login = $_POST['login'];
            $user->password = $_POST['password'];
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $error = $user->create();
        }
        $this->view->generate('user/register.php', $error);
    }
}