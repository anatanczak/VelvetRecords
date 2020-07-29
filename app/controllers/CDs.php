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
        $data = [
            'title' => 'Succès',
            'message' => 'Le disc a été supprimé avec le succès.'
        ];
        $this->loadView('pages/success', $data);
    }






    /* THis method adds a cd to a database*/

    public function add(){

        //Prepare a list of artists to display in a select
        $artistModel = $this->loadModel('Artist');
        $result = $artistModel->getAllArtists();

        $artistList = array();
        foreach($result as $key => $value){
            $artistList[$value->artist_id] = $value->artist_name;
        }
        $data = [
            'artists' => $artistList
        ];

        //Check if the form is being submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);



            $data['title'] = $_POST['title'];
            $data['artist'] = $_POST['artist'];
            $data['year'] = $_POST['year'];
            $data['genre'] = $_POST['genre'];
            $data['label'] = $_POST['label'];
            $data['price'] = $_POST['price'];

            $data = validateFields($data);
            //change this to get this number from the array
            $formErrors = $data['formErrors'];


            //VALIDATE IMAGE UPLOAD
            //get the path where the uploaded file is stored temporarily
            $temporaryImg = $_FILES['file']['tmp_name'];
            //set the final directory to move the file to after validation
            $targetDir = 'images/covers/';

            $validation = validateImage();
            $data['errors']['img_upload_error'] = $validation['errorMessage'];
                $formErrors += $validation['errorCount'];

            $imageExtension = $validation['imageExtension'];


            //CHECK IF THERE ARE ANY ERRORS IN THE FORM
            if ($formErrors === 0){
                //INSERT THE CD WITHOUT PICTURE AND GET THE ID
                $CDID = $this->cdModel->addCDWithoutImage($data);

                //set the target path using basename fun which returns the trailing name component from the path
                if($CDID && $targetDir && $imageExtension && $temporaryImg){
                    $targetImage = $targetDir . $CDID . $imageExtension;
                   //Upload Img
                    if( move_uploaded_file($temporaryImg, $targetImage)){
                        //make the file not executable
                        chmod($targetImage, 0644);

                        //get the name of the image
                        $imageName = basename($targetImage);
                        //add the image to data base

                        $this->cdModel->updateImageTitle($CDID, $imageName);
                        $successMessageData = [
                            'title' => 'Succès',
                            'message' => 'Le disc a été ajouté dans la base de données.'
                        ];
                        $this->loadview('pages/success', $successMessageData);
                    } else {
                        //TODO: ADD CUSTOM ERROR HANDLER TO SHOW THE ERROR MESSAGE
                        echo 'An error occurred while uploading the image';
                    }
                } else {
                    //TODO: ADD CUSTOM ERROR HANDLER TO SHOW THE ERROR MESSAGE
                    echo "One of the variables needed to store the image wasn't set";
                }

            } else {
                $this->loadview('pages/cdForm', $data);
            }

        } else {
            $this->loadView('pages/cdForm', $data);
        }
    }


    //This method updates CD info

    public function update($id) {

        //make a query to get info about the cd
        $idNumber = substr($id, 3);
        $cd = $this->cdModel->getSingleCD($idNumber);

        //Prepare a list of artists to display in a select
        $artistModel = $this->loadModel('Artist');
        $result = $artistModel->getAllArtists();

        $artistList = array();
        foreach($result as $key => $value){
            $artistList[$value->artist_id] = $value->artist_name;
        }
        //create a data array
        $data = [
            'id' => $cd->disc_id,
            'title' => $cd->disc_title,
            'year' => $cd->disc_year,
            'label' => $cd->disc_label,
            'genre' => $cd->disc_genre,
            'price' => $cd->disc_price,
            'artist' => $cd->artist_name,
            'picture' => $cd->disc_picture,
            'artists' => $artistList
        ];

        //check if post else present the view and pass in data array

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //compare old values with new and set them if needed

            $data['title'] = compareValues($data['title'], $_POST['title']);
            $data['year'] = compareValues($data['year'], $_POST['year']);
            $data['label'] = compareValues($data['label'], $_POST['label']);
            $data['genre'] = compareValues($data['genre'], $_POST['genre']);
            $data['price'] = compareValues($data['price'], $_POST['price']);
            $data['artist'] = compareValues($data['artist'], $_POST['artist']);


            //validate the fields
           $data = validateFields($data);
           $formErrors = 0;
           $formErrors += $data['formErrors'];

           //check if there is a picture  to change and proceed to the picture validation

            if($_FILES['file']['name']) {
                //VALIDATE IMAGE UPLOAD
                //get the path where the uploaded file is stored temporarily
                $temporaryImg = $_FILES['file']['tmp_name'];

                //set the final directory to move the file to after validation
                $targetDir = 'images/covers/';

                $validation = validateImage();
                $data['errors']['img_upload_error'] = $validation['errorMessage'];
                $formErrors += $validation['errorCount'];

                $imageExtension = $validation['imageExtension'];

                $CDID = $data['id'];
                //set the target path using basename fun which returns the trailing name component from the path
                if($CDID && $targetDir && $imageExtension && $temporaryImg){
                    $targetImage = $targetDir . $CDID . $imageExtension;
                    //Upload Img
                    if( move_uploaded_file($temporaryImg, $targetImage)){
                        //make the file not executable
                        chmod($targetImage, 0644);

                        //get the name of the image
                        $imageName = basename($targetImage);
                        //add the image to data base
                        $this->cdModel->updateImageTitle($CDID, $imageName);

                    } else {
                        //TODO: ADD CUSTOM ERROR HANDLER TO SHOW THE ERROR MESSAGE
                        echo 'An error occurred while uploading the image';
                    }
                } else {
                    //TODO: ADD CUSTOM ERROR HANDLER TO SHOW THE ERROR MESSAGE
                    echo "One of the variables needed to store the image wasn't set";
                }
            }

            //update pictureField only if the picture changes

            //delete the old picture

            //update all fields except the picture
           if ( $formErrors === 0) {
               $data = [
                   'id' => $data['id'],
                   'title' => $data['title'],
                   'year' => $data['year'],
                   'label' => $data['label'],
                   'genre' => $data['genre'],
                   'price' => $data['price'],
                   'artist' => $data['artist']
               ];
               //TODO: UPDATE FIELDS
               $rowIsUpdated = $this->cdModel->updateAllFieldsWithoutImage($data);
               //Show Success message

               if($rowIsUpdated){
                   $successMessageData = [
                       'title' => 'Succès',
                       'message' => 'Les modifications ont été enregistrées dans la base de données.'
                   ];
                   $this->loadview('pages/success', $successMessageData);
               } else {
                   echo "Les changements n'ont pas été enregistrés";
               }

           } else {
               $this->loadview('pages/cdForm', $data);
           }


        } else {
            $this->loadview('pages/cdForm', $data);
        }
    }

}