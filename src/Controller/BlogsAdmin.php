<?php

namespace App\Controller;

use App\Dto\BlogInput;
use App\Service\BlogsAdminService;
use App\Dto\Login;
use App\Service\Auth;
use DateTime;

class BlogsAdmin
{
    private BlogsAdminService $blogService;

    public function __construct()
    {
        $this->blogService = new BlogsAdminService();
    }

    public function newBlog()
    {
        include __DIR__ . "/../../view/new_blog.php";
        exit();
    }

    public function saveBlog()
    {
        $blogData = new BlogInput();

        $password = $_POST["password"] ?? "";

        $date = new DateTime($_POST["date"]);

        $title = $_POST["title"] ?? "";

        $author = $_POST["author"] ?? "";

        $content = $_POST["content"] ?? "";

        $blogData->title = $title;
        $blogData->date = $date;
        $blogData->author = $author;
        $blogData->content = $content;

        //debug temporario de senha
        if ($password !== "admin" || empty($password)) {
            echo "nao sobrou nada pro beta kkk";
        }

        $result = $this->blogService->createBlog($blogData);

        if ($result === false) {
            echo "Erro ao inserir blog";
        }

        header("Location: index.php?to=blog&title=" . $title . ".md");
        exit();
    }

    public function toLoginPage()
    {
        include __DIR__ . "/../../view/login.php";
        exit();
    }

    public function login()
    {
        $password = $_POST["password"];
        $email = $_POST["email"];

        if ($email === "" || $password === "") {
            header("Location: index.php?to=home");
            exit();
        }

        $login = new Login();
        $login->email = $email;
        $login->password = $password;

        try {
            $serverAuth = new Auth();
            $token = $serverAuth->validateLogin($login);

            setCookie("auth_token", $token, time() + 3600, "/");

            header("Location: index.php?to=new_blog");
            exit();
        } catch (Exception $e) {
            header("Location: index.php?to=error");
            exit();
        }
    }
}
