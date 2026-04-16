<?php
namespace App\Controller;

use App\Core\Controller;
use App\Model\Blog;

class Blogs extends Controller
{
    private Blog $blog;

    public function __construct()
    {
        $this->blog = new Blog();
    }

    public function toHome()
    {
        $nameAndTitles = $this->blog->getTitleAndRouter();
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

        $content = $this->blog->getBlog($router);

        $this->view("view_blog", ["data" => $content, "title" => $title[1]]);
    }
}
