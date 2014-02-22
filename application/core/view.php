<?php
class View
{
    public $template = 'template_view.php';
  
    function generate($content_view, $data = null)
    {
        include 'application/views/'.$this->template;
    }
}
