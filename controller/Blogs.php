<?php
namespace App\Controller;

use App\Service\BlogsService;

require_once __DIR__ . "/../service/BlogsService.php";

class Blogs
{
    public function toHome()
    {
        $blogsService = new BlogsService();
        $nameAndTitles = $blogsService->getTitleAndRouter();
        include __DIR__ . "/../view/home.php";
    }
}
