<?php

class Route {
    static function start() {
        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';
        $_parsed = parse_url(BASE_URL);
        $exploded = explode('?', $_SERVER["REQUEST_URI"]);
        $request_uri = (string)substr($exploded[0], strlen($_parsed['path']));
        $routes = explode('/', trim($request_uri, '/'));

        // получаем имя контроллера
        if(!empty($routes[0])) {
            $controller_name = $routes[0];
        }

        // получаем имя экшена
        if(!empty($routes[1])) {
            $action_name = $routes[1];
        }

        // добавляем префиксы
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;


        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->exec_action($action);
        } else {
            throw new Exception('404');
        }

    }


}
