<?php
class Controller_Operation extends Controller
{

    function action_index()
    {	
		$this->model = new Model_Operation();
		if (isset($_POST['add_op']))
			{$this->model->add_data();}
        $data = $this->model->get_data();		
        $this->view->generate('operation_view.php', 'template_view.php', $data);
    }
}
