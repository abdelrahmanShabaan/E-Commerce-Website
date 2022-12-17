<?php

$sdn = 'mysql:host=localhost;dbname=shop';

$username = 'root';
$password ='';
$option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try{
    // HERE WE CONNECT TO PDO::WAYS 
    $con = new PDO($sdn,$username ,$password,$option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // HERE WE WILL MAKE PRINT FOR 
   // echo 'YOU ARE CONNECTED WELCOME TO DATABASE';
}

catch(PDOException $e){
    // HERE WE WILL MAKE PRINT FAILD CONNECTION PDO::HERE
    echo 'Failed To Connect' . $e->getMessage();

}

