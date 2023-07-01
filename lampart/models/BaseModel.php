<?php
interface DatabaseOperations
{
    public function query($sql);
    public function getAll($table, $select = ['*']);
    public function getLimit($table, $select = ['*'], $page_nr);
    public function find($table, $id);
    public function create($table, $data);
    public function update($table, $data, $id);
    public function destroy($table, $id);
}


abstract class BaseModel extends Database implements DatabaseOperations
{

    public $connect;

    public function __construct()
    {
        $this->connect = $this->connect();
    }

    public function query($sql)
    {

        return mysqli_query($this->connect, $sql);
    }

    public function getAll($table, $select = ['*'])
    {
        $selectList = implode(',', $select);

        $sql = "SELECT $selectList FROM $table";

        $result = $this->query($sql);

        $data = [];

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }

        return $data;
    }

    public function getLimit($table, $select = ['*'], $page_nr)
    {
        $start = 0;

        $rows_per_page = 10;

        $selectList = implode(',', $select);

        $supsql = "SELECT * FROM $table";

        $records = $this->query($supsql);

        $nr_of_rows = $records->num_rows;

        $pages = ceil($nr_of_rows / $rows_per_page);

        $page_index = [];
        for ($i = 1; $i <= $pages; $i++) {
            $page_index[] = $i;
        }

        if (isset($page_nr)) {
            $page = $page_nr - 1;
            $start = $page * $rows_per_page;
        }

        $sql = "SELECT $selectList FROM $table LIMIT $start, $rows_per_page";

        $result = $this->query($sql);

        $data = [];

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }

        return [$data, $page_index];
    }

    public function find($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id=$id";
        $result = $this->query($sql);
        return mysqli_fetch_assoc($result);
    }

    
    public function findByCate($search, $page_nr)
    {
        $start = 0;

        $rows_per_page = 10;

        $supsql = "SELECT *
        FROM categories
        WHERE name LIKE '%" . $search . "%'";

        $records = $this->query($supsql);

        $nr_of_rows = $records->num_rows;

        $pages = ceil($nr_of_rows / $rows_per_page);

        $page_index = [];
        for ($i = 1; $i <= $pages; $i++) {
            $page_index[] = $i;
        }

        if (isset($page_nr)) {
            $page = $page_nr - 1;
            $start = $page * $rows_per_page;
        }


        $sql = "SELECT *
        FROM categories
        WHERE name LIKE '%" . $search . "%'
        LIMIT $start, $rows_per_page";


        $result = $this->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return [$data, $page_index];
    }


    public function findByName($search, $page_nr)
    {
        $start = 0;

        $rows_per_page = 10;

        $supsql = "SELECT p.*
        FROM products p
        INNER JOIN categories c ON p.category_id = c.id
        WHERE p.name LIKE '%" . $search . "%' OR c.name LIKE '%" . $search . "%'";

        $records = $this->query($supsql);

        $nr_of_rows = $records->num_rows;

        $pages = ceil($nr_of_rows / $rows_per_page);

        $page_index = [];
        for ($i = 1; $i <= $pages; $i++) {
            $page_index[] = $i;
        }

        if (isset($page_nr)) {
            $page = $page_nr - 1;
            $start = $page * $rows_per_page;
        }


        $sql = "SELECT p.*
        FROM products p
        INNER JOIN categories c ON p.category_id = c.id
        WHERE p.name LIKE '%" . $search . "%' OR c.name LIKE '%" . $search . "%'
        LIMIT $start, $rows_per_page";


        $result = $this->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return [$data, $page_index];
    }


    public function create($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $valuesList = array_map(function ($value) {
            return "'" . $value . "'";
        }, array_values($data));
        $value = implode(',', $valuesList);
        $sql = "INSERT INTO $table ($columns) VALUES ($value)";
        return $this->query($sql);
    }

    public function update($table, $data, $id)
    {
        $list = [];
        foreach ($data as $key => $val) {
            array_push($list, "$key='" . $val . "'");
        }
        $listData = implode(',', $list);
        $sql = "UPDATE $table SET $listData WHERE id=$id";
        return $this->query($sql);
    }

    public function destroy($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id=$id";
        return $this->query($sql);
    }
}
