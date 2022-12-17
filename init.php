<?php


//ERROR Reporting
ini_set('display_errors', 'on');
error_reporting(E_ALL);

    include 'admin/connect.php';

        $sessionUser = '';
            if(isset($_SESSION['user'])){
             $sessionUser = $_SESSION['user'];
            }



    //Routes    
    $tpl = 'includes/templates/'; //Templates Directory
    $lang = 'includes/languages/'; // Languaes Directory
    $fun = 'includes/functions/'; // Functions Directory
    $css = 'layout/css/'; //Css Directory
    $js =  'layout/js/'; //js Directory


     
//include The Imprtant Files
include($fun  .'functions.php');
include  $lang . 'english.php';
include  $tpl . 'header.php';

