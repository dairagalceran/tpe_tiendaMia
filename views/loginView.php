<?php
require_once './libs/smarty-master/libs/Smarty.class.php';

class LoginView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showRegisterForm($error = null)
    {
        $this->smarty->assign('error', $error);
        $this->smarty->display('templates/users/logRegister.tpl');
    }

    function showFormLogin($error = null)
    {
        $this->smarty->assign('error', $error);
        $this->smarty->display('templates/users/formLogin.tpl');
    }
    function indexUsers($users, $error = null)
    {
        $this->smarty->assign('titleAdmin', 'Listado de usuarios y administradores');
        $this->smarty->assign('users', $users);
        $this->smarty->assign('error', $error);
        $this->smarty->display('templates/users/admin.tpl');
    }

    function showError($msgError = null)
    {
        $this->smarty->assign('error', $msgError);
        $this->smarty->display('../templates/error.tpl');
    }
}
