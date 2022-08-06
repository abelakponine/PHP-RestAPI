<?php
    declare(strict_types=1);
    namespace Vendor\App\Modules\Controllers;
    
    class Router {
        public static $endpoints = [];

        function addEndpoint(string $endpoint): void {
            array_push($this::$endpoints, $endpoint);
        }

        function getEndpoints(){
            return $this::$endpoints;
        }
    }