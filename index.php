<?php

use App\Controller\Blogs;

require_once __DIR__ . "/controller/Blogs.php";

$controlerBlogs = new Blogs();

$to = $_GET["to"] ?? "home";

switch ($to) {
    case "blog":
        $controlerBlogs->toBlog();
        break;

    default:
        $controlerBlogs->toHome();
        break;
}
