<?php

class Controller_Error extends Controller {

    public static function exception_error_handler($errno, $errstr, $errfile, $errline) {
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }

    public static function exception_handler($exception) {
        $controller_error = new Controller_Error();
        if($exception->getMessage() == 404) {
            $controller_error->view->generate('error/404.php');
        } else {
            $controller_error->LogWrite($exception->getMessage(), $exception->getFile(), $exception->getLine());
            $controller_error->view->generate('error/500.php', array('fatal' => false));
        }
    }

    public static function FatalErrorHandler() {
        $error = error_get_last();
        if(isset($error)) {
            ob_end_clean();
            $controller_error = new Controller_Error();
            $controller_error->LogWrite($error['message'], $error['file'], $error['line'], 'fatal');
            $controller_error->view->generate('error/500.php', array('fatal' => true));
        }
    }

    public function LogWrite($message, $file, $line, $level = 'error') {
        $logfile = BASE_PATH . 'logs/' . date('d.m.y') . 'error.log';
        error_log('PHP ' . $level . ' : ' . $message . ' in ' . $file . ' on line ' . $line . "\n", 3, $logfile);
    }
}
