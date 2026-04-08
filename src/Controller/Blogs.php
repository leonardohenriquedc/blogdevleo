<?php
namespace App\Controller;

use App\Service\BlogsService;
use App\Core\Controller;

class Blogs extends Controller
{
    private BlogsService $blogsService;

    public function __construct()
    {
        $this->blogsService = new BlogsService();
    }

    public function toHome()
    {
        $nameAndTitles = $this->blogsService->getTitleAndRouter();
        $this->view("home", $nameAndTitles);
    }

    public function toError()
    {
        $this->view("error");
    }

    public function toBlog($router)
    {
        if (empty($router)) {
            echo "<h1>Page not found</h1>";
        }

        $title = explode("-", $router);

        $content = $this->blogsService->getBlog($router);

        $this->view("view_blog", ["data" => $content, "title" => $title[1]]);
    }
}
