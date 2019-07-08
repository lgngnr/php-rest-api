<?php 
    class Category{

        // DB
        private $conn;
        private $table = "categories";

        // Properties
        public $id;
        public $name;

        /** Constructor @param mixed $db*/
        public function __construct($db){
            $this->conn = $db;
        }

        /** READ All categories @return mixed stmt */
        public function read(){
            $query = " SELECT * FROM $this->table";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

    }

?>