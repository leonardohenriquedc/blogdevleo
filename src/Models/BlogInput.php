<?php

namespace App\Model;

class BlogInput
{
    public string $title;
    public string $author;
    public DateTime $date;
    public string $content;
    public array $tags;
}
