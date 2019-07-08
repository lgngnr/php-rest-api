<?php 
    /** HEADERS */
    header('Access-Control-Allow-Origin: *'); // public api
    header('Content-Type: application/json');
 
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Istantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Istantiate Category Object
    $category =  new Category($db);

    // GET categories
    $result = $category->read();
    // Number of rows
    $num = $result->rowCount();

    if($num > 0){
        $category_arr = array();
        $category_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            // extract field into variable
            extract($row);
            $category_item = array(
                "id"=>$id,
                "name"=>$name
            );
            // push $category_item to $category_arr['data']
            array_push($category_arr['data'], $category_item);
        }
        
        //output
        echo json_encode($category_arr);
    }else{
        // No Products
        echo json_encode(
            array('message' => 'No categories found')
        );
    }
?>