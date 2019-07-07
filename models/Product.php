<?php

    class Product{

        // DB
        private $conn;
        private $table = "products";

        // Properties
        public $id;
        public $title;
        public $category_id;
        public $category_name;
        public $price;

        /** Constructor @param $db */
        public function __constructor($db){
            $this->conn = $db;
        }

        /** READ products from db @return statement */
        public function read(){
            $query = "SELECT 
                c.name as category_name,
                p.id,
                p.category_id,
                p.title,
                p.price
            FROM
                $this->table p
            LEFT JOIN
                categories c 
            ON 
                p.category_id = c.id";

            //** Prepared Statement */
            $stmt = $this->conn->prepare($query);
            $stmt->execure();
            return $stmt;
        }
    }
?>