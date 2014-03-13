<?php

class Model_Operation extends Model {
    public $operation_id;
    public $summ;
    public $date;
    public $comment;
    public $user_id;
    public $category_name;
    public $category_id;

    public static function report($user_id, $date_from, $date_to) {
        global $db;
        $result = array();
        $stmt = $db->prepare("SELECT operation_id, date,
            category_name,	summ,  comment
			FROM operations LEFT JOIN categories USING(category_id)
			WHERE operations.user_id = :user_id
			AND date BETWEEN :date_from AND :date_to
			ORDER BY date DESC, operation_id DESC ");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':date_from', $date_from);
        $stmt->bindParam(':date_to', $date_to);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }

    public function save($optype) {
        global $db;
        if($optype == 'minus') {
            $this->summ *= -1;
        }
        $this->comment = htmlspecialchars($this->comment);
        $stmt = $db->prepare("INSERT INTO operations
            (user_id, category_id, summ, date, comment)
            VALUES (:user_id, :category_id, :summ, :date, :comment)");
        $data = array(
            'user_id'     => $this->user_id,
            'category_id' => $this->category_id,
            'summ'        => $this->summ,
            'date'        => $this->date,
            'comment'     => $this->comment);
        $stmt->execute($data);
    }

    public static function validate($summ, $date, $comment) {
        if(!is_numeric($summ)) {
            $error[] =("Сумма должна быть числом");
        }
        if(!preg_match('/(19|20)\d\d-((0[1-9]|1[012])-(0[1-9]|[12]\d)|(0[13-9]|1[012])-30|(0[13578]|1[02])-31)$/', $date)) {
            $error[] =("Введите дату в формате ГГГГ-ММ-ДД");
        }
        if(strlen($comment) > 255) {
            $error[] =("Комментарий должен быть не более 255 символов");
        }
        return $error;
    }
}