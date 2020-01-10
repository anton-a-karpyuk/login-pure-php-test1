<?php

namespace TestApp;

class UserController
{
    static function  goback()
    {
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    function login() {
        if (isset($_POST["login"])) {
            /** @var User $user */
            $user = User::getOne(['username' => $_POST["login"]["username"]]);
            if ($user && $user->getHashedPassword() === md5($_POST["login"]["password"])) {
                $_SESSION["user_id"] = $user->getId();
                header("Location: /");
            } else {
                $_SESSION["error"] = "Не найдено такое сочетание логина и пароля";
                self::goback();
            }
        } else {
            require_once "Views/login.php";
        }
        return null;
    }

    function logout() {
        $_SESSION["user_id"] = "";
        session_destroy();
        header("Location: /login");
    }

    function register() {
        if (isset($_POST["register"])) {
            /** @var User $user */
            $user = User::getOne(['username' => $_POST["register"]["username"]]);
            if ($user) {
                $_SESSION["error"] = "Пользователь с таким логином уже зарегистрирован";
                self::goback();
            }
            $user = User::getOne(['email' => $_POST["register"]["email"]]);
            if ($user) {
                $_SESSION["error"] = "Пользователь с такой почтой уже зарегистрирован";
                self::goback();
            }
            $user = new User();
            $user->saveAttributes($_POST["register"]);
            //MD5 использовать уже нельзя из-за коллизий, но этот проект уже всё равно мёртв
            $user->setHashedPassword(md5($_POST["register"]['password']));
            $user->save();
            header("Location: /login");
        } else {
            require_once "Views/register.php";
        }
        return null;
    }

    function index() {
        if (isset($_POST["index"])) {
            /** @var User $user */
            $user = User::getOne(['id' => $_SESSION["user_id"]]);
            $user->saveAttributes($_POST["index"]);
            $user->setHashedPassword(md5($_POST["index"]['password']));
            $user->save();
            self::goback();
        } else {
            require_once "Views/index.php";
        }
        return null;
    }
}