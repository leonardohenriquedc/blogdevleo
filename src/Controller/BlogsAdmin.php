<?php

namespace App\Controller;

use App\Dto\BlogInput;
use App\Service\BlogsAdminService;
use App\Dto\Login;
use App\Service\Auth;
use App\Core\Controller;
use DateTime;

class BlogsAdmin extends Controller
{
    private BlogsAdminService $blogService;
    private Auth $serverAuth;

    public function __construct()
    {
        $this->blogService = new BlogsAdminService();
        $this->serverAuth = new Auth();
    }

    public function newBlog()
    {
        $token = $_COOKIE["token"] ?? "";

        if (empty($token)) {
            redirect("/blogs/to_error");
            exit();
        }

        $this->view("new_blog", []);
        exit();
    }

    public function saveBlog()
    {
        $token = $_COOKIE["token"] ?? "";

        if (empty($token)) {
            redirect("/blogs/to_home");
            exit();
        }

        $result = $this->serverAuth->validateToken($token);

        if ($result === null) {
            redirect("/blogs/to_home");
            exit();
        }

        setcookie("token", $result, time() + 3600);

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

        $result = $this->blogService->createBlog($blogData);

        if ($result === false) {
            echo "Erro ao inserir blog";
        }

        header("Location: /blogs/to_blog/" . strtolower($title) . ".md");
        exit();
    }
}
