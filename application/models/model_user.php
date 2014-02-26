<?php

class Model_User extends Model {
    public $id;
    public $name;
    public $login;
    public $email;
    public $password;

    public function __construct($id = null, $login = null) {
        global $db;
        if($id) {
            $stmt = $db->prepare("SELECT `user_id` ,`user_name`, `login`, `email`
                                FROM users WHERE user_id= :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch();
            if($row) {
                $this->id = $row['user_id'];
                $this->name = $row['user_name'];
                $this->login = $row['login'];
                $this->email = $row['email'];
            }
        }
        if($login) {
            $stmt = $db->prepare("SELECT user_id, user_name, password
                                FROM users WHERE login = :login LIMIT 1");
            $stmt->bindParam(':login', $login);
            $stmt->execute();
            $row = $stmt->fetch();
            if($row) {
                $this->id = $row['user_id'];
                $this->name = $row['user_name'];
                $this->password = $row['password'];
            }
        }
    }

    public function check($password) {
        if($this->password === md5(md5($password))) {
            $_SESSION['user'] = array('id'=>$this->id, 'name'=>$this->name);
            return false;
        } else {
            return array("message" => "Неверный логин или пароль");
        }
    }
    public function create() {
        if($this->login_isset()) {
            return array("message" => "Пользователь с таким логином уже существует в базе данных");
        }
        $this->save();
    }

    public function save() {
        global $db;
        if(!preg_match("/^[a-zA-Z0-9]+$/", $this->login)) {
            return array("message" => "Логин может состоять только из букв английского алфавита и цифр");
        }

        if(strlen($this->login) < 3 or strlen($this->login) > 30) {
            return array("message" => "Логин должен быть не меньше 3-х символов и не больше 30");
        }

        $this->password = md5(md5(trim($this->password)));
        $stmt = $db->prepare("INSERT INTO users (login, password, user_name, email)
                            VALUES (:login, :password, :user_name, :email)");
        $data = array('login'     => $this->login, 'password' => $this->password,
                      'user_name' => $this->name, 'email' => $this->email);
        $stmt->execute($data);
        if(empty($error)) {
            header("Location: ".BASE_URL);
            exit();
        }
    }

    public function login_isset() {
        global $db;
        $stmt = $db->prepare("SELECT COUNT(user_id) as count FROM users WHERE login= :login");
        $stmt->bindParam(':login', $this->login);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['count'];

    }

    public static function logoff() {
        unset($_SESSION['user']);
    }
}