<?php 
    header("Allow-Access-Control-Origin: *");
    header("Allow-Access-Control-Method: DELETE");
    header("Allow-Access-Control-Headers: Allow-Access-Control-Headers,
            Allow-Access-Control-Method,Content-Type,Authorization,X-Requested-With");
    header("Content-Type: Application/json");

    include_once "../../config/Database.php";
    include_once "../../models/Category.php";

    // Istantiate DB
    $database = new Database();
    $db = $database->connect();

    // Istantiate Category
    $category = new Category($db);

    // GET RAW DATA
    $data = json_decode(file_get_contents('php://input'));

    $category->id = htmlspecialchars(strip_tags($data->id));

    if($category->delete()){
        echo json_encode(array("message"=>"Category deleted"));
    }else{
        echo json_encode(array("message"=>"Category not deleted"));
    }

?>