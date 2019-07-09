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

        /** Create new category  @return boolean */
        public function create(){
            $query = " INSERT INTO $this->table SET name = :name";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":name", $this->name);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s/n", $stmt->error);
            return false;

        }

        /** Update category */
        public function update(){
            $query = "UPDATE $this->table
                      SET name = :name
                      WHERE id = :id";

            // Prepare statement
            $stmt = $this->conn->prepare($query);
            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->id = htmlspecialchars(strip_tags($this->id));
            // Bind param
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":id", $this->id);

            // Execute
            if($stmt->execute()){
                return true;
            }

            printf("Error: %s/n", $stmt->error);
            return false;
        }

    }

?>