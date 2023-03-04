<?php

namespace Test\Test\Component;


class Router
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes[$_SERVER['REQUEST_METHOD']];
    }

    public function run()
    {
        // echo print_r($this->routes);
        $uri = $this->getUri();
        foreach ($this->routes as $routeUri => $routeInternal) {
            if (!preg_match("~$routeUri~", $uri)) {
                continue;
            }


            $routeInternal = preg_replace("~$routeUri~", $routeInternal, $uri); // 'users\/([0-9]+)' (users/444) => 'users/view/$1' 
echo $routeInternal;
            $routeInternalParts = explode('/', $routeInternal); // "users/1" => ['users', 'view', '1']

            $controllerName = CONTROLLER_NAMESPACE . '\\' . ucfirst(array_shift($routeInternalParts)) . '\\' . ucfirst(array_shift($routeInternalParts)) . 'Controller'; // App\Mvc\Controller\MainController
            $actionName = 'action' . ucfirst(array_shift($routeInternalParts)); // "actionIndex"

            $controller = new $controllerName(); // создали объект класса MainController
            $controller->$actionName(...$routeInternalParts); // вызываем метод actionIndex() ['1', '3'] => function actionName($firstValue, $secondValue)

            return;
        }

        echo '404 not found!';
    }

    private function getUri(): string
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }


}




// namespace App\Telegram\Component;

// class Router
// {
//     private array $routes;

//     public function __construct(array $routes)
//     {
//         $this->routes = $routes;
//     }

//     public function run()
//     {
//         $uri = $this->getUri();
//         if (isset($_REQUEST['json'])){  // если в урле есть запрос на возврат JSON
//         $jsonRequest = $_REQUEST['json'];
//     } else {
//             $jsonRequest = 0;
//         }



//         foreach ($this->routes as $routeUri => $routeInternal) {
//             preg_match("#$routeUri#", $uri, $uri_params);

//             $upar = array_shift($uri_params);

//             if ($uri !== $upar) {
//                 continue;
//             }

//             // Тут мы нашли роут

//             $routeInternalParts = explode('/', $routeInternal); // "main/index" => ['main', 'index']
//             $controllerName = CONTROLLER_NAMESPACE . '\\' . ucfirst(array_shift($routeInternalParts)) . 'Controller'; // App\Mvc\Controller\MainController
//             $actionName = 'action' . ucfirst(array_shift($routeInternalParts)); // "actionIndex"


//             $parameterstmp = explode('/', $uri);
//             $parameters = [];
//             foreach ($parameterstmp as $params) {
//                 if (is_numeric($params)) {
//                     $parameters[] = $params;
//                 }
//             }

//             $controller = new $controllerName(); // создали объект класса MainController

//             if (count($parameters) === 1) {
//                 if ($jsonRequest == 1) { //Если идет запрос json то переделаем параметр 1, иначе - 0
//                     $controller->$actionName(array_shift($parameters), 1); // вызываем метод actionIndex(). Идет запрос json
//                 } else {
//                     $controller->$actionName(array_shift($parameters)); // вызываем метод actionIndex(). Запроса json НЕТ
//                 }
//                 return;
//             }
//             if (count($parameters) == 2) {
//                 if ($jsonRequest == 1) {
//                     $controller->$actionName(array_shift($parameters),array_shift($parameters), 1); // вызываем метод actionIndex(). Идет запрос json
//                 } else {
//                     $controller->$actionName(array_shift($parameters), array_shift($parameters)); // вызываем метод actionIndex(). Запроса json НЕТ
//                 }
//                 return;
//             }
//             $controller->$actionName();
//             return;
//         }
//         echo '404 not found!';
//     }

//     private function getUri(): string
//     {
//         $uritemp = explode('?', $_SERVER['REQUEST_URI']);

//         return trim($uritemp[0], '/'); // "/users/1/create/" => "users/1/create"
//     }
// }