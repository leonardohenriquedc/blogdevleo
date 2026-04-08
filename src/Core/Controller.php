<?php

namespace App\Core;

class Controller
{
    public function view($view, $data = [])
    {
        if (!file_exists(__DIR__ . "/../../view/" . $view . ".php")) {
            die("View not found");
        }
        extract($data);
        require_once __DIR__ . "/../../view/" . $view . ".php";
    }

    public function dd(mixed $data)
    {
        echo "<pre>";
        print_r($data);
        die();
    }
}
