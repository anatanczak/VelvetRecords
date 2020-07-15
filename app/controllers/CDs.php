<?php

class CDs extends Controller {
    public $cdModel;

    public function __construct(){
        $this->cdModel = $this->loadModel('CD');
    }

    //!!!User defined function are case insensitive in PhP
    public function index() {
        $cds = $this->cdModel->getAllCDs();
        $data = [
            'pageTitle' => 'OUR CD COLLECTION',
            'cds' => $cds
        ];
        $this->loadView('pages/cdlist', $data);

    }




}