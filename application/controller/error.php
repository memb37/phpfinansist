<?php
class Controller_Error extends Controller {

    public function __construct() {
        set_exception_handler(array($this, 'handler'));
        $this->view = new View();
    }

    public function handler($exception) {
        if($exception->getMessage() == 404) {

            $this->view->generate('error/404.php');
        }
        else {
            $this->view->generate('error/500.php');
        }

    }

}
