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

        /** READ product from db and set model's fields  */
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

        //**Create new Product */
        public function create(){
            $query = "INSERT INTO $this->table 
            SET 
                title = :title,
                category_id = :category_id,
                price = :price";

            // Prepared Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->price = htmlspecialchars(strip_tags($this->price));

            // Bind data to param
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":price", $this->price);

            if($stmt->execute()){
                return true;
            };

            // Print error
            printf("Error: %s./n", $stmt->error);

            return false;
        }
    }
?>