<?php
class Controller_Lk extends Controller
{
    function __construct()
    {
        $this->model = new Model_lk();
        $this->view = new View();
    }

    function action_index()
    {	
		$data = $this->model->get_data();
        $this->view->generate('lk_view.php', 'template_view.php', $data);
    }
}
