<?php

class Product {

    private $name = "Product";

    public function printoutName() {
        echo $this->name;
    }

    //!!!User defined function are case insensitive in PhP
    public function showAll(){
        echo "We are in a public fun showAll in a product controller";
    }
    public function __construct(){
        $this->printoutName();
    }

}