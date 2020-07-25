<?php
class Users extends Controller{
    private $userModel;

    public function __construct(){
        $this->userModel = $this->loadModel('User');
    }

    public function index() {

        //TODO: Display account info and possibility to modify it
    }

    public function register() {
        //Check if the form is being submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $formErrors = 0;
            $data =[
                'firstName' => trim($_POST['firstName']),
                'lastName' => trim($_POST['lastName']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'errors' => [
                    'firstNameError' => '',
                    'lastNameError' => '',
                    'emailError' => '',
                    'passwordError' => '',
                    'confirmPasswordError' => ''
                ]

            ];

            // Validate LastName
            if(empty($data['lastName'])){
                $data['errors']['lastNameError'] = 'Entrer votre nom.';
            }

            // Validate FirstName
            if(empty($data['firstName'])){
                $data['errors']['firstNameError'] = 'Entrer votre prénom.';
            }

            // Validate Email
            if(empty($data['email'])){
                $data['errors']['emailError'] = 'Entrer un email valide.';
            } elseif($this->userModel->verifyEmail($data['email'])){
                //check if email exists in the database
                $data['errors']['emailError'] = 'Utilisateur avec le même email existe déja. Veuillez choisir un autre email ou vous connecter.';
            }


            //Validate Password
            if(empty($data['password'])){
                $data['errors']['passwordError'] = 'Entrer un mot de passe.';
            } elseif(strlen($data['password']) < 6) {
                echo 'pass is less than 6 charachters';
                $data['errors']['passwordError'] = 'Votre mot de passe doit avoir au moins 6 characters.';
            }

            //Validate confirmPassword
            if(empty($data['confirmPassword'])) {
                $data['errors']['confirmPasswordError'] = 'Confirmer le mot de passe.';
            } elseif($data['confirmPassword'] != $data['password']) {
                $data['errors']['confirmPasswordError'] = 'Le mot de passe de
                confirmation est différent de mot de passe';
            }

            foreach($data['errors'] as $error) {
                if($error){
                    $formErrors ++;
                }
            }
            // Make sure errors are empty
            if($formErrors === 0){
                //hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                $userISRegisteredWithSuccess = $this->userModel->register
                ($data);

                //register user
                if($userISRegisteredWithSuccess){
                    //Present a success message

                    $data = ['title' => 'Succès!',
                        'message' => 'Merci ' . $data['firstName'] . ' pour votre inscription. Vous pouvez vous connecter dès maintenant.',
                        'urlTitle' => 'Me connecter'
                    ];
                    $this->loadView('pages/success', $data);
                } else {
                    die('something went wrong');
                }


            } else {
                $this->loadView('users/register', $data);
            }


        } else {
            //Load form
            //init data - the array with empty values to keep data if the
            // view gets rerender
            $data = [
                'firstName' => '',
                'lastName' => '',
                'email' => '',
                'password' => '',
                'confirmPassword' => '',
                'errors' => [
                    'firstNameError' => '',
                    'lastNameError' => '',
                    'emailError' => '',
                    'passwordError' => '',
                    'confirmPasswordError' => ''
                ]
            ];
            //load view
            $this->loadView('users/register', $data);
        }
    }





    /* ------------      LOGIN       -----------------------*/

    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => ''
            ];

            // Validate Email
            if(empty($data['email']) || !$this->userModel->verifyEmail($data['email'])){
                $data['emailError'] = 'Entrez un email valide.';
            }

            //Validate Password
            if(empty($data['password'])){
                $data['passwordError'] = 'Entrez un mot de passe valide.';
            }

            //MATCH THE EMAIL TO THE USER
            $loggedInUser = $this->userModel->login($data['email'], $data['password']);

            if(!$loggedInUser){
                $data['passwordError'] = 'Entrez un mot de passe valide.';
            }



            if($data['emailError'] || $data['passwordError']){
                $errors = [
                    'emailError' => 'Entrez un email valide.',
                    'passwordError' => 'Entrez un mot de passe valide.'
                ];
                $errorsJSON = json_encode($errors);
                echo $errorsJSON;

            } else {
                $this->createUserSession($loggedInUser);
                $errors = [
                    'emailError' => '',
                    'passwordError' => ''
                ];
                $errorsJSON = json_encode($errors);
                echo $errorsJSON;

            }

        } else {
            redirect('cds/index');
        }


    }



    /* ------- CREATE USER SESSION VARIABLES   ------------- */

    private function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->first_name;
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();

    }
}