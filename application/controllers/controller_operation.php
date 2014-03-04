<?php

require '../application/models/model_operation.php';
require '../application/models/model_category.php';

class Controller_Operation extends Controller {
    public function action_index() {
        $date_from = isset($_GET['date_from']) ? $_GET['date_from'] : date('Y-m-01');
        $date_to = isset($_GET['date_to']) ? $_GET['date_to'] : date('Y-m-d');
        $operations = Model_Operation::report($_SESSION['user']['id'], $date_from, $date_to);
        $this->view->generate('operation/list.php', array('operations' => $operations,
                                                          'date_from'  => $date_from,
                                                          'date_to'    => $date_to));
    }


    public function action_create() {
        if(!empty($_POST)) {
            $operation = new Model_Operation();
            $this->set_properties($operation);
	        $operation->save($_GET['optype']);
            $this->go_page('operation');
        }
        $categories = Model_Category::find_all($_SESSION['user']['id']);
        $this->view->generate('operation/form.php', array('categories' => $categories));

    }

    private function set_properties($operation) {
        $operation->category_id = ($_POST['cat_id']) ? : null;
        $operation->comment = $_POST['comment'];
        $operation->date = $_POST['date'];
        $operation->summ = $_POST['summ'];
        $operation->user_id = $_SESSION['user']['id'];
    }
}

