<?php

use App\Controller\Blogs;

require_once __DIR__ . "/controller/Blogs.php";

$blogs = new Blogs();

$blogs->toHome();
