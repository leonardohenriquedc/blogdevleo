<?php

namespace App\Core;

class Session
{
    public static function set(string $key, string $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key)
    {
        if (!isset($_SESSION[$key])) {
            return null;
        }
        return $_SESSION[$key];
    }

    public static function flash(string $key)
    {
        if (!isset($_SESSION[$key])) {
            return null;
        }

        $value = $_SESSION[$key];

        unset($_SESSION[$key]);

        return $value;
    }
}
