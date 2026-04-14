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
        $this->handle("AuthMiddleware");

        $this->view("new_blog", []);
        exit();
    }

    public function saveBlog()
    {
        $this->handle("AuthMiddleware");

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

        redirect("/blogs/to_blog/" . strtolower($title));
        exit();
    }
}
