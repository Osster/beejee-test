<?php

use App\Kernel;
use Buki\Router\Router;

$router = Kernel::$router;

if ($router instanceof Router) {

    $router->get("/", "HomeController@index");

    $router->get("/create/", "HomeController@edit");

    $router->post("/store/", "HomeController@store");

    $router->get("/login/", "AuthController@loginForm");

    $router->post("/login/", "AuthController@login");

    $router->get("/register/", "AuthController@registerForm");

    $router->post("/register/", "AuthController@register");

    $router->get("/logout/", "AuthController@logout");

    $router->get("/install/", "InstallController@index");

    $router->get("/admin", "AdminHomeController@index", ['before' => 'AuthMiddleware']);

    $router->get("/admin/edit/:id", "AdminHomeController@edit", ['before' => 'AuthMiddleware']);

    $router->post("/admin/store/:id", "AdminHomeController@store", ['before' => 'AuthMiddleware']);

    $router->post("/admin/delete/:id", "AdminHomeController@delete", ['before' => 'AuthMiddleware']);

}
