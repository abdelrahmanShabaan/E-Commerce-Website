<?php

session_start();
$pageTitle = 'show items';
include 'init.php';

//Check if get request itemID is numeric and get the integer calue if it
$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
    //  check if th user is exist from userID
    $stmt = $con->prepare("SELECT *  FROM items WHERE item_ID= ? ");
//execute the quiers
$stmt->execute(array($itemid));
$count = $stmt->rowCount();

if($count > 0 ){


// fetch the Date
$item = $stmt->fetch();

?>

<h1 class="text-center">Show Items</h1>


<div class="container">
    <div class="row">
        <div class="col-md-3">
        <img class="img-responsive img-thumbnail center-block" src="rab.png" alt="" />
        </div>
        <div class="col-md-9">
            <h2><?php echo $item['name'] ?></h2>
            <p><?php echo $item['description'] ?></p>
            <span><?php echo $item['add_Date'] ?></span>
            <div>Price $<?php echo $item['price'] ?></div>
            <div>Made In :<?php echo $item['country_made'] ?></div>
        </div>
    </div>
</div>

<?php

}else {
    echo 'there is no such ID ';
}
include $tpl . 'footer.php';



?>
