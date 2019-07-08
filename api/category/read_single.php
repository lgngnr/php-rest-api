<?php 

    header("Allow-Access-Control-Origin: *"); //public api
    header("Content-Type: Application/json"); 

    include_once "../../config/Database.php";
    include_once "../../models/Category.php";

    // Istantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Istantiate Category object
    $category = new Category($db);

    // GET id from url
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    // GET category
    $category->read_single();

    $category_item =  array(
        "id"=>$category->id,
        "name"=>$category->name
    );

    echo json_encode($category_item);
?>