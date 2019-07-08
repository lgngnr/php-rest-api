<?php

    /** HEADERS */
    header('Access-Control-Allow-Origin: *'); // public api
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Product.php';

    /** Istantiate DB & connect */
    $database = new Database();
    $db = $database->connect();

    /** Istantiate Product object */
    $product = new Product($db);

    // GET id from url
    $product->id = isset($_GET['id']) ? $_GET['id'] : die();

    // GET product
    $product->read_single();

    // Create array
    $product_arr = array(
        'id' => $product->id,
        'category_id' => $product->category_id,
        'category_name' => $product->category_name,
        'title' => $product->title,
        'price' => $product->price,
    );

    // Encode to json and output
    print_r(json_encode($product_arr));
?>