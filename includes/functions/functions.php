<?php

/** sTART THE FRONT END DESIGNS */


/**
 *  Get All function V1.0
 *  Function To Get Records Items From  any Database table FRONT ENDs
 */

 function getAllFrom($tableName , $orderBy){

    global $con;

    $getAll = $con->prepare("SELECT * FROM $tableName ORDER BY $orderBy DESC");

    $getAll->execute();

    $all = $getAll->fetchAll();

    return $all;
 }





/**
 *  Get Categories function V1.0
 *  Function To Get Records Items From Database FOR FRONT ENDs
 */

 function getCat(){

    global $con;

    $getCat = $con->prepare("SELECT * FROM categories ORDER BY ID  ASC");

    $getCat->execute();

    $cats = $getCat->fetchAll();

    return $cats;
 }


 
/**
 *  Get items function V1.0
 *  Function To Get Records Items From Database FOR FRONT ENDs
 */

 function getItems($where , $value){

    global $con;

    $getItems = $con->prepare("SELECT * FROM items WHERE $where = ? ORDER BY item_ID  DESC");

    $getItems->execute(array($value));

    $item = $getItems->fetchAll();

    return $item;
 }

/**
 *  check if user not activate
 *  Function To check if Regstatus of the user
 */

 function checkUserStatus($user){

    global $con;
    $stmtx = $con->prepare("SELECT username , regstatus
    FROM users
    WHERE username = ?
     AND regstatus= 0 ");
    $stmtx->execute(array($user));
    $status = $stmtx->rowCount();

    return $status;

 }



/** End the FRONT END DESIGNS */

/*
** Title Function that echo the Echo Page Title In case The page [v1.0]
*** Has the variables $pageTitle And Echo Defualt Title For Other Pages
*/

function getTitle(){
    global $pageTitle;

    if(isset($pageTitle)){
        echo $pageTitle;
    }else {
        echo "Defualt";
    }

}


/**
 *  Home Redirect Function p [ This Function Accept Parameters ] v1.0
 * $errorMes = Echo The Error Message 
 * $seconds = Seconds Before Redirecting
 */

 function redirectHome($errorMsg , $seconds = 3  ){

    echo "<div class='alert alert-danger'>$errorMsg</div>";
    echo "<div class='alert alert-info'> You Will Be Redirected To Homepage After $seconds</div>";

    header("refresh:$seconds;url=index.php");
    exit();

 }

 /**
  * Function to check items in database [Function Accept Parameters]
  */

function checkItem($select, $form, $value)
{
    global $con;
    $statment = $con->prepare("SELECT $select FROM $form WHERE $select = ? ");
    $statment->execute(array($value));
    $count = $statment->rowCount();

    return $count;

} 

/**
 * Count numbers of items functions v1.0
 * Functions To count Numbers of items
 * $item = The item to count
 * $table = the table to Choose from
 */

Function countItems($item , $table){
    global $con;
    $stmt2 = $con->prepare("SELECT COUNT(userID) FROM $table");
    $stmt2->execute();
    return $stmt2->fetchColumn();

}


Function countItemss($item , $table){
    global $con;
    $stmt2 = $con->prepare("SELECT COUNT(item_ID) FROM $table");
    $stmt2->execute();
    return $stmt2->fetchColumn();

}

/**
 *  Get latest Records function V1.0
 *  Function To Get Latest Items From Database [ Users , Items , Comments]
 */

 function getLatest($select , $table , $order ,$limit = 5){

    global $con;

    $getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");

    $getStmt->execute();

    $rows = $getStmt->fetchAll();

    return $rows;
 }