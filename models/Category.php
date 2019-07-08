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

         /** READ single category */
         public function read_single(){
            $query = " SELECT * FROM $this->table WHERE id = :id LIMIT 0,1";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->name = $row['name'];
        }

    }

?>