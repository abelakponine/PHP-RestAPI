<?php
    declare(strict_types=1);
    namespace Vendor\App\Modules\Handlers;
    
    class Product {

        private int $id;
        private string $name;
        private string $description;
        private int $price;

        function __construct(int $id, string $name, string $description, int $price){
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
        }

        function setId(string $id){
            $this->id = $id;
        }
        
        function setName(string $name){
            $this->name = $name;
        }
        
        function setDescription(string $desc){
            $this->description = $desc;
        }
        
        function setPrice(string $price){
            $this->price = $price;
        }
        
        function getId(){
            echo ($this->id);
            return $this->id;
        }

        function getName(){
            echo ($this->name);
            return $this->name;
        }

        function getDescription(){
            echo ($this->description);
            return $this->description;
        }

        function getPrice(){
            echo ($this->price);
            return $this->price;
        }

        function getProductInfo(){
            $info = [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price
            ];
            return $info;
        }
        
        function save(){
            
            global $conn;
            $data = mysqli_real_escape_string($conn, json_encode($this->getProductInfo()));
            $sql = "INSERT INTO collections (`data`) VALUES (\"$data\")";
            $query = mysqli_query($conn, $sql);
            
            if (!$query){
                echo mysqli_error($conn);
            }
            else {
                echo $data;
            }
        }
    }

?>