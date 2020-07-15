<?php

/*
 * Base Controller
 * Loads the models and views
 */

class Controller {
    //private $pathToViews = '../app/views/';

    //Load model
    protected function loadModel($model){
        require_once  '../app/models/' . $model . '.php';

        //Instantiate model
        return new $model();
    }

    //Load view
    public function loadView($view, $data = []) {


        if(file_exists('../app/views/' . $view . '.php')) {
            extract($data, EXTR_SKIP);
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View doesn't exist");
        }
    }
}