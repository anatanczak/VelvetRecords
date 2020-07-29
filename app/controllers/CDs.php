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


    /* THis method adds a cd to a database*/

    public function add(){

        //Prepare a list of artists to display in a select
        $artistModel = $this->loadModel('Artist');
        $result = $artistModel->getAllCDs();

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

            $formErrors = 0;

            $data['title'] = $_POST['title'];
            $data['artist'] = $_POST['artist'];
            $data['year'] = $_POST['year'];
            $data['genre'] = $_POST['genre'];
            $data['label'] = $_POST['label'];
            $data['price'] = $_POST['price'];

            //SET REGEX
            //Any character except for <>%\$
           $allASCIILettersAndNumbersRegex = '/^[^<>%\$]{1,255}$/';

            //Any character except for <>%\$
            $yearRegex = '/^[\d]{4}$/';

            //Price Regex
            $priceRegex = '/^(?<whole>[0-9]{1,4})([\,\.]{1}(?<decimal>\d\d?))?$/';

            //Validate title
            $titleIsValid = preg_match($allASCIILettersAndNumbersRegex,
                $data['title']);

            if (empty($data['title']) || !$titleIsValid){
                $data['errors']['title_error'] = 'Entrez un titre valide.';
                $formErrors++;
            }


            //Validate artist

            if (in_array($data['artist'], $artistList)){
                $data['artist'] = array_search($data['artist'], $artistList);
            } else {
                $data['errors']['artist_error'] = 'Entrez un artiste valide.';
                $formErrors++;
            }

            //Validate year
            $yearRegexIsValid = preg_match($yearRegex,
                $data['year']);


                $year = intval($data['year']);
                $currentYear = intval(date('Y'));
                if($year > 1900 && $year <= $currentYear){
                    $yearIsValid = true;
                } else {
                    $yearIsValid = false;
                }

            if (empty($data['year']) || !$yearRegexIsValid || !$yearIsValid){
                $data['errors']['year_error'] = 'Entrez une année valide.';
                $formErrors++;
            }


            //Validate genre
            $genreIsValid = preg_match($allASCIILettersAndNumbersRegex,
                $data['genre']);

            if (empty($data['genre']) || !$genreIsValid){
                $data['errors']['genre_error'] = 'Entrez un genre valide.';
                $formErrors++;
            }

            //Validate label
            $labelIsValid = preg_match($allASCIILettersAndNumbersRegex,
                $data['label']);

            if (empty($data['label']) || !$labelIsValid){
                $data['errors']['label_error'] = 'Entrez un label valide.';
                $formErrors++;
            }

            //Validate price
            preg_match($priceRegex,
                $data['price'], $matches);

            if($matches){
                if(array_key_exists('whole', $matches)){
                    $whole = $matches['whole'];
                } else {
                    $whole = '';
                }

                if(array_key_exists('decimal', $matches)){
                    $decimal= $matches['decimal'];
                } else {
                    $decimal = '';
                }

                $data['price'] = $whole . '.' . $decimal;
            } else {
                $data['errors']['price_error'] = "Entrez un prix valide";
                $formErrors++;
            }

            //VALIDATE IMAGE UPLOAD


            if($_FILES['file']['name']){

                //get the path where the uploaded file is stored temporarily
                $temporaryImg = $_FILES['file']['tmp_name'];
                //set the final directory to move the file to after validation
                $targetDir = 'images/covers/';

                $maxFileSize = 5000000; //5MB
                $allowedImageTypes = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);


                //get an array of info from image
                $imageCheck = getimagesize($temporaryImg);

                if(isset($imageCheck['mime'])){
                    $imageExtension = explode('/', $imageCheck['mime']);
                    $imageExtension = '.' . $imageExtension[1];
                }

                //Check the image type by comparing index 2 (a constant of type IMAGETYPE_XXX) to the allowedImageTypes array
                if (! in_array($imageCheck[2], $allowedImageTypes)) {
                    $data['errors']['img_upload_error'] = 'Images acceptées: gif, jpeg, png!';
                    $formErrors++;
                }

                //Check the size
                if (filesize($temporaryImg) > $maxFileSize){
                    $data['errors']['img_upload_error'] = 'Taille maximale autorisée est 5MB';
                    $formErrors++;
                }


            } else {
                $data['errors']['img_upload_error'] = 'Ajouter un ficher';
                $formErrors++;
            }

            //CHECK IF THERE ARE ANY ERRORS IN THE FORM
            if ($formErrors === 0){
                echo "no errors in the form";
                echo $data['title'];

                /*TODO:
                       Insert cd into database and return the row
                       Write the image into the folder (with the id as a name)
                       Check if we can use third party libraries to
                       Add chmod on the written image
                        */
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

                        var_dump($this->cdModel->updateImageTitle($CDID, $imageName));
                    } else {
                        //TODO: ADD CUSTOM ERROR HANDLER TO SHOW THE ERROR MESSAGE
                        echo 'An error occurred while uploading the image';
                    }
                } else {
                    //TODO: ADD CUSTOM ERROR HANDLER TO SHOW THE ERROR MESSAGE
                    echo "One of the variables needed to store the image wasn't set";
                }

            } else {
                $this->loadview('pages/addCdForm', $data);
            }

        } else {
            $this->loadView('pages/addCdForm', $data);
        }
    }

}