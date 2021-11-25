<?php

include_once('models/CategoryModel.php');
include_once('models/productsModel.php');
include_once('views/categoryView.php');
include_once('helpers/loginHelper.php');

class CategoryController
{

    private $categoryModel;
    private $productModel;
    private $view;
    private $loginHelper;


    public function __construct()
    {
        $this->categoryModel = new CategoriesModel();
        $this->productModel = new ProductsModel();
        $this->view = new CategoriesView();
        $this->loginHelper = new LoginHelper();
    }
    function getOrThrow($key)
    {
        if (isset($_REQUEST[$key]) && $_REQUEST[$key] != '') {
            return $_REQUEST[$key];
        }
        throw new Exception("Falta el dato $key");
    }  

    function showCategories()
    {
        $categories = $this->categoryModel->getAllCategories();
        $this->view->showCategories($categories);
    }


    public function indexAdmin()
    {
        $this->loginHelper->checkIsAdmin();
        $categories = $this->categoryModel->getAllCategories();
        $this->view->showIndexAdmin($categories);
    }

    function showItemsByCategory($id)
    {
        $category = $this->categoryModel->findCategoryById($id);
        $products = $this->productModel->getByCategory($id);
        $this->view->showItemsCategory($products, $category);
    }


    function upsertCategories($category)
    {
        $id = $_REQUEST['id'];
        if ($id) {
            $this->editCategory($id);
        } else {
            $this->createCategory($category);
        }
    }

    function createCategory($category)
    {
        $this->loginHelper->checkIsAdmin();
        try {
            $category = $this->getOrThrow("name");
            $this->categoryModel->insertCategory($category);
            header("Location: " . BASE_URL . "/" . CATEGORIES_ADMIN_INDEX);
        } catch (Exception $e) {
            $this->view->showError($e->getMessage());
        }
    }

    function editCategory($id)
    {
        $this->loginHelper->checkIsAdmin();
        try {
            $category = $this->getOrThrow("name");
            $this->categoryModel->updateCategory($id, $category);
            header("Location: " . BASE_URL . "/" . CATEGORIES_ADMIN_INDEX);
        } catch (Exception $e) {
            $this->view->showError($e->getMessage());
        }
    }

    function showCategoriesEditForm($id)
    {
        $this->loginHelper->checkIsAdmin();
        $category = $this->categoryModel->findCategoryById($id);
        $this->view->completeEditForm($category);
    }

    function deleteCategory($id)
    {
        $this->loginHelper->checkIsAdmin();
        $this->categoryModel->deleteCategory($id);
        header("Location: " . BASE_URL . "/" . CATEGORIES_ADMIN_INDEX);
    }
}
