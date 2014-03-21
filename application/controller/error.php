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
            $this->LogWrite($exception->getMessage(), $exception->getFile(), $exception->getLine());
            $this->view->generate('error/500.php', array('fatal' => false));
        }

    }

    public function FatalErrorHandler() {
        $error = error_get_last();
        if(isset($error)) {
            ob_end_clean();
            $this->LogWrite($error['message'], $error['file'], $error['line'], 'fatal');
            $this->view->generate('error/500.php', array('fatal' => true));
        }
    }

    public function LogWrite($message, $file, $line, $level = 'error') {
        $logfile = BASE_PATH . 'logs/' . date('d.m.y') . 'error.log';
        error_log('PHP ' . $level . ' : ' . $message . ' in ' . $file . ' on line ' . $line . "\n", 3, $logfile);
    }
}
