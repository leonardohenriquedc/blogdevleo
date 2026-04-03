<?php

namespace App\Service;

require_once __DIR__ . "/../vendor/autoload.php";

use Exception;
use RecursiveDirectoryIterator;
use DirectoryIterator;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;

class BlogsService
{
    private string $pathFiles = __DIR__ . "/../content/";

    public function getTitleAndRouter(): array
    {
        $titleAndfileNames = [];

        foreach (new DirectoryIterator($this->pathFiles) as $file) {
            if ($file->isDot() || !$file->isFile()) {
                continue;
            }

            if ($file->getExtension() !== "md") {
                continue;
            }

            $header = $this->getMetadata($file->getPathname());

            $titleAndfileNames[] = [
                "title" => $header["title"],
                "router" => $file->getBasename(),
            ];
        }

        if ($titleAndfileNames === []) {
            throw new Exception("No blogs found");
        }

        return $titleAndfileNames;
    }

    public function getBlog(string $router): string
    {
        $filePath = $this->pathFiles . $router;

        if (!file_exists($filePath)) {
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
