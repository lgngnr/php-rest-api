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

    // Get products
    $result = $product->read();
    //Number of rows
    $num = $result->rowCount();

    // Check if products
    if($num > 0){
        $product_arr = array();
        $product_arr['data'] = array();
        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
            //** extract array fields into variables*/
            extract($row);
            $product_item = array(
                'id' => $id,
                'title' => $title,
                'category_id' => $category_id,
                'category_name' => $category_name,
                'price' => $price
            );

            array_push($product_arr['data'], $product_item);
        }

        // Encode $post_arr to json & output 
        echo json_encode($product_arr);

    }else{
        // No Products
        echo json_encode(
            array('message' => 'No products found')
        );
    }
?>