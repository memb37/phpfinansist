<?php
class Controller_Category extends Controller
{
    function action_index()
    {	
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
        $this->view->generate('category_view.php', 'template_view.php',$data);
    }
}
