
<?php

include_once('models/loginModel.php');
include_once('models/commentsModel.php');
include_once('views/loginView.php');
include_once('helpers/loginHelper.php');

class LoginController
{
    private $model;
    private $commentsModel;
    private $view;
    private $loginHelper;

    public function __construct()
    {
        $this->model = new LoginModel();
        $this->commentsModel= new CommentsModel();
        $this->view = new LoginView();
        $this->loginHelper = new LoginHelper();
    }

    public function showLogin()
    {
        $this->view->showFormLogin();
    }


    /// Obtiene los datos del login y los valida

    public function login()
    {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {

            $userEmail = $_POST['email'];
            $userPassword = $_POST['password'];

            // Obtengo usuaro de DB
            $user = $this->model->getUserByEmail($userEmail);

            //si usuario y password coinciden
            if ($user && password_verify($userPassword, ($user->password))) {
                //armo session
                $this->loginHelper->login($user);
                if($user->is_admin){
                    header("Location: " . BASE_URL."/".ADMIN_DEFAULT); 
                }else{
                header("Location: " . BASE_URL . "/home");
                }
            } else {
                $this->view->showFormLogin('Usuario o contraseña inválida');
            }
        }else{
            $this->view->showFormLogin('Usuario o contraseña incompletos');
        }
    }

    //Registro nuevo usuario no administrador. Ingresa sin loguearse
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

    //muestra todos los usuarios
    function indexAdmin(){
        $this->loginHelper->checkIsAdmin();
        $users = $this->model->getAll();
        $this->view->indexUsers($users, $error=null);
    }

    //cambia rol de usuario a administrador y viceversa
    function alterRol($id){

        $this->loginHelper->checkIsAdmin();

        $user = $this->model->getUserById($id);

        if($user->is_admin == 1){
            $usuariosAdministradores = $this->model->getUsersAdmin();
            $cantidadDeUsuariosAdministradores = count($usuariosAdministradores);

            if($cantidadDeUsuariosAdministradores > 1){
                $this->model->editRol($id, 0);
            } else{
                $this->view->showError( 'No es posible borrar al único administrador el sitio');
                die();
            }
        }else{
            $this->model->editRol($id, 1); 
        }
        header("Location: " . BASE_URL . "/". USERS_ADMIN_INDEX);

    }
    

    function deleteUser($id){

        $this->loginHelper->checkIsAdmin();

        $user = $this->model->getUserById($id);

        $usuariosAdministradores = $this->model->getUsersAdmin();
        $cantidadDeUsuariosAdministradores = count($usuariosAdministradores);

        if($user->is_admin ==='1' && $cantidadDeUsuariosAdministradores == 1){
            $this->view->showError('No es posible borrar al único administrador');
            die();
        }
        
        $this->commentsModel->deleteAllCommentsUserId($id);
        $this->model->delete($id);
        header("Location: " . BASE_URL . "/". USERS_ADMIN_INDEX);
    }
       
    
}
