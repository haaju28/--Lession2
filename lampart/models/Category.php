<?php
    class Category extends BaseModel{

        const TABLE = 'categories';

        public function get(){
            return $this->getAll(self::TABLE,['id','name']);
        }
        public function paginate($page_nr){
            return $this->getLimit(self::TABLE,['id','name'],$page_nr);
        }
 
        public function findById($id){
            return $this->find(self::TABLE,$id);
        }

        public function store(){

            $name = $_POST['name'];
        
            $data = [
                'name' => $name,
            ];
            return $this->create(self::TABLE,$data);
        }

        public function updateRecord($id){
            $name = $_POST['name'];
        
            $data = [
                'name' => $name,
            ];
            return $this->update(self::TABLE,$data,$id);
        }

        public function deleteById($id){
            return $this->destroy(self::TABLE,$id);
        }

        public function copyProduct($id){
            $existingProduct = $this->findById($id);

            $newProduct = [
                'name' => $existingProduct['name'] . ' (Copy)',
            ];

            return $this->create(self::TABLE, $newProduct);
        }

        public function findName($page_nr){
            $search = $_POST['search'] ?? '';
            return $this->findByCate($search,$page_nr);
        }
    }

?>