<?php

class HomeController {

    private $name = "HomeController";

    public function printoutName() {
        echo $this->name;
    }



    public function __construct(){
        $this->printoutName();
    }

}