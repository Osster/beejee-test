<?php
namespace App\Controllers;

use App\Entities\Task;
use App\Kernel;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminHomeController extends Controller
{
    public function index(Request $request): Response
    {
        $sort = [
            $request->get("sort_col", "id"),
            $request->get("sort_dir", "DESC"),
        ];

        $tasks = Task::query()
            ->orderBy(...$sort)
            ->paginate(5, ["*"], "p", $request->get("p", 1))
            ->setPath($request->getUri());

        $messages = Kernel::$session->getFlashBag()->get('notice', []);

        return $this->render("pages/admin_index.php", [
            "title" => getenv("APP_NAME"),
            "items" => $tasks,
            "sort" => $sort,
            "messages" => $messages,
        ]);
    }

    public function edit(int $id): Response
    {
        $task = Task::findOrFail($id);

        return $this->render("pages/admin_edit.php", [
            "form_data" => $task,
        ]);
    }

    public function store(Request $request, int $id): RedirectResponse
    {
        $task = Task::findOrFail($id);

        $formData = [
            "content" => strip_tags($request->get("content", "")),
            "state" => (bool) $request->get("state", false),
        ];

        $task->fill($formData);

        if ($task->validate()) {

            if ($task instanceof Task) {
                $dirty = $task->getDirty();

                if (isset($dirty["content"])) {

                    $task->updated_by = Kernel::user()->id;

                }

            }

            $task->save();

            Kernel::$session->getFlashBag()->add("notice", "Задача сохранена");

            return new RedirectResponse(Kernel::route("/admin"));

        } else {

            return $this->render("pages/index_create.php", [
                "form_data" => $formData,
                "errors" => $task->getErrors(),
            ]);

        }

    }

    public function delete(int $id): RedirectResponse
    {
        $task = Task::findOrFail($id);

        $task->delete();

        Kernel::$session->getFlashBag()->add("notice", "Задача удалена");

        return new RedirectResponse(Kernel::route("/admin"));
    }
}
