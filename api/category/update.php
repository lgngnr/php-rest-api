<?php
    header("Access-Control-Allow-Origin: *"); //public api
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow_Headers: Access-Control-Allow_Headers,Access-Control-Allow-Methods
            Content-Type,Authorization,X-Requested-With");
    header("Content-Type: Application/json");

    include_once "../../config/Database.php";
    include_once "../../models/Category.php";

    // Istantiate DB
    $database = new Database();
    $db = $database->connect();

    // Istantiate Category obj
    $category = new Category($db);

    // Get raw data
    $data = json_decode(file_get_contents("php://input"));

    $category->id = $data->id;
    $category->name = $data->name;

    if($category->update()){
        echo json_encode(array("message"=>"Category updated"));
    }else{
        echo json_encode(array("message"=>"Category not updated"));
    }


?>