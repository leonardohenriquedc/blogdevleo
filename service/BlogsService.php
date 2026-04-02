<?php

namespace App\Service;

use Exception;
use RecursiveDirectoryIterator;
use DirectoryIterator;

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
