<?php
error_reporting('E_ALL');
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', [\App\Http\Controllers\MainController::class, 'mainIndex']);
    $route->addRoute('POST', '/login', [\App\Http\Controllers\Auth\LoginController::class, 'authLogin']);
    $route->addRoute('POST', '/registration', [\App\Http\Controllers\Auth\RegistrationController::class, 'regUser']);
    $route->addRoute('GET', '/home', [\App\Http\Controllers\HomeController::class, 'index']);
});

GetChannel($dispatcher, $_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
function GetChannel($dispatcher, $httpMethod, $uri) {


// Strip query string (?foo=bar) and decode URI
    if (false !== $pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }

    $uri = rawurldecode($uri);

    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

    if ($routeInfo[0] === 1) {
        list($class, $method) = $routeInfo[1];
        if (class_exists($class)) {
            $obj = new $class();
            if (method_exists($obj, $method)) {
                $obj->$method($routeInfo[2]);
            }
        }
    } else {
        throw new Exception('Страница Не существует!!!');
    }
}
