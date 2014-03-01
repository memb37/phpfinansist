<?php
require 'application/models/model_category.php';

class Controller_Category extends Controller {
    public function action_index() {
        $categories = Model_Category::find_all($_SESSION['user']['id']);
        $this->view->generate('category/list.php', array('categories' => $categories));
    }

    public function action_create() {
        $cat = new Model_Category();
        $this->view->generate('category/form.php',
            array('category' => $cat, 'action' => 'category/create'));
        if(!empty($_POST)) {
            $cat->name = $_POST['category_name'];
            $cat->user_id = $_SESSION['user']['id'];
            $cat->save();
            header('Location: '.BASE_URL.'/category');
            exit();
        }
    }

    public function action_edit() {
        $category = new Model_Category($_REQUEST['id']);
        $this->view->generate('category/form.php',
            array('category' => $category, 'action' => 'category/edit'));
        if(!empty($_POST)) {
            $category->name = $_POST['category_name'];
            $category->save();
            header('Location: '.BASE_URL.'/category');
            exit();
        }
    }

    public function action_delete() {
        $cat = new Model_Category($_REQUEST['id']);
        $cat->delete();
        header('Location: '.BASE_URL.'/category');
        exit();
    }

}
