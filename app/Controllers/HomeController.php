<?php

namespace App\Controllers;

use App\Entities\Task;
use App\Kernel;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function index(Request $request): Response
    {
        $sort = [
            $request->get("sort_col", "id"),
            $request->get("sort_dir", "DESC"),
        ];

        $tasks = Task::query()
            ->orderBy(...$sort)
            ->paginate(3, ["*"], "p", $request->get("p", 1))
            ->setPath($request->getUri());

        return $this->render("pages/index.php", [
            "title" => getenv("APP_NAME"),
            "items" => $tasks,
            "sort" => $sort,
        ]);
    }

    public function edit(Request $request): Response
    {
        return $this->render("pages/index_edit.php", []);
    }

    public function store(Request $request): Response
    {
        $formData = [
            "user_name" => strip_tags($request->get("user_name", "")),
            "user_email" => strip_tags($request->get("user_email", "")),
            "content" => strip_tags($request->get("content", "")),
            "state" => strip_tags($request->get("state", false)),
        ];

        $task = new Task($formData);

        if ($task->validate()) {

            $task->save();

            return new RedirectResponse(Kernel::route("/"));

        } else {

            return $this->render("pages/index_create.php", [
                "form_data" => $formData,
                "errors" => $task->getErrors(),
            ]);

        }

    }
}
