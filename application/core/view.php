<?php

class View {
    public $template = 'template_view.php';

    function generate($content_view, $data=array()) {
        extract($data);
        include BASE_PATH . 'application/views/'.$this->template;
    }
}
