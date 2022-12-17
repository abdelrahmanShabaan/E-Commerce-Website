<?php
    include 'connect.php';
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

// include navbar on all page except the one with $noNavbar variabel
if(!isset($noNavbar)){ include  $tpl . 'navbar.php';}