<?php

namespace App\Service;

use App\Dto\BlogInput;

class BlogsAdminService
{
    private string $path = __DIR__ . "/../../content/";

    public function createBlog(BlogInput $blog)
    {
        $content = "";
        $content .= "---\n";
        $content .= "title: " . $blog->title . "\n";
        $content .= "author: " . $blog->author . "\n";
        $content .= "date: " . $blog->date->format("Y-m-d") . "\n";
        $content .= "---\n\n";
        $content .= $blog->content;

        $filename = strtolower(str_replace(" ", "-", $blog->title)) . ".md";

        $result = file_put_contents($this->path . $filename, $content);

        return $result;
    }
}
