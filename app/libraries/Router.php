<?php

class Router {
    protected $pathToControllers = '../app/controllers/';
    //set the default controller
    protected $currentController = 'HomeController';
    //set the default method
    protected $currentMethod = 'index';
    protected $params = [];


    public function getUrl($fromQueryString){
        $url = rtrim($fromQueryString, '/');
        $url = filter_var($fromQueryString, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        var_dump($url);
        return $url;
    }

    public function  __construct($querystring)
    {
        global $pathToControllers;
        //get the url from the param entered while initialisation
        $url = $this->getUrl($querystring);


        //get the controller if there is any
        if(isset($url[0])){
            //capitalize the first letter of the controller
            $controller = ucwords($url[0]);

            if(file_exists( '../app/controllers/' . $controller .'.php')){
                $this->currentController = $controller;
                echo $this->currentController;
                //unset 0 index
                unset($url[0]);
            }
        }
        var_dump($url);

        //require the controller
        require_once $this->pathToControllers . $this->currentController .'.php';
        //instantiate controller class
        $this->currentController = new $this->currentController;


        //get the method if there is any
        if(isset($url[1])){
            $method = $url[1];

            if(method_exists($this->currentController, $method)) {
                $this->currentMethod = $method;
                var_dump($this->currentMethod);
            }
            unset($url[1]);
        }

        //get params if there is any or reset them to an empty array
        $this->params = $url ? array_values($url) : [];

        //call the method of the class and pass the params array
        call_user_func_array([$this->currentController, $this->currentMethod
        ], $this->params);
    }
}