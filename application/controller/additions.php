<?php


class Controller_Additions extends Controller {

    protected function check_auth($action) {

    }

    public function action_captcha() {
        $captcha = new Model_Captcha();
        $captcha->render();

    }
}