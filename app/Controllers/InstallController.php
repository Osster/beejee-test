<?php
namespace App\Controllers;

use App\Kernel;
use Illuminate\Database\Schema\Blueprint;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Database\Capsule\Manager as Capsule;

class InstallController extends Controller
{
    public function index(): Response
    {

        Capsule::schema()->create('users', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name');

            $table->string('pass');

            $table->timestamps();

        });

        Capsule::schema()->create('tasks', function (Blueprint $table) {

            $table->increments('id');

            $table->string('user_name');

            $table->string('user_email');

            $table->string('content');

            $table->boolean('state')->default(false);

            $table->timestamps();

        });

        Capsule::table('users')->insert([
            "name" => "admin",
            "pass" => password_hash("123", PASSWORD_DEFAULT),
        ]);

        Capsule::table('tasks')->insert([
            ["user_name" => "Alex", "user_email" => "test1@app.com", "content" => "TODO following tasks for Alex... "],
            ["user_name" => "Peter", "user_email" => "test2@app.com", "content" => "TODO following tasks for Peter... "],
            ["user_name" => "Jack", "user_email" => "test2@app.com", "content" => "TODO following tasks for Jack... "],
        ]);


        return new RedirectResponse(Kernel::route("/"));
    }
}
