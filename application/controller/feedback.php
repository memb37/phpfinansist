<?php

class Controller_Feedback extends Controller {

    protected function check_auth($action) {

    }

    function action_index() {
        $error = array();
        if(!empty($_POST)) {
            $message = new Model_Feedback();
            $message->subject = $_POST['subject'];
            $message->text = $_POST['text'];
            $message->email = $_POST['email'];
            if(isset($_POST['captcha'])) {
                $message->captcha = ($_POST['captcha']);
            }
            $error = $message->validate();
            if(!$error) {
                $message->send();
                $error[] = 'ваше собщение отправлено';
            }
        }
        $this->view->generate('feedback.php', $error);
    }
}