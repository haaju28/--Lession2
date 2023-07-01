<?php
    class Product extends BaseModel{

        const TABLE = 'products';

        public function get(){
            return $this->getAll(self::TABLE,['id','name','image_url','category_id']);
        }

        public function paginate($page_nr){
            return $this->getLimit(self::TABLE,['id','name','image_url','category_id'],$page_nr);
        }


        public function findById($id){
            return $this->find(self::TABLE,$id);
        }

        public function copyProduct($id){
            $existingProduct = $this->findById($id);

            $newProduct = [
                'name' => $existingProduct['name'] . ' (Copy)',
                'category_id' => $existingProduct['category_id'],
                'image_url' => $existingProduct['image_url']
            ];

            return $this->create(self::TABLE, $newProduct);
        }

        public function findName($page_nr){
            $search = $_POST['search'] ?? '';
            return $this->findByName($search,$page_nr);
        }

        public function store(){
            if(isset($_FILES['image_url'])){
                $target_dir = "public/images/";
                $file_name = uniqid().'_'. $_FILES['image_url']['name'];
                $target_file = $target_dir .$file_name;
            
                if(move_uploaded_file($_FILES['image_url']['tmp_name'],$target_file)){
                    echo "the file " .$_FILES['image_url']['name']. " has been uploaded";
                }else{
                    echo 'error upload file';
                }
            }
            $name = $_POST['name'];
            $category = $_POST['category'];
            $image_url = $_POST['image_url'] ?? $file_name;
        
            $data = [
                'name' => $name,
                'category_id' => $category,
                'image_url' => $image_url
            ];
            return $this->create(self::TABLE,$data);
        }

        public function updateRecord($id){
            $existingProduct = $this->findById($id);
            $image_url = $existingProduct['image_url'];

            $file_name = $_FILES['image_url']['name'];

            if(isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK){
                $target_dir = "public/images/";
                $file_name = uniqid() . '_' . $_FILES['image_url']['name'];
                $target_file = $target_dir . $file_name;
            
                if(move_uploaded_file($_FILES['image_url']['tmp_name'], $target_file)){
                    echo "The file " . $_FILES['image_url']['name'] . " has been uploaded";
                    if($existingProduct['image_url']){
                        unlink($target_dir . $existingProduct['image_url']);
                    }
                    $image_url = $file_name;
                }else{
                    echo 'Error uploading file';
                }
            }


            $name = $_POST['name'];
            $category = $_POST['category'];
        
            $data = [
                'name' => $name,
                'category_id' => $category,
                'image_url' => $image_url
            ];
            return $this->update(self::TABLE,$data,$id);
        }

        public function deleteById($id){
            return $this->destroy(self::TABLE,$id);
        }
    }

?>