<?php

class Model_User extends Model {
    public $id;
    public $name;
    public $email;
    public $password;
    public $re_password;
    public $recovery_key;
    public $recovery_time;

    public function __construct($id = null) {
        global $db;
        if($id) {
            $stmt = $db->prepare("SELECT `user_id` ,`user_name`, `email`, `password`, `recovery_key`, `recovery_time`
                                FROM users WHERE user_id= :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch();

            if($row) {
                $this->from_array(array(
                    'id'       => $row['user_id'],
                    'name'     => $row['user_name'],
                    'email'    => $row['email'],
                    'password' => $row['password'],
                    'recovery_key' => $row['recovery_key'],
                    'recovery_time' => $row['recovery_time']
                ));
            }
        }
    }

    public static function find_by_email($email) {
        global $db;
        $stmt = $db->prepare("SELECT user_id, user_name, password
			    FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row) {
            return new Model_User($row['user_id']);
        } else {
            return null;
        }
    }

    protected static function hashed_password($password) {
        return md5(md5($password));
    }

    public static function check($email, $password) {
        if(!$user = self::find_by_email($email)) {
            return array("message" => "Неверный логин");
        }
        if($user->password === self::hashed_password($password)) {
            $user->login();
            return false;
        } else {
            return array("message" => "Неверный логин или пароль");
        }
    }

    public function login() {
        if(!$this->id) {
            $user = self::find_by_email($this->email);
            $this->id = $user->id;
        }
        $_SESSION['user'] = array('id' => $this->id, 'name' => $this->name, 'email' => $this->email);
    }

    public function create() {
        if(self::find_by_email($this->email)) {
            return array("message" => "Пользователь с адресом $this->email уже существует в базе данных");
        }
        $this->save();
    }

    public function save() {
        global $db;
        $name = htmlspecialchars($this->name);
        $email = htmlspecialchars($this->email);
        if($this->re_password) {
            $password = self::hashed_password($this->password);
        }
        if($this->id) {
            $stmt = $db->prepare("UPDATE users
				SET password = :password, user_name = :user_name, email = :email
				WHERE user_id= :user_id");
            $data = array('password' => $password, 'user_name' => $name,
                          'email' => $email, 'user_id' => $this->id);
        } else {

            $stmt = $db->prepare("INSERT INTO users (password, user_name, email)
                            VALUES (:password, :user_name, :email)");
            $data = array('password'  => $password,
                      'user_name' => $name, 'email' => $email);
        }
        $stmt->execute($data);
    }

    public static function logout() {
        unset($_SESSION['user']);
    }

    public function validate() {
        $error = array();
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $error[] = ("Введен неверный email");
        }
        if(strlen($this->password) < 5) {
            $error[] = ("Пароль должен быть не менее 5 символов");
        }
        if($this->password != $this->re_password) {
            $error[] = ("Введенные пароли не совпадают");
        }
        if(strlen($this->name) > 30) {
            $error[] = ("Имя должно быть не длинее 30 символов");
        }
        return $error;

    }


    public static function recovery_init($email) {
        $error = array();
        global $db;
        if(!$user = self::find_by_email($email)) {
            return array("message" => "Пользователь с адресом $email не зарегистрирован");
        } else {
            $captcha = new Model_Captcha();
            if(!$error = $captcha->validate($_POST['captcha'])) {
                $key = md5(microtime());
                $stmt = $db->prepare("UPDATE users
                        SET recovery_key = :key, recovery_time = :time
                        WHERE user_id= :user_id");
                $data = array('key' => $key, 'user_id' => $user->id, 'time' => date("Y-m-d H:i:s"));
                $stmt->execute($data);
                $link = BASE_URL.'user/recovery_activate?id='.$user->id.'&key='.$key;
                $view = new View();
                $view->template = 'email/template.php';
                ob_start();
                $view->generate('email/password_recovery.php', array('link' =>$link));
                $body = ob_get_clean();
                $headers  = "Content-type: text/html; charset=utf-8 \r\n";
                $headers .= "From: <no-reply@phpfinansist.com>\r\n";
                mail($email, "Восстановление пароля", $body, $headers);
                return array("message" => "Ссылка для смены пароля отправлена на  $email");
            }
        }
        return $error;
    }

    public function check_recovery_link($key) {
        $time1 = new DateTime($this->recovery_time);
        $time2 = new DateTime("now");
        $days = date_diff($time1, $time2)->days;
        if (($key == $this->recovery_key) && ($days < 1)) {
            return true;
        }
        return false;
    }



    public function recovery_reset() {
        global $db;
        $stmt = $db->prepare("UPDATE users
				SET recovery_key = NULL, recovery_time = NULL
				WHERE user_id= :user_id");
        $stmt->bindParam(':user_id', $this->id);
        $stmt->execute();
    }

}