<?php

/*
===================================================
== Mange memebers Page
== You can here ADD | EDIT | DELETE | MEMBERS FROM HERE
===================================================
*/

ob_start(); // Output Buffering Start
// Start session for user login
session_start();

//make page Items
$pageTitle = '';

if (isset($_SESSION['username'])) {
     
    include('init.php');
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    // start Manage page
    if ($do == 'Manage') {
        echo "welcome";

    } elseif ($do == 'Add') {

    } elseif ($do == 'Insert') {


    } elseif ($do == 'Edit') {


    } elseif ($do == 'Update') {

    } elseif ($do == 'Delete') {

    } elseif ($do == 'Approve') {
    }

    include $tpl . 'footer.php';

}else {


    header('Location :index.php');
    exit();
}
ob_end_flush(); //Relase the output

?>