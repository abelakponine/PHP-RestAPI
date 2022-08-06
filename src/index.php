<?php
    session_start();

    require_once 'config.php';

    use Vendor\App\Modules\Controllers\GET; // HTTP GET Method
    use Vendor\App\Modules\Controllers\POST; // HTTP POST Method
    use Vendor\App\Modules\Handlers\Product; // Product class


    echo "<pre>";

    if (!isset($_SESSION['Products'])){
        $_SESSION['Products'] = []; // Initialize product list
    }

    /** Reset Products list */
    if (explode('/',  $_SERVER['REQUEST_URI'])[1] === 'reset'){
        session_unset();
        session_destroy();
        session_start();
        echo "Product List has been reseted.";
    }

    /** Get Product endpoint */
    if (explode('/',  $_SERVER['REQUEST_URI'])[1] === 'products'){
        
        new Get('/products', function(): array {
            print_r($_SESSION['Products']);
            return $_SESSION['Products'];
        });
    }

    /** Add product to list */
    if (explode('/',  $_SERVER['REQUEST_URI'])[1] === 'addProduct'){

        new Post('/addProduct', function(){

            // http_response_code(405);
            $ProductList = $_SESSION['Products'];
            $Post = (array) json_decode(file_get_contents('php://input'), true);

            array_push($ProductList, new Product($Post['id'], $Post['name']));

            $_SESSION['Products'] = $ProductList;

            print_r($_SESSION['Products']);
            
            return $_SESSION['Products'];
        });

        new Get('/addProduct', function(){
            http_response_code(405); // 405 Method not allowed
        });
    }

    echo "</pre>";
?>