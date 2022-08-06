<?php
    declare(strict_types=1);
    namespace Vendor\App\Modules\Handlers;
    
    class Product {

        private $id;
        private $name;

        function __construct(int $id, string $name){
            $this->id = $id;
            $this->name = $name;
        }

        function setId(string $id){
            $this->id = $id;
        }

        function getId(){
            echo ($this->id);
            return $this->id;
        }
            
    }

?>