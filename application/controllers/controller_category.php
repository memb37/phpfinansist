<?php
require 'application/models/model_category.php';

class Controller_Category extends Controller
{
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
	    header('Location: ' . BASE_URL . '/category');
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
	    header('Location: ' . BASE_URL . '/category');
	    exit();
	}

    }
    
    public function action_delete() {
	$cat = new Model_Category($_REQUEST['id']);
	$cat->delete();
	header('Location: ' . BASE_URL . '/category');
	exit();
    }
    
    
    
    function _action_index()
    {
	
	// Create
	$category = new Model_Category();
	$category->category_name = $_POST['catgory_name'];
	$category->category_type = $_POST['catgory_type'];
	$category->save();
	
		$this->model = new Model_Category();
		if (isset($_POST['add_category']))
			{
			$this->model->add_category();			
			$data = $this->model->get_categories($_POST['category_type_id']);
			}

		elseif (isset($_POST['delete_category']))
			{$this->model->delete_category();
			$data = $this->model->get_categories($_POST['category_type_id']);
			}

		elseif (isset($_POST['edit_category']) and isset($_POST['category_id']))
			{$this->model->edit_category();
			$data = $this->model->get_categories($_POST['category_type_id']);
			}

		elseif (isset($_POST['edit2']))
			{$data = $this->model->get_categories(2);}

		else
			{$data = $this->model->get_categories(1);}
        $this->view->generate('category_view.php', $data);
    }
}
