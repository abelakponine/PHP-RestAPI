<?php
    declare(strict_types=1);
    namespace Vendor\App\Modules\Controllers;
    
    class Get extends Router {
        
        function __construct(string $url, object|bool|null $callback = null) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET'){ // ensure that request is using GET Method

                if ($_SERVER['REQUEST_URI'] === '/'){
                    // start session
                    session_start();

                    // server information
                    echo '<pre>', var_export([
                            'Host' => $_SERVER['SERVER_NAME'],
                            'Protocol' => $_SERVER['SERVER_PROTOCOL'],
                            'Method' => $_SERVER['REQUEST_METHOD'],
                            'Uri' => $_SERVER['REQUEST_URI'],
                            'Session' => $_SESSION,
                            'Requests' => $_REQUEST]),
                        '</pre>';
                }
                else if (isset($_SERVER['REQUEST_URI'])){
                    // var_dump($this::$endpoints);

                    $class = ucfirst(explode('/', $_SERVER['REQUEST_URI'])[1]); // require class from uri
                    // @require(dirname(__DIR__)."\Handlers\\".$class.'.php');
                    
                    if ($callback){
                        $callback("Vendor\\App\\Modules\\Handlers\\".$class);
                    }
                }
            }
        }
    }
?>