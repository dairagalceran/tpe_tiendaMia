<?php

include_once('models/productsModel.php');
include_once('models/CategoryModel.php');
include_once('views/productsView.php');
include_once('helpers/loginHelper.php');

class ProductsController {

    private $productModel;
    private $categoryModel;
    private $view;
    private $loginHelper;

    public function __construct() {
        $this->productModel = new ProductsModel();
        $this->categoryModel = new CategoriesModel();
        $this->view = new ProductsView();
        $this->loginHelper = new LoginHelper();
    }

    function getOrThrow($key){
        if (isset($_REQUEST[$key]) && $_REQUEST[$key] != '') {
            return $_REQUEST[$key];
        }
        throw new Exception("Falta el dato $key");
    }

    public function showCommentLayout() {
        $this->view->showCommentLayout();
    }
    public function showProducts() {
        $products = $this->productModel->getAllProducts();
        $this->view->showProducts($products);
    }

    public function showProduct($id) {
        $isAdmin = $this->loginHelper->isAdmin(); //agrego barrera seguridad para borrar siendo admin
        $isLoggedIn = $this->loginHelper->getCurrentUserId()!== false;
        $product = $this->productModel->getProduct($id);
        $this->view->showProduct($product,$isAdmin,$isLoggedIn);
    }

    public function indexAdmin() {
        $this->loginHelper->checkIsAdmin();
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getAllCategories();
        $this->view->showIndexAdmin($products, $categories);
    }
    
    function showProductsEditForm($id){
        $this->loginHelper->checkIsAdmin();
        $product = $this->productModel->getProduct($id);
        $categories = $this->categoryModel->getAllCategories();
        $this->view->completeEditProductForm($product, $categories);
    }    

    function upsertProduct($product){
        $id= $_REQUEST['id'];
        if($id){
            $this->editProduct($id);
        }else{
            $this->insertProduct($product);
        }
    }

    function editProduct($id){
            $this->loginHelper->checkIsAdmin();
            $productId= $id;
            $productName = $this->getOrThrow('name');
            $productPrice = $this->getOrThrow('price'); 
            $productSize = $this->getOrThrow('size'); 
            $category_id = $this->getOrThrow('category_id');
            $this->productModel->updateProduct($productId , $productName,floatval($productPrice), $productSize, $category_id);
            header("Location: " . BASE_URL."/".PRODUCTS_ADMIN_INDEX);
    }

    
    function insertProduct($product){
        $this->loginHelper->checkIsAdmin();
        try{
            $productName= $this->getOrThrow('name');
            $productSize = $this->getOrThrow('size');
            $productPrice = $this->getOrThrow('price'); 
            $category_id =  $this->getOrThrow('category_id');
            $this->productModel->insertProduct($productName, $productSize, floatval($productPrice), $category_id);
            header("Location: " . BASE_URL."/".PRODUCTS_ADMIN_INDEX); 
        }catch(Exception $e){
            $this->view->showError($e->getMessage());
        }
        

     
    }

    function deleteProduct($id){
        $this->loginHelper->checkIsAdmin();
        $this->productModel->deleteProduct($id);
        header("Location: " . BASE_URL ."/".PRODUCTS_ADMIN_INDEX);

    }

   
}