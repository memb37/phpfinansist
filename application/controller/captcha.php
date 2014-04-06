<?php


class Controller_Captcha extends Controller {

    protected function check_auth($action) {

    }

    public function action_index() {
        $captcha = new Model_Captcha();
        $captcha->render();

    }
}