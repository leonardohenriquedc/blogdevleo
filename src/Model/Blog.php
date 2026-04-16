<?php

namespace App\Model;

use DateTime;
use Exception;
use RecursiveDirectoryIterator;
use DirectoryIterator;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;

class Blog
{
    private string $path = __DIR__ . "/../../content/";

    public string $title;
    public string $author;
    public DateTime $date;
    public string $content;
    public array $tags;

    public function __construct(
        string $title = "",
        string $author = "",
        DateTime $date = null,
        string $content = "",
    ) {
        $this->title = $title;
        $this->author = $author;
        $this->date = $date ?? new DateTime();
        $this->content = $content;
    }

    public function hasEmpty(): bool
    {
        return empty($this->title) ||
            empty($this->author) ||
            empty($this->content) ||
            $this->date === null;
    }

    public function createBlog(): bool
    {
        if ($this->hasEmpty()) {
            return false;
        }

        $content = "";
        $content .= "---\n";
        $content .= "title: " . $this->title . "\n";
        $content .= "author: " . $this->author . "\n";
        $content .= "date: " . $this->date->format("Y-m-d") . "\n";
        $content .= "---\n\n";
        $content .= $this->content;

        $filename = strtolower(str_replace(" ", "-", $this->title)) . ".md";

        $result = file_put_contents($this->path . $filename, $content);

        if (!$result) {
            return false;
        }

        return true;
    }

    public function getTitleAndRouter(): array
    {
        $titleAndfileNames = [];

        $intermediaryArray = [];

        foreach (new DirectoryIterator($this->path) as $file) {
            if ($file->isDot() || !$file->isFile()) {
                continue;
            }

            if ($file->getExtension() !== "md") {
                continue;
            }

            $header = $this->getMetadata($file->getPathname());

            $intermediaryArray[] = [
                "title" => $header["title"],
                "router" => $file->getBasename(".md"),
                "date" => $header["date"],
            ];
        }

        usort($intermediaryArray, function ($a, $b) {
            return strtotime($b["date"]) - strtotime($a["date"]);
        });

        foreach ($intermediaryArray as $item) {
            $titleAndfileNames[] = [
                "title" => $item["title"],
                "router" => $item["router"],
            ];
        }

        if ($titleAndfileNames === []) {
            throw new Exception("No blogs found");
        }

        return $titleAndfileNames;
    }

    public function getBlog(string $router): string
    {
        $router = $router . ".md";
        $filePath = $this->path . $router;

        if (!file_exists($filePath)) {
            error_log("File not found: " . $filePath);
            throw new Exception("Blog not found");
        }

        $fileContent = file_get_contents($filePath);

        $content = $this->extractContentMarkdown($fileContent);
        $html = $this->parseDown($content);

        return $html;
    }

    private function parseDown($content): string
    {
        // Define your configuration, if needed
        $config = [];

        // Configure the Environment with all the CommonMark and GFM parsers/renderers
        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());

        $converter = new MarkdownConverter($environment);
        return $converter->convert($content)->getContent();
    }

    private function extractContentMarkdown(string $markdown): string
    {
        $content = "";
        $finalFrontMatter = 0;
        $contentFile = explode("\n", $markdown);
        foreach ($contentFile as $line) {
            if (trim($line) === "---") {
                $finalFrontMatter++;
                continue;
            }

            if ($finalFrontMatter >= 2) {
                $content .= $line . "\n";
            }
        }

        if (trim($content) === "") {
            throw new Exception("Invalid markdown format");
        }

        return $content;
    }

    private function getMetadata(string $filePath): array
    {
        $content = file($filePath);

        $finalFrontMatter = 0;

        $headers = [];

        foreach ($content as $line) {
            if ($line === "---\n") {
                $finalFrontMatter++;
                continue;
            }

            if ($finalFrontMatter < 2) {
                $parts = explode(":", $line, 2);

                if (count($parts) === 2) {
                    $key = trim($parts[0]);
                    $value = trim($parts[1]);

                    $headers[$key] = $value;
                }
            }
        }

        if (empty($headers)) {
            throw new Exception("Empty header");
        }

        return $headers;
    }
}
