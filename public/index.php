<?php
echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . '"';

require ('../App/Libraries/Router.php');


$router = new Router($_SERVER['QUERY_STRING']);

