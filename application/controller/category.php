<?php

class Controller_Category extends Controller {

    public function action_index() {
        $categories = Model_Category::find_all($_SESSION['user']['id']);
        $this->view->generate('category/list.php', array('categories' => $categories));
    }

    public function action_create() {
        $error = array();
        $cat = new Model_Category();
        if(!empty($_POST)) {
                $cat->name = $_POST['category_name'];
                $cat->user_id = $_SESSION['user']['id'];
                $error = $cat->validate();
                if(empty($error)) {
                    $cat->save();
                    $this->go_page('category');
                }
        }
        $this->view->generate('category/form.php',
            array('category' => $cat, 'action' => 'category/create', 'message' => $error));
    }

    public function action_edit() {
        $error = array();
        $category = new Model_Category($_REQUEST['id']);
        if(!empty($_POST)) {
                $category->name = $_POST['category_name'];
                $error = $category->validate();
                if(empty($error)) {
                    $category->save();
                    $this->go_page('category');
            }
        }
        $this->view->generate('category/form.php',
            array('category' => $category, 'action' => 'category/edit', 'message' => $error));
    }

    public function action_delete() {
        $cat = new Model_Category($_REQUEST['id']);
        $cat->delete();
        $this->go_page('category');
    }

}
