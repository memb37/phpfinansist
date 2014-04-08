<?php

class Model_Feedback extends Model {

    public $subject;
    public $email;
    public $text;
    public $captcha;

    public function send() {
        mail(EMAIL_SUPPORT, $this->subject, $this->text, "From: $this->email");
    }

    public function validate() {
        $error = array();
        if(!isset($_SESSION['user'])) {
            $captcha = new Model_Captcha();
            $error = $captcha->validate($this->captcha);
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $error[] = ("Введен неверный email");
        }
        if(!$this->text) {
            $error[] = ("Сообщение не может быть пустым");
        }
        return $error;
    }

}