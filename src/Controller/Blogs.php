<?php
namespace App\Controller;

use App\Service\BlogsService;

class Blogs
{
    private BlogsService $blogsService;

    public function __construct()
    {
        $this->blogsService = new BlogsService();
    }

    public function toHome()
    {
        $nameAndTitles = $this->blogsService->getTitleAndRouter();
        include __DIR__ . "/../../view/home.php";
        //exit();
    }

    public function toBlog()
    {
        $router = $_GET["title"] ?? "";

        if (empty($router)) {
            echo "<h1>Page not found</h1>";
        }

        $content = $this->blogsService->getBlog($router);

        include __DIR__ . "/../../view/view_blog.php";
    }
}
