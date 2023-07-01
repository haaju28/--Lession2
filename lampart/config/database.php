<?php

class Database{
    const HOST = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = '';
    const DB_NAME = 'product_category';
    const PORT = '3306';

    private $connect;

    public function connect(){

        $this->connect = mysqli_connect(self::HOST,self::USERNAME,self::PASSWORD,self::DB_NAME,self::PORT);
        mysqli_set_charset($this->connect,'utf8');
        if(mysqli_connect_errno() === 0){
            return $this->connect;
        }
        return false;
    }
}

?>