
<?php

include_once('models/loginModel.php');
include_once('views/loginView.php');
include_once('helpers/loginHelper.php');

class LoginController
{
    private $model;
    private $view;
    private $loginHelper;

    public function __construct()
    {
        $this->model = new LoginModel();
        $this->view = new LoginView();
        $this->loginHelper = new LoginHelper();
    }

    public function showLogin()
    {
        $this->view->showFormLogin();
    }

    public function login()
    {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $userEmail = $_POST['email'];
            $userPassword = $_POST['password'];
            $user = $this->model->getUserByEmail($userEmail);
            if ($user && password_verify($userPassword, ($user->password))) {
                $this->loginHelper->login($user);
                if($user->is_admin){
                    header("Location: " . BASE_URL."/".ADMIN_DEFAULT); 
                }else{
                header("Location: " . BASE_URL . "/home");
                }
            } else {
                $this->view->showFormLogin('Usuario o contraseña inválida');
            }
        }
    }


    function registerForm()
    {
        $this->view->showRegisterForm();
    }

    function registerUser()
    {
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $userPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $this->model->register($name, $email, $userPassword);
            $user = $this->model->getUserByEmail($email);
            $this->loginHelper->login($user);
            header("Location: " . BASE_URL . "/home");
        }else{
            $this->view->showRegisterForm('Datos inválidos');
        }  
    }


    public function logout()
    {
        $this->loginHelper->logout();
    }

    function indexAdmin(){
        $this->loginHelper->checkIsAdmin();
        $users = $this->model->getAll();
        var_dump($users);
        $this->view->indexUsers($users, $error=null);
    }

    function editRol($id, $isAdmin){
        $this->loginHelper->checkIsAdmin();
        if($isAdmin == 0){
            $isAdmin = '1';
            echo ('dentro delete is admin == 0');
            $this->model->editRol($id, $isAdmin);
            header("Location: " . BASE_URL . "/". USERS_ADMIN_INDEX);
        }
        else{
            $isAdmin = $this->model->getUsersAdmin();
            $quantityAdmin = count($isAdmin);
                if($quantityAdmin>1){
                    $isAdmin = '0';
                    $this->model->editRol($id ,$isAdmin);
                }   
        }
        header("Location: " . BASE_URL . "/". USERS_ADMIN_INDEX);
    }
    

    function deleteUser($id, $is_admin){
        $this->loginHelper->checkIsAdmin();
        if($is_admin == 0){
            $this->model->delete($id);
            header("Location: " . BASE_URL . "/". USERS_ADMIN_INDEX);
        }else{
            $admin = $this->model->getUsersAdmin();
            $quantityAdmin = count($admin);
                if($quantityAdmin>1){
                    $this->model->delete($id);
                    header("Location: " . BASE_URL . "/". USERS_ADMIN_INDEX);
                }else{
                    $this->view->indexUsers($users=null, 'no es posible borrar al único administrador');
                }

        }
        header("Location: " . BASE_URL . "/". USERS_ADMIN_INDEX);
    }
}
