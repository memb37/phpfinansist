<?php


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
                'name' => $_POST['name'],
                'email' => $_POST['email']
            ));
            $error = $user->create();
            if(empty($error)) {
                $this->go_page();
            }
        }
        $this->view->generate('user/register.php', $error);
    }

}
