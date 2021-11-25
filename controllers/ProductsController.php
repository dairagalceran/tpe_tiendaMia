<?php

include_once('models/productsModel.php');
include_once('models/CategoryModel.php');
include_once('models/commentsModel.php');
include_once('views/productsView.php');
include_once('helpers/loginHelper.php');

class ProductsController
{

    private $productModel;
    private $categoryModel;
    private $commentsModel;
    private $view;
    private $loginHelper;

    public function __construct()
    {
        $this->productModel = new ProductsModel();
        $this->categoryModel = new CategoriesModel();
        $this->commentsModel = new CommentsModel();
        $this->view = new ProductsView();
        $this->loginHelper = new LoginHelper();
    }

    function getOrThrow($key)
    {
        if (isset($_REQUEST[$key]) && $_REQUEST[$key] != '') {
            return $_REQUEST[$key];
        }
        throw new Exception("Falta el dato $key");
    }

    public function showCommentLayout()
    {
        $this->view->showCommentLayout();
    }

    public function showProducts()
    {
        $products = $this->productModel->getAllProducts();
        $this->view->showProducts($products);
    }

    public function showProduct($id)
    {
        $isAdmin = $this->loginHelper->isAdmin(); //agrego barrera seguridad para borrar siendo admin
        $isLoggedIn = $this->loginHelper->getCurrentUserId() !== false;
        $product = $this->productModel->getProduct($id);
        $this->view->showProduct($product, $isAdmin, $isLoggedIn);
    }

    public function indexAdmin()
    {
        $this->loginHelper->checkIsAdmin();
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getAllCategories();
        $this->view->showIndexAdmin($products, $categories);
    }


    function showProductsEditForm($id)
    {
        $this->loginHelper->checkIsAdmin();
        $product = $this->productModel->getProduct($id);
        $categories = $this->categoryModel->getAllCategories();
        $this->view->completeEditProductForm($product, $categories);
    }


    function editProduct($id)
    {
        $this->loginHelper->checkIsAdmin();
        $id = $_REQUEST['id'];

        $productId = $id;
        $productName = $this->getOrThrow('name');
        $productPrice = $this->getOrThrow('price');
        $productSize = $this->getOrThrow('size');
        $category_id = $this->getOrThrow('category_id');

        if ( in_array($_FILES['image_file']['type'], ["image/jpg", "image/jpeg", "image/png"])) {
            $this->productModel->updateProduct($productId, $productName, floatval($productPrice), $productSize, $category_id, $_FILES['image_file']);
        } else {

            $this->productModel->updateProduct($productId, $productName, floatval($productPrice), $productSize, $category_id);
        }

        header("Location: " . BASE_URL . "/" . PRODUCTS_ADMIN_INDEX);
    }


    function insertProduct()
    {
        $this->loginHelper->checkIsAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productName = $this->getOrThrow('name');
            $productSize = $this->getOrThrow('size');
            $productPrice = $this->getOrThrow('price');
            $category_id =  $this->getOrThrow('category_id');

            if ( in_array($_FILES['image_file']['type'], ["image/jpg", "image/jpeg", "image/png"]))  {

                $this->productModel->insertProduct($productName, $productSize, floatval($productPrice), $category_id, $_FILES['image_file']);
            } else {
                $this->productModel->insertProduct($productName, $productSize, floatval($productPrice), $category_id);
            }
            header("Location: " . BASE_URL . "/" . PRODUCTS_ADMIN_INDEX);
        } else {
            $this->view->showError('error');
        }
    }

    function deleteProduct($productId)
    {
        $this->loginHelper->checkIsAdmin();
        $this->commentsModel->deleteAllCommentsProductId($productId);
        $this->productModel->deleteProduct($productId);
        header("Location: " . BASE_URL . "/" . PRODUCTS_ADMIN_INDEX);
    }

    function deleteImage($id)
    {
        $this->loginHelper->checkIsAdmin();
        $this->productModel->deleteImage($id);
        header("Location: " . BASE_URL . "/" . PRODUCTS_ADMIN_INDEX);
    }
}
