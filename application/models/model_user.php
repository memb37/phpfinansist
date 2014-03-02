<?php

class Model_User {
    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($id = null, $email = null) {
        global $db;
        if($id) {
            $stmt = $db->prepare("SELECT `user_id` ,`user_name`, `email`
                                FROM users WHERE user_id= :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch();
            if($row) {
                $this->id = $row['user_id'];
                $this->name = $row['user_name'];
                $this->email = $row['email'];
            }
        }
        if($email) {
            $stmt = $db->prepare("SELECT user_id, user_name, password
                                FROM users WHERE email = :email LIMIT 1");
            $stmt->bindParam(':email', $email);
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
        if($this->password === md5(md5(trim($password)))) {
            $_SESSION['user'] = array('id' => $this->id, 'name' => $this->name);
            return false;
        } else {
            return array("message" => "Неверный логин или пароль");
        }
    }

    public function create() {
        if($this->email_occupied()) {
            return array("message" => "Пользователь с адресом $this->email уже существует в базе данных");
        }
        $this->save();
    }

    public function save() {
        global $db;
        $password = md5(md5(trim($this->password)));
        $name = htmlspecialchars($this->name);
        $email = htmlspecialchars($this->email);
        $stmt = $db->prepare("INSERT INTO users (password, user_name, email)
                            VALUES (:password, :user_name, :email)");
        $data = array('password'  => $password,
                      'user_name' => $name, 'email' => $email);
        $stmt->execute($data);
    }

    public function email_occupied() {
        global $db;
        $email = htmlspecialchars($this->email);
        $stmt = $db->prepare("SELECT COUNT(user_id) as count FROM users WHERE email= :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['count'];
    }

    public static function logout() {
        unset($_SESSION['user']);
    }
}