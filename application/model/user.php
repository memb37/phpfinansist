<?php

class Model_User extends Model {
    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($id = null) {
        global $db;
        if($id) {
            $stmt = $db->prepare("SELECT `user_id` ,`user_name`, `email`, `password`
                                FROM users WHERE user_id= :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch();
	    
            if($row) {
                $this->from_array(array(
                    'id' => $row['user_id'],
                    'name' => $row['user_name'],
                    'email' => $row['email'],
                    'password' => $row['password']
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
            $_SESSION['user'] = array('id' => $user->id, 'name' => $user->name);
            return false;
        } else {
            return array("message" => "Неверный логин или пароль");
        }
    }

    public function create() {
        if(self::find_by_email($this->email)) {
            return array("message" => "Пользователь с адресом $this->email уже существует в базе данных");
        }
        $this->save();
    }

    public function save() {
        global $db;
        $password = self::hashed_password($this->password);
        $name = htmlspecialchars($this->name);
        $email = htmlspecialchars($this->email);
        $stmt = $db->prepare("INSERT INTO users (password, user_name, email)
                            VALUES (:password, :user_name, :email)");
        $data = array('password'  => $password,
                      'user_name' => $name, 'email' => $email);
        $stmt->execute($data);
    }

    public static function logout() {
        unset($_SESSION['user']);
    }
}