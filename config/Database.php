<?php
    
    class Database{
        // DB params
        private $host = "";
        private $db_name = "";
        private $username = "";
        private $password = "";
        private $conn;

        /*
            establish db connection
            @return connection object 
        */

        public function connect(){
            $this->conn = null;

            try{
                // PDO(dns, user, pass)
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name",
                    $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo "Connection error " . $e->getMessage();
            }

            return $this->conn;
        }

    }
?>