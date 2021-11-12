<?php

require_once('controllers/categoryController.php');
require_once('controllers/productsController.php');
require_once('controllers/loginController.php');

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']));
define('CATEGORIES_ADMIN_INDEX','adminCategories');
define('PRODUCTS_ADMIN_INDEX','adminProducts');
define('USERS_ADMIN_INDEX','adminUsers');
define('ADMIN_DEFAULT', CATEGORIES_ADMIN_INDEX);


if (!empty($_GET['action'])){
    $action = $_GET['action'];
}
else {
    $action = 'home';
}
$params = explode('/', $action);

$controllerCategory = new CategoryController();
$controllerProducts = new ProductsController();
$loginController = new LoginController();

switch ($params[0]) {
    case 'home':
        $controllerProducts->showProducts();
        break; 
    case PRODUCTS_ADMIN_INDEX:
        $controllerProducts->indexAdmin();
        break;
    case CATEGORIES_ADMIN_INDEX:
        $controllerCategory->indexAdmin();
        break;
    case USERS_ADMIN_INDEX:
        $loginController->indexAdmin();
        break;
    case 'login':
        $loginController->showLogin();
        break;
    case 'verify': 
        $loginController->login();
        break;
    case 'logout':      
        $loginController->logout();
        break;
    case 'registerForm': 
        $loginController->registerForm();
        break;
    case 'register': 
        $loginController->registerUser();
        break;
    case 'deleteUser':
        $loginController->deleteUser($params[1], $params[2]);
        break;
    case 'editRol':
        $loginController->editRol($params[1], $params[2]);
        break;
    case 'category':
        $controllerCategory->showCategories(); 
        break;
    case 'postCategory':
        $controllerCategory->upsertCategories($params[1]); 
        break;
    case'editCategory':
        $controllerCategory->showCategoriesEditForm($params[1]);
        break;
    case 'deleteCategory':
        $controllerCategory->deleteCategory($params[1]);
        break;
    case 'productsCategory':
        $controllerCategory->showItemsByCategory($params[1]);
        break;
    case 'postProduct':
        $controllerProducts->upsertProduct($params[1]);      
        break;  
    case 'productView':
        $controllerProducts->showProduct($params[1]); 
        break;
    case 'deleteProduct':
        $controllerProducts->deleteProduct($params[1]);
        break;
    case 'editProductForm':
        $controllerProducts->showProductsEditForm($params[1]);
        break;
    default:
        echo '404 - Página no encontrada';
        break;
}