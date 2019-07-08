<?php 
    // HEADERS 
    header('Access-Control-Allow-Origin: *'); // public api
    header('Access-Control-Allow-Metohds: PUT'); 
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
    $product->title = $data->title;
    $product->category_id = $data->category_id;
    $product->price = $data->price;

    // Create product
    if($product->update()){
        echo json_encode(array("message"=>"Product updated"));
    }else{
        echo json_encode(array("message"=>"Product not updated"));
    }
?>