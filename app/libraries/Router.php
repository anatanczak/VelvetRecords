<?php

class Router {
    protected $currentController = 'HomeController';
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
        $url = $this->getUrl($querystring);
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            $this->currentController = ucwords($url[0]);
            echo $this->currentController;
            //unset 0 index
            unset($url[0]);
        }
        var_dump($url);

        //require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        //instantiate controller class
        $this->currentController = new $this->currentController;
    }
}