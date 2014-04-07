<?php
require_once 'kcaptcha/kcaptcha.php';
class Model_Captcha extends Model {

    public $kcaptcha;

    public function render() {
        $this->kcaptcha = new KCAPTCHA();
        $_SESSION['captcha_keystring'] = $this->kcaptcha->getKeyString();
    }

    public function validate($user_keystring) {
        $error = array();
        if(!isset($_SESSION['captcha_keystring']) || $_SESSION['captcha_keystring'] !== $user_keystring) {
            $error[] = ("Введены неверные символы с картинки");
        }
        unset($_SESSION['captcha_keystring']);
        return $error;
    }
}