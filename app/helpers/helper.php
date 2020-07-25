<?php
/*--------- SESSION HELPER -----------------*/

session_start();



/*--------- REDIRECT FUNCTION -----------------*/
function redirect($page){
    header("Location: " . URLROOT . $page);
}