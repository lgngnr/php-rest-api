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
        public function __construct($db){
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
            $stmt->execute();
            return $stmt;
        }

        /** READ product from db @return  */
        public function read_single(){
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
                p.category_id = c.id
            WHERE
                p.id = ?
            LIMIT 0,1";

            // Prepared Statement
            $stmt = $this->conn->prepare($query);
            // BIND id
            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->title = $row['title'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];
            $this->price = $row['price'];
            
        }
    }
?>