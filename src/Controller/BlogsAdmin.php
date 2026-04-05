<?php

namespace App\Controller;

use App\Dto\BlogInput;
use App\Service\BlogsAdminService;
use DateTime;

class BlogsAdmin
{
    public function newBlog()
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

        $blogService = new BlogsAdminService();

        $result = $blogService->createBlog($blogData);

        if ($result === false) {
            echo "Erro ao inserir blog";
        }

        header("Location: index.php?to=blog&title=" . $title . ".md");
        exit();
    }
}
