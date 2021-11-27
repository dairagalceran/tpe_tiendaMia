<?php

class LoginHelper
{

    function __construct()
    {
        //abre session diempre para usar helper
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }


    public function login($user)
    {
        $_SESSION['USER_ID'] = $user->id;
        $_SESSION['USER_EMAIL'] = $user->email;
        $_SESSION['USER_NAME'] = $user->name;
        $_SESSION['IS_ADMIN'] = $user->is_admin;
        $_SESSION['LAST_ACTIVITY'] = time();
    }

    function getCurrentUserId()
    {
        return isset($_SESSION['USER_ID']) ? $_SESSION['USER_ID'] : false;
    }

    function isAdmin()
    {
        if ($this->getCurrentUserId()) {
            return isset($_SESSION['IS_ADMIN']) ? $_SESSION['IS_ADMIN'] : false;
        } else {
            return false;
        }
    }

    public function checkIsAdmin()
    {
        if ($this->isAdmin()) {
            if (
                isset($_SESSION['LAST_ACTIVITY']) &&
                (time() - $_SESSION['LAST_ACTIVITY'] > 900)
            ) {
                header("Location: " . BASE_URL . "/logout");
                die();
            }
            $_SESSION['LAST_ACTIVITY'] = time(); // actualiza el últimov
        } else {
            header("Location: " . BASE_URL . "/home");
            die();
        }
    }

    public function checkLoggedIn()
    {
        if (isset($_SESSION['USER_ID'])) {
            if (
                isset($_SESSION['LAST_ACTIVITY']) &&
                (time() - $_SESSION['LAST_ACTIVITY'] > 600)
            ) {
                header("Location: " . BASE_URL . "/logout");
                die();
            }
            $_SESSION['LAST_ACTIVITY'] = time();
        } else {
            header("Location: " . BASE_URL . "/login");
            die();
        }
    }


    function logout()
    {
        session_destroy();
        header("Location: " . BASE_URL . "/home");
    }
}
