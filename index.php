<?php

use App\Controller\Blogs;
use App\Controller\BlogsAdmin;

require_once __DIR__ . "/vendor/autoload.php";

$controllerBlogs = new Blogs();
$controllerBlogsAdmin = new BlogsAdmin();
$to = $_GET["to"] ?? "home";

switch ($to) {
    case "blog":
        $controllerBlogs->toBlog();
        break;
    case "new_blog":
        $controllerBlogsAdmin->newBlog();
        break;
    default:
        $controllerBlogs->toHome();
        break;
}
