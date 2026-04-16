<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Exceptions\CrendentialsExceptions;
use App\Core\Session;
use App\Model\User;

class Auth extends Controller
{
    public function login()
    {
        $this->view("login", ["error" => Session::flash("error")]);
    }

    public function validate()
    {
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"] ?? null;
            $password = $_POST["password"] ?? null;

            if ($email === null || $password === null) {
                throw new Exception("Layers null");
            }

            $user = new User("", $email, $password);

            try {
                $token = $user->validateLogin();

                if (!$token) {
                    $this->view("login", [
                        "error" => "Falha interna tente novamente",
                    ]);
                    exit();
                }

                setcookie("token", $token, time() + 3600, "/");
                redirect("/blogs/to_home");
                exit();
            } catch (CrendentialsExceptions $e) {
                Session::set("error", $e->getMessage());
                redirect("/auth/login");
            } catch (Exception $e) {
                $this->view("login", [
                    "error" => "Falha interna tente novamente",
                ]);
            }
        }
    }
}
