<?php

class LoginHelper {
    
    function __construct() {
        if (session_status() != PHP_SESSION_ACTIVE) { 
            session_start();
        }
    }

    
    public function login($user) {
        $_SESSION['USER_ID'] = $user->id;
        $_SESSION['USER_EMAIL'] = $user->email;
        $_SESSION['IS_ADMIN']= $user->is_admin; 
    }

    function getCurrentUserId(){
        return isset($_SESSION['USER_ID'])?$_SESSION['USER_ID'] : false;
    }

    function isAdmin(){
        if($this->getCurrentUserId()){
            return isset($_SESSION['IS_ADMIN'])?$_SESSION['IS_ADMIN'] : false; 
        }  else{
            return false;
        }  
    }

    public function checkIsAdmin() { 
        if (! $this->isAdmin()) {
            error_log('checkIsAdmin->no es admin');
            header("Location: " . BASE_URL ."/home");
            die();
        }
    }

    public function checkLoggedIn() { 
        if (empty($_SESSION['USER_ID'])) {
            header("Location: " . BASE_URL ."/login");
            die();
        }
    }


    function logout() {
        session_destroy();
        header("Location: " . BASE_URL ."/home");   
    } 
}