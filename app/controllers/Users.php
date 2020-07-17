<?php
class Users extends Controller{
    public function __construct(){

    }

    public function register() {
        //Check if the form is being submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //process form
            echo 'form is being submitted';
        } else {
            //Load form
            //init data - the array with empty values to keep data if the
            // view gets rerender
            $data = [

            ];
            //load view
            $this->loadView('users/register', $data);
        }
    }
}