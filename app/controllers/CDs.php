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
            'pathToDetailedInfo' => URLROOT . 'cds/details',
            'pageTitle' => 'Notre collection de vinyl',
            'cds' => $cds
        ];
        $this->loadView('pages/cdlist', $data);

    }

    public function details($id){
        $idNumber = substr($id, 3);
        $cd = $this->cdModel->getSingleCD($idNumber);
        $data = [
            'cd' => $cd
        ];
        $this->loadView('pages/cddetailedinfo', $data);
    }




}