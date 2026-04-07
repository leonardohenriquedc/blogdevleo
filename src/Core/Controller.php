<?php

namespace App\Core;

class Controller
{
    public function view($view, $data = [])
    {
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
