<?php

class ProductController extends BaseController{

    private $productModel, $categoryModel;

    public function __construct(){
        require_once('./models/Product.php');
        require_once('./models/Category.php');
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    public function index($page){
        $page_nr = empty($page) ? 1 : $page;
        $products = $this->productModel->paginate($page_nr);
        $categories = $this->categoryModel->get();
        $totalResults = count($products[0]);
        $this->loadView('./views/product/index.php',compact("products","categories","totalResults"));
    }

    public function add(){
        $products = $this->productModel->store();
        header("Location: /lampart/product/index");
    }
    public function update($id){
        $products = $this->productModel->updateRecord($id);
        header("Location: /lampart/product/index");
    }

    public function copy($id){
        $products = $this->productModel->copyProduct($id);
        $categories = $this->categoryModel->get();
        header("Location: /lampart/product/index");
    }

    public function edit($id){
        $products = $this->productModel->findById($id);
        $categories = $this->categoryModel->get();
        $this->loadView('./views/product/update.php',compact("products","categories"));
    }

    public function detail($id){
        $products = $this->productModel->findById($id);
        $categories = $this->categoryModel->get();
        $this->loadView('./views/product/detail.php',compact("products","categories"));
    }

    public function delete($id){
        $products = $this->productModel->deleteById($id);
        header("Location: /lampart/product/index");
    }

    public function search($page){
        $page_nr = empty($page) ? 1 : $page;
        $products = $this->productModel->findName($page_nr);
        $categories = $this->categoryModel->get();
        $totalResults = count($products[0]);
        $this->loadView('./views/product/search.php',compact("products","categories","totalResults"));
    }

}


?>