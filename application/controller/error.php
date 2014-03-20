<?php

class Controller_Error extends Controller {

    public function __construct() {
        set_exception_handler(array($this, 'handler'));
        register_shutdown_function(array($this, 'FatalErrorHandler'));
        $this->view = new View();
        ob_start();
    }

    public function handler($exception) {
        if($exception->getMessage() == 404) {

            $this->view->generate('error/404.php');
        } else {
            error_log($exception, 3, BASE_PATH.'error.log');
            $this->view->generate('error/500.php', array('fatal' => false));
        }

    }

    public function FatalErrorHandler() {
        $error = error_get_last();
        if(isset($error)) {
            ob_end_clean();
            error_log("PHP Fatal: ".$error['message']." in "
                .$error['file'].":".$error['line']."\n", 3, BASE_PATH.'error.log');
            $this->view->generate('error/500.php', array('fatal' => true));
        }
    }


}
