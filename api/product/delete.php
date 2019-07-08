<?php 
    // HEADERS 
    header('Access-Control-Allow-Origin: *'); // public api
    header('Access-Control-Allow-Metohds: DELETE'); 
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, 
        Access-Control-Allow-Metohds,Content-Type, Authorization, X-Requested-With'); 
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Product.php';

    // Istantiate DB & connect 
    $database = new Database();
    $db = $database->connect();

    // Istantiate Product object 
    $product = new Product($db);

    // Get raw data
    $data = json_decode(file_get_contents("php://input"));

    $product->id = $data->id;

    // Delete product
    if($product->delete()){
        echo json_encode(array("message"=>"Product deleted"));
    }else{
        echo json_encode(array("message"=>"Product not deleted"));
    }
?>