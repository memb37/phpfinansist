<?php

require 'application/models/model_operation.php';
require 'application/models/model_category.php';

class Controller_Operation extends Controller {
    function action_index() {
        if(!empty($_POST)) {
            $operation = new Model_Operation();
            $operation->category_id = ($_POST['cat_id']) ? : null;
            $operation->comment = $_POST['comment'];
            $operation->date = $_POST['date'];
            $operation->summ = $_POST['summ'];
            $operation->user_id = $_SESSION['user']['id'];
            $operation->save($_POST['op_type']);
        }
        $categories = Model_Category::find_all($_SESSION['user']['id']);
        $this->view->generate('operation/add.php', array('categories' => $categories));
    }

    function action_report() {
        $date_from = (isset($_POST['date_from'])) ? $_POST['date_from'] : date('Y-m-01');
        $date_to = (isset($_POST['date_to'])) ? $_POST['date_to'] : date('Y-m-d');
        $operations = Model_Operation::report($_SESSION['user']['id'], $date_from, $date_to);
        $this->view->generate('operation/report.php', array('operations' => $operations,
                                                       'date_from'  => $date_from,
                                                       'date_to'    => $date_to));
    }


}

