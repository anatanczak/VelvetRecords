<?php

class Product {

    private $name = "Product";

    public function printoutName() {
        echo $this->name;
    }

    public function __construct(){
        $this->printoutName();
    }

}