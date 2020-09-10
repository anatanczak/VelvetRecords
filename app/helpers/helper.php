<?php
/*--------- SESSION HELPER -----------------*/

session_start();



/*--------- REDIRECT FUNCTION -----------------*/
function redirect($page){
    header("Location: " . URLROOT . $page);
}


/* -------------    DATA VALIDATION HELPER ------------*/

function validateFields($data){
    $formErrors = 0;

    //SET REGEX
    //Any character except for <>%\$
    $allASCIILettersAndNumbersRegex = '/^[^<>%\$]{1,255}$/';

    //year
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

    if (in_array($data['artist'], $data['artists'])){
        $data['artist'] = array_search($data['artist'], $data['artists']);
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
    $data['formErrors'] = $formErrors++;
    return $data;
}


/* -------------    IMAGE VALIDATION HELPER ------------*/

function validateImage(){
    $formErrors = 0;
    $errorMessage = Null;
    $imageExtension = Null;

    if($_FILES['file']['name']){

        //get the path where the uploaded file is stored temporarily
        $temporaryImg = $_FILES['file']['tmp_name'];


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
            $errorMessage = 'Images acceptées: gif, jpeg, png!';
            $formErrors++;
        }

        //Check the size
        if (filesize($temporaryImg) > $maxFileSize){
            $errorMessage = 'Taille maximale autorisée est 5MB';
            $formErrors++;
        }
    } else {
        $errorMessage = 'Ajouter un ficher';
        $formErrors++;
    }

    return $data = [
        'errorMessage' => $errorMessage,
        'errorCount' => $formErrors,
        'imageExtension' => $imageExtension
    ];
}

/*  ----- compare two values and assign one to the other if different ---------  */

function compareValues($oldValue, $newValue){
    if ($oldValue !== $newValue){
        $oldValue = $newValue;
    }

    return $oldValue;
}