<?php
class Controller_Operation extends Controller
{

    function __construct()
    {
        $this->model = new Model_Operation();
        $this->view = new View();
    }
    
    function action_index()
    {	
		if (isset($_POST['add_op']))
			{$this->model->add_data();}
        $data = $this->model->get_data();		
        $this->view->generate('operation_view.php', 'template_view.php', $data);
    }
}
