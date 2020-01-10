<?php

namespace TestApp;

class Router
{
    public static function routeTo($path)
    {
        $controller = new UserController();

        if (strpos($path, '/register') === 0) {
            $controller->register();
            return;
        } elseif (strpos($path, '/login') === 0) {
            $controller->login();
            return;
        } elseif (strpos($path, '/logout') === 0) {
            $controller->logout();
            return;
        }

        //default redirect
        if (empty($_SESSION["user_id"])) {
            $controller->login();
        } else {
            $controller->index();
        }

    }
}