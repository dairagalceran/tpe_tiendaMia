
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
        $this->view->indexUsers($users, $error=null);
    }
    function alterRol($id){
        $user = $this->model->getUserById($id);
        if($user->is_admin){
            $usuariosAdministradores = $this->model->getUsersAdmin();
            $cantidadDeUsuariosAdministradores = count($usuariosAdministradores);
            if($cantidadDeUsuariosAdministradores > 1){
                $this->model->editRol($id, 0);
            } 
        }else{
            $this->model->editRol($id, 1);
        }
        header("Location: " . BASE_URL . "/". USERS_ADMIN_INDEX);

    }
    function editRol($id, $isAdmin){
        $this->loginHelper->checkIsAdmin();
       
        if($isAdmin == '0'){
            $usuariosAdministradores = $this->model->getUsersAdmin();
            $cantidadDeUsuariosAdministradores = count($usuariosAdministradores);
            if($cantidadDeUsuariosAdministradores > 1){
                $this->model->editRol($id, $isAdmin);
            }   
        } else {
            $this->model->editRol($id, $isAdmin);
        }

        header("Location: " . BASE_URL . "/". USERS_ADMIN_INDEX);
        
    }
    

    function deleteUser($id){
        $this->loginHelper->checkIsAdmin();
        $user = $this->model->getUserById($id);

        if($user->is_admin == '0'){
            $this->model->delete($id);
            header("Location: " . BASE_URL . "/". USERS_ADMIN_INDEX);
        }else{
            $usuariosAdministradores = $this->model->getUsersAdmin();
            $cantidadDeUsuariosAdministradores = count($usuariosAdministradores);
            if($cantidadDeUsuariosAdministradores > 1){
                $this->model->delete($id);
            } else{
                $users = $this->model->getAll();

                   return $this->view->indexUsers($users, 'no es posible borrar al único administrador');
            }
        }
        header("Location: " . BASE_URL . "/". USERS_ADMIN_INDEX);
    }
}
