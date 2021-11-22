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

    public function showCommentLayout() {
       
        $this->view->showCommentLayout();
    }
    public function showProducts() {
        $products = $this->productModel->getAllProducts();
        $this->view->showProducts($products);
    }

    public function showProduct($id) {
        $this->loginHelper->checkLoggedIn();
        $product = $this->productModel->getProduct($id);
        $this->view->showProduct($product);
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
            $productName = $_REQUEST['name'];
            $productPrice = $_REQUEST['price'];
            $productSize = $_REQUEST['size'];
            $category_id = $_REQUEST['category_id'];
            
            $this->productModel->updateProduct($productId , $productName,floatval($productPrice), $productSize, $category_id);
            header("Location: " . BASE_URL."/".PRODUCTS_ADMIN_INDEX);
    }

    
    function insertProduct($product){
        $this->loginHelper->checkIsAdmin();
        $productName= $_REQUEST['name'];
        $productSize = $_REQUEST['size'];
        $productPrice = $_REQUEST['price'];
        $category_id = $_REQUEST['category_id'];

        $this->productModel->insertProduct($productName, $productSize, floatval($productPrice), $category_id);
        header("Location: " . BASE_URL."/".PRODUCTS_ADMIN_INDEX); 
    }

    function deleteProduct($id){
        $this->loginHelper->checkIsAdmin();
        $this->productModel->deleteProduct($id);
        header("Location: " . BASE_URL ."/".PRODUCTS_ADMIN_INDEX);

    }

   
}