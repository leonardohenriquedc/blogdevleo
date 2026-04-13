<?php

function redirect(string $path)
{
    header("Location: $path");
    exit();
}

function getHeaders()
{
    if (function_exists("getallheaders")) {
        return getallheaders();
    }

    $headers = [];
    foreach ($_SERVER as $key => $value) {
        if (str_starts_with($key, "HTTP_")) {
            $header = str_replace("_", "-", substr($key, 5));
            $headers[$header] = $value;
        }
    }

    return $headers;
}
