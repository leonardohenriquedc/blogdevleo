<?php

namespace App\Dto;

use DateTime;

class BlogInput
{
    public string $title;
    public string $author;
    public DateTime $date;
    public string $content;
    public array $tags;

    public function empty(): bool
    {
        return empty($this->title) ||
            empty($this->author) ||
            empty($this->content) ||
            empty($this->tags) ||
            $this->date === null;
    }
}
