<?php

class Controller_Feedback extends Controller {
    function action_index() {
        $user = new Model_User($_SESSION['user']['id']);
        $data = array("email" => $user->email);
        if(!empty($_POST)) {
            mail("support@phpfinansist", $_POST['subject'], $_POST['text'], "From: $user->email");
            $data['message'] = 'ваше собщение отправлено';
        }
        $this->view->generate('feedback.php', $data);
    }
}