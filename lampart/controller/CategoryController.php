<?php

class CategoryController extends BaseController{

    private $categoryModel;

    public function __construct(){
        require_once('./models/Category.php');
        $this->categoryModel = new Category();
    }

    public function index($page){
        $page_nr = empty($page) ? 1 : $page;
        $categories = $this->categoryModel->paginate($page_nr);
        $totalResults = count($categories[0]);
        $this->loadView('./views/category/index.php',compact("categories","totalResults"));
    }
    public function add(){
        $categories = $this->categoryModel->store();
        header("Location: /lampart/category/index");
    }

    public function update(){
        if(isset($_POST['updatedata'])){
            $id = $_POST['update_id'];
        }
        $categories = $this->categoryModel->updateRecord($id);
        header("Location: /lampart/category/index");
    }

    public function copy($id){
        $categories = $this->categoryModel->copyProduct($id);
        header("Location: /lampart/category/index");
    }


    public function delete($id){
        $categories = $this->categoryModel->deleteById($id);
        header("Location: /lampart/category/index");
    }

    public function search($page){
        $page_nr = empty($page) ? 1 : $page;
        $categories = $this->categoryModel->findName($page_nr);
        $totalResults = count($categories[0]);
        $this->loadView('./views/category/search.php',compact("categories","totalResults"));
    }

}


?>