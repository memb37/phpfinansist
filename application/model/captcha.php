<?php

class Model_Captcha extends Model {

    public static function validate() {
        $error = array();
        if(!isset($_SESSION['captcha_keystring']) || $_SESSION['captcha_keystring'] !== $_POST['keystring']) {
            $error[] = ("Введены неверные символы с картинки");
        }
        unset($_SESSION['captcha_keystring']);
        return $error;
    }
}