<?php

namespace App;

use Buki\Router\Router;
use Dotenv\Dotenv;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\HttpFoundation\Session\Session;

class Kernel
{
    public static $env;

    public static $log;

    public static $router;

    public static $session;

    public static function init()
    {
        self::initEnv();

        try {

            self::initLog();

            self::initDB();

            self::initSession();

            self::initRouter();

        } catch (\Exception $e) {

            $trace = $e->getTraceAsString();

            self::$log->error($trace);

            die($e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine());

        }
    }

    public static function ViewsDir(string $path = ""): string
    {
        $templatePath = dirname(__DIR__, 1) . "/app/Views/{$path}";

        if (!file_exists($templatePath)) {
            throw new \Exception("View not exists at '{$path}'");
        }

        return $templatePath;
    }

    public static function isLoggedIn(): bool
    {
        return self::$session instanceof Session
            && self::$session->get("user")
            && self::$session->get("auth");
    }

    public static function user(): object
    {
        if (self::isLoggedIn()) {
            return (object) [
                "id" => self::$session->get("user"),
                "name" => self::$session->get("name")
            ];
        } else {
            return (object) [
                "id" => null,
                "name" => "Guest"
            ];
        }
    }

    public static function route($path = "")
    {
        $appDir = getenv('APP_DIR');

        $route = preg_replace("/\/\//", "/", "{$appDir}{$path}");

        return $route;
    }

    protected static function initEnv()
    {
        try {

            if (file_exists(dirname(__DIR__, 1) . '/.env')) {

                self::$env = Dotenv::createUnsafeImmutable(dirname(__DIR__, 1), '.env');

                self::$env->load();

            }

        } catch (\Exception $e) {

            die($e->getMessage());

        }
    }

    protected static function initLog()
    {
        self::$log = new Logger('app');

        self::$log->pushHandler(new StreamHandler(__DIR__ . "/Log/app.log", Logger::DEBUG));

        self::$log->pushHandler(new FirePHPHandler());
    }

    protected static function initDB()
    {
        $config = [

            "driver" => getenv("DB_DRIVER") ?: "mysql",

            "host" => getenv("DB_HOST") ?: "127.0.0.1",

            "database" => getenv("DB_DATABASE") ?: "test",

            "username" => getenv("DB_USER") ?: "root",

            "password" => getenv("DB_PASS") ?: ""

        ];

        $capsule = new Capsule;

        $capsule->addConnection($config);

        //Make this Capsule instance available globally.
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM.
        $capsule->bootEloquent();
    }

    protected static function initRouter()
    {
        self::$router = new Router([
            'paths' => [
                'controllers' => '../app/Controllers',
                'middlewares' => '../app/Middlewares',
            ],
            'namespaces' => [
                'controllers' => 'App\Controllers',
                'middlewares' => 'App\Middlewares',
            ],
        ]);

        require_once(__DIR__ . "/routes.php");

        self::$router->run();
    }

    protected static function initSession()
    {
        self::$session = new Session();

        self::$session->start();
    }
}
