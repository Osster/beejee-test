<?php

namespace App\Controllers;

use App\Kernel;
use Symfony\Component\HttpFoundation\Response;

class Controller extends \Buki\Router\Http\Controller
{
    protected function render(string $template, ...$args): Response
    {
        try {

            $templatePath = Kernel::ViewsDir($template);

            // make arguments accessible as vars
            if (count($args[0]) > 0) {
                foreach ($args[0] as $name => $value) {
                    $$name = $value;
                }
            }

            ob_start();

            require_once($templatePath);

            $content = ob_get_contents();

            ob_end_clean();

        } catch (\Exception $e) {

            $trace = $e->getTraceAsString();

            Kernel::$log->error($trace);

            $content = $e->getMessage() . " " . $e->getFile() . ":" . $e->getLine();
        }

        return new Response($content);
    }
}
