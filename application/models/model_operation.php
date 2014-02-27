<?php

class Model_Operation extends Model {
    public $id;
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
			WHERE operations.user_id = :id
			AND date BETWEEN :date_from AND :date_to
			ORDER BY date DESC, operation_id DESC ");
        $stmt->bindParam(':id', $user_id);
        $stmt->bindParam(':date_from', $date_from);
        $stmt->bindParam(':date_to', $date_to);
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $op = new Model_Operation();
            $op->id = $row['operation_id'];
            $op->summ = $row['summ'];
            $op->date = $row['date'];
            $op->comment = $row['comment'];
            $op->category_name = $row['category_name'];
            $result[] = $op;
        }
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
            VALUES (:user_id, :cat_id, :summ, :date, :comm)");
        $data = array(
            'user_id' => $this->user_id,
            'cat_id' => $this->category_id,
            'summ' => $this->summ,
            'date' => $this->date,
            'comm' => $this->comment);
        $stmt->execute($data);



    }
}