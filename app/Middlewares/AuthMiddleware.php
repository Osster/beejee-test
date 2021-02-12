<?php
namespace App\Middlewares;

use App\Kernel;
use Buki\Router\Http\Middleware;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthMiddleware extends Middleware
{
    public function handle()
    {
        if (!Kernel::isLoggedIn()) {

            return new RedirectResponse("/login");

        }

        return true;
    }
}
