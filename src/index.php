<?php

    require_once 'config.php';

    use Vendor\App\Modules\Controllers\GET; // HTTP GET Method
    use Vendor\App\Modules\Controllers\POST; // HTTP POST Method
    use Vendor\App\Modules\Handlers\Product; // Product class

    
    /** Reset Products list */
    if (explode('/',  $_SERVER['REQUEST_URI'])[1] === 'reset'){
        
        global $conn;
        $sql = "DELETE FROM collections";
        $query = mysqli_query($conn, $sql);

        if ($query){
            echo "Product List has been reseted.";
        }
        else {
            echo mysqli_error($conn);
        }
    }

    /** Get Product endpoint */
    if (explode('/',  $_SERVER['REQUEST_URI'])[1] === 'products'){
          
        new Get('/products', function(): array {
            global $conn;
            $sql = "SELECT * FROM collections";
            $query = mysqli_query($conn, $sql);
            $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

            echo json_encode($result);
            return $result;
        });
    }

    /** Add product to list */
    if (explode('/',  $_SERVER['REQUEST_URI'])[1] === 'addProduct'){
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            // use client's session
            $Post = (array) json_decode(file_get_contents('php://input'), true) ?? $_POST;
            // new Product
            $product = new Product($Post['id'], $Post['name'], $Post['description'], $Post['price']);
            $product->save(); // save to database

            http_response_code(200); // http 200 ok status code

        }
        // disallow GET Method
        else {
            http_response_code(405); // 405 Method not allowed
        }
    }
?>