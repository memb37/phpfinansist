<?php
class Route
{
    static function start()
    {	
        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';
        $_parsed = parse_url(BASE_URL);
        $request_uri = (string)substr($_SERVER["REQUEST_URI"], strlen($_parsed['path']));
        $routes = explode('/', trim($request_uri, '/'));

        // получаем имя контроллера
        if ( !empty($routes[0]) )
        {	
            $controller_name = $routes[0];
        }
        
        // получаем имя экшена
        if ( !empty($routes[1]) )
        {
            $action_name = $routes[1];
        }

        // добавляем префиксы
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;
   
        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;

        if(file_exists($controller_path))
        {
            include "application/controllers/".$controller_file;
        }
        else
        {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            Route::ErrorPage404();
        }
        
        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;
        
        if(method_exists($controller, $action))
        {
            // вызываем действие контроллера
            $controller->exec_action($action);
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }
    
    }
    
    public static function ErrorPage404()
    {
        header('HTTP/1.1 404 Not Found', true, 404);
        exit('<h1>404 Not found</h1>');
    }
}
