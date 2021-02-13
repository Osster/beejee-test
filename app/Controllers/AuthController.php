<?php
namespace App\Controllers;

use App\Entities\User;
use App\Kernel;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function index()
    {
        return "Auth page";
    }

    public function loginForm(): Response
    {
        if(Kernel::isLoggedIn()) {

            return new RedirectResponse(Kernel::route("/"));

        }

        return $this->render("pages/auth_login.php", []);
    }

    public function login(Request $request): Response
    {
        $data = [
            "name" => strip_tags($request->get("name", "")),
            "pass" => strip_tags($request->get("pass", "")),
            "pass_hash" => password_hash(strip_tags($request->get("pass", "")), PASSWORD_DEFAULT),
        ];

        $users = User::where(["name" => $data["name"]])->get();

        $currentUser = null;

        foreach ($users as $user) {
            if(password_verify($data["pass"], $user->pass)) {
                $currentUser = $user;
                break;
            }
        }

        if ($currentUser) {

            Kernel::$session->set("auth", $currentUser->pass);

            Kernel::$session->set("user", $currentUser->id);

            Kernel::$session->set("name", $currentUser->name);

            return new RedirectResponse(Kernel::route("/admin"));

        }

        return $this->render("pages/auth_login.php", []);
    }

    public function registerForm()
    {
        return $this->render("pages/auth_register.php", []);
    }

    public function register(Request $request)
    {
        $data = [
            "name" => strip_tags($request->get("name", "")),
            "pass" => strip_tags($request->get("pass", "")),
            "confirm_pass" => strip_tags($request->get("confirm_pass", "")),
            "pass_hash" => password_hash(strip_tags($request->get("pass", "")), PASSWORD_DEFAULT),
        ];

        $user = new User();

        $user->fill($data);

        if (!$user->validate($data)) {

            return $this->render("pages/auth_register.php", [
                "form_data" => $data,
                "errors" => $user->getErrors(),
            ]);

        }

        $user->pass = $data["pass_hash"];

        $user->save();

        return new RedirectResponse(Kernel::route("/login"));
    }

    public function logout()
    {
        Kernel::$session->remove("auth");

        Kernel::$session->remove("user");

        Kernel::$session->remove("name");

        return new RedirectResponse(Kernel::route("/"));
    }
}
