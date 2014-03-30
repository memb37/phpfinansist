<?php
require_once 'kcaptcha/kcaptcha.php';

class Controller_Captcha extends Controller {

    protected function check_auth($action) {

    }

    public function action_index() {
        $captcha = new KCAPTCHA();
        $_SESSION['captcha_keystring'] = $captcha->getKeyString();
    }
}