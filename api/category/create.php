<?php 
    header("Allow-Access-Control-Origin: *"); //public api
    header("Allow-Access-Control-Method: POST");
    header("Allow-Access-Control-Headers: 
        Allow-Access-Control-Headers,Allow-Access-Control-Method,
        Content-type, Authorization, X-Requested-With");
    header("Content-type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/Category.php";

    // Istantiate DB
    $database = new Database();
    $db = $database->connect();

    // Istantiate Category Object
    $category = new Category($db);

    // Get raw data
    $data = json_decode(file_get_contents("php://input"));

    // fillup model obj
    $category->name = $data->name;

    if($category->create()){
        echo json_encode(array('message'=>'Category added'));
    }else{
        echo json_encode(array('message'=>'Category not added'));
    }


?>