<?php

class Model_Operation {
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
}