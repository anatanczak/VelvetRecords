<?php

class CDs extends Controller {
    public $cdModel;

    public function __construct(){
        $this->cdModel = $this->loadModel('CD');
    }

    //!!!User defined function are case insensitive in PhP

    /*This method shows all Cds present in the database */
    public function index() {
        $cds = $this->cdModel->getAllCDs();
        $data = [
            'pathToDetailedInfo' => URLROOT . 'cds/details',
            'pageTitle' => 'Notre collection de vinyl',
            'cds' => $cds
        ];
        $this->loadView('pages/cdlist', $data);

    }


    /*This method shows a singular CD */
    public function details($id){
        $idNumber = substr($id, 3);
        $cd = $this->cdModel->getSingleCD($idNumber);
        $data = [
            'cd' => $cd
        ];
        $this->loadView('pages/cddetailedinfo', $data);
    }

    /*This method deletes the cd from the database and redirects to the cd
    list page. Only logged in users can delete cds */

    public function remove($id) {

        $this->cdModel->removeSingleCD($id);
        redirect('cds/index');
    }

    public function add(){
        //Check if the form is being submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
echo 'posting';
        } else {
            $this->loadView('pages/addCdForm');
        }
    }

}