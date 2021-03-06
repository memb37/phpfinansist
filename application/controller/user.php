<?php

class Controller_User extends Controller {

    protected function check_auth($action) {
        if(in_array($action, array('action_login', 'action_register',
            'action_password_recovery', 'action_recovery_activate'))) {
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
            $error = Model_User::check($_POST['email'], $_POST['password']);
            if(!$error) {
                $this->go_page();
            }
        }
        $this->view->generate('user/login.php', $error);
    }

    public function action_logout() {
        Model_User::logout();
        $this->go_page();
    }

    public function action_register() {
        $error = array();
        if(!empty($_POST)) {

                $user = new Model_User();
                $user->from_array(array(
                    'password' => $_POST['password'],
                    're_password' => $_POST['re_password'],
                    'name' => $_POST['name'],
                    'email' => $_POST['email']
                ));
                $captcha = new Model_Captcha();
                $error = array_merge($user->validate(), $captcha->validate($_POST['captcha']));
                if(empty($error)) {
                    $error = $user->create();
                }
                if(empty($error)) {
                    $user->login();
                    $this->go_page();
                }
            }
        $this->view->generate('user/register.php', $error);
    }


    public function action_password_recovery() {
        $error = array();
        if(!empty($_POST)) {
        $error = Model_User::recovery_init($_POST['email']);
        }
        $this->view->generate('user/password_recovery.php', $error);
    }

    public function action_recovery_activate() {
        if(isset($_GET['id']) && isset($_GET['key'])) {
            $user = new Model_User($_GET['id']);
            if(!$user->check_recovery_link($_GET['key'])) {
                throw new Exception('404');
            }
            $user->recovery_reset();
            $user->login();
            $this->go_page('user/change_password');
        }
    }

    public function action_change_password() {
        $error = array();
        if(!empty($_POST)) {
            $user = new Model_User($_SESSION['user']['id']);
            $user->password = $_POST['password'];
            $user->re_password = $_POST['re_password'];
            $error = $user->validate();
            if(empty($error)) {
                $user->save();
                $this->go_page();
            }
        }
        $this->view->generate('user/change_password.php', $error);
    }

}
