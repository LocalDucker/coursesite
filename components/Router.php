<?php

class Router {

    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        // Видаляємо пробіли і "/"
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        $uri = $this->getURI();
        if($uri == ''){
            $uri = 'login';
        }

        $foundMatch = false;

        foreach ($this->routes as $uriPattern =>$path){
            // перевіряємо чи є в роутах такий патерн,
            // якщо є, тоді заміняємо. Створюємо назву і підключаємо файли.
            if($foundMatch = preg_match("~$uriPattern~", $uri)){
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // розбиваємо строку на масиви
                $segments = explode('/', $internalRoute);

                // видаляємо з масиву перший елемент (це і є наш контроллер) та запам'ятовуємо його
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);


                $actionName = 'action'.ucfirst(array_shift($segments));

                $parameters = $segments;

                $controllerFile = ROOT . '/controllers/' .$controllerName. '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }else{
                    echo ' controller not exists';
                    break;
                }

                $controllerObject = new $controllerName;
                try {
                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                }catch (Exception $ex){
                    echo 'Not exists method';
                    break;
                }
				if ($result != null) {
                    break;
                }
            }
        }

        if($foundMatch == false){
            echo '404';
        }
    }

}



?>

