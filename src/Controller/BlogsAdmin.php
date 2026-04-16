<?php

namespace App\Controller;

use App\Service\BlogsAdminService;
use App\Core\Controller;
use DateTime;
use App\Model\User;
use App\Model\Blog;

class BlogsAdmin extends Controller
{
    private Blog $blog;
    private User $user;

    public function __construct()
    {
        $this->blog = new Blog();
        $this->user = new User();
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

        $password = $_POST["password"] ?? "";

        $date = new DateTime($_POST["date"]);

        $title = $_POST["title"] ?? "";

        $author = $_POST["author"] ?? "";

        $content = $_POST["content"] ?? "";

        $this->blog->title = $title;
        $this->blog->date = $date;
        $this->blog->author = $author;
        $this->blog->content = $content;

        $result = $this->blog->createBlog();

        if ($result === false) {
            echo "Erro ao inserir blog";
        }

        redirect("/blogs/to_blog/" . strtolower($title));
        exit();
    }
}
