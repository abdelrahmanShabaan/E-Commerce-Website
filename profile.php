<?php

session_start();
$pageTitle = 'Profile';
include 'init.php';
if (isset($_SESSION['user'])) {

    $getUser = $con->prepare("SELECT * FROM users WHERE username = ? ");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetch();

?>

<h1 class="text-center"><?php echo 'welcome : ' . $_SESSION['user'] ?></h1>
<div class="information block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel panel-heading"> My Information </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                   <li>
                    <i class="fa fa-unlock-alt fa-fw"></i>
                     <span>Name</span> <?php echo $info['username'] ?>
                     </li>
                   <li> 
                    <i class="fa fa-envelope-o fa-fw"></i>
                   <span>Email</span> 
                   <?php echo $info['email'] ?> 
                </li>
                   <li> 
                    <i class="fa fa-user fa-fw"></i>
                     <span>Full Name</span> <?php echo $info['fullname'] ?> 
                    </li>
                   <li> 
                    <i class="fa fa-calendar fa-fw"></i>
                    <span> Favourit Category </span><?php echo $info['date'] ?> 
                    </li>
                    <li>
                    <i class="fa fa-tags fa-fw"></i>
                    <span> fav Category </span> 
                    </li>
                    </ul>
                    <a href="#" class="btn btn-default">Edit Information</a>
            </div>
        </div>
    </div>
</div>



<div class="my-ads block">
<div class="container">
        <div class="panel panel-primary">
            <div class="panel panel-heading"> Latest Comments </div>
                <div class="panel-body">
    <?php 
    
    if(!empty(getItems('Member_ID',$info['userID']))){
      foreach (getItems('Member_ID',$info['userID']) as $item){
        echo '<div class="row">';
        echo '<div class="col-sm-6 col-md-3>">';
        echo '<div class="thumbnail item-box">';
        echo '<span class="price-tag">' .$item['price'] .  '</span>';
        echo '<img class="img-responsive" src="rab.png" alt="" />';
        echo '<div class="caption">';
        echo '<h3 class="text-center"> <a href="items.php?itemid='.$item['item_ID'] . '">' . $item['name']  .  '</a></h3>';
        echo '<p class="text-center">' . $item['description'].  '</p>';
        echo '<p class="text-center date">' . $item['add_Date'].  '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
            }
        echo '</div>';
        }    else {
        echo 'sorry no ads to show , create <a href="newad.php"> New Add</a>';
        }      
?>
                 </div>
            </div>
    </div>
</div>



<div class="my-comments block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel panel-heading"> Latest Comments </div>
                <div class="panel-body">
    

                <?php
                 $stmt = $con->prepare("SELECT comment FROM comments WHERE user_id = ?");
                //execute
                $stmt->execute(array($info['userID']));
                $comments  = $stmt->fetchAll();

                if (!empty($comments)){
                        foreach ($comments as $com)
                        {
                            echo '<p>' . $com['comment'] . '</p>' . '<br>';
                        }
                }else{
                    echo ' There is no comments';

                }
                ?>

            </div>
        </div>
    </div>
</div>


<?php
include $tpl . 'footer.php';

}else {
    header('Location: login.php');
    exit();
}

?>
