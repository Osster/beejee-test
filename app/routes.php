<?php

use App\Kernel;
use Buki\Router\Router;

$router = Kernel::$router;

if ($router instanceof Router) {

    $router->get(Kernel::route("/"), "HomeController@index");

    $router->get(Kernel::route("/create"), "HomeController@edit");

    $router->post(Kernel::route("/store"), "HomeController@store");

    $router->get(Kernel::route("/login"), "AuthController@loginForm");

    $router->post(Kernel::route("/login"), "AuthController@login");

    $router->get(Kernel::route("/register"), "AuthController@registerForm");

    $router->post(Kernel::route("/register"), "AuthController@register");

    $router->get(Kernel::route("/logout"), "AuthController@logout");

    $router->get(Kernel::route("/install"), "InstallController@index");

    $router->get(Kernel::route("/admin"), "AdminHomeController@index", ['before' => 'AuthMiddleware']);

    $router->get(Kernel::route("/admin/edit/:id"), "AdminHomeController@edit", ['before' => 'AuthMiddleware']);

    $router->post(Kernel::route("/admin/store/:id"), "AdminHomeController@store", ['before' => 'AuthMiddleware']);

    $router->post(Kernel::route("/admin/delete/:id"), "AdminHomeController@delete", ['before' => 'AuthMiddleware']);

}
