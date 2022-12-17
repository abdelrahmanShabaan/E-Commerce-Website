<?php
session_start();

if(isset($_SESSION['username'])){

    $pageTitle = 'Dashboard';
    include('init.php');

    /**  Start Dashboard page */
    $numUsers = 6; //latest users array
    $LatestUsers = getLatest("*", "users", "userID", $numUsers);
    $numItems = 6; //latest items array
    $LatestItems = getLatest("*", "items", "item_ID", $numItems);

    ?>
    <div class="container home-statw text-center">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="stat st-members">
                    <i class="fa fa-users"></i>
                    <div class="info">
                    Total Members
                    <span><a href="members.php"><?php echo countItems('userID' , 'users')?></a></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-pending">
                    <i class="fa fa-user-plus"></i>
                    <div class="info">
                    Pending Members
                    <span><a href="members.php?do=Manage&page=pending">
                        <?php echo checkItem("regstatus", "users", 0); ?>
                    </a></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-items">
                    <i class="fa fa-tag"></i>
                    <div class="info">
                    Total Items
                    <span><a href="items.php"><?php echo countItemss('item_ID', 'items') ?></a></span>
                    </div>
                    </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-comments">
                    <i class="fa fa-comments"></i>
                    <div class="info">
                    Total Comments
                    <span><a href="comments.php"><?php echo countItemss('c_id', 'comments') ?></a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container latest">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-defualt">
                    <div class="panel-heading">
                         
                        <i class="fa fa-users"></i> Latest <?php echo ($numUsers);?> Registerd users
                        <span class="toggle-info pull-right">
                            <i class="fa fa-plus fa-lg"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                       <ul class="list-unstyled latest-user">
                       <?php
                    foreach( $LatestUsers as $user){
                        echo '<li>'. $user['username'] . '<span class="btn btn-success pull-right">
                        <i class="fa fa-edit"></i><a href="members.php?do=Edit&userid='.  $user['userID'] . '"> Edit</a></span> </li>';
                         }
                        ?>
                       </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-defualt">
                    <div class="panel-heading">
                        <i class="fa fa-tag"></i> latest items
                        <span class="toggle-info pull-right">
                            <i class="fa fa-plus fa-lg"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                    <ul class="list-unstyled latest-user">
                       <?php
                    foreach( $LatestItems as $item){
                        echo '<li>'. $item['name'] . '<span class="btn btn-success pull-right">
                        <i class="fa fa-edit"></i><a href="items.php?do=Edit&itemid='.  $item['item_ID'] . '"> Edit</a></span> </li>';
                         }
                        ?>
                       </ul>                  
                      </div>
                </div>
            </div>
        </div>
    </div>

<?php
    /** END dashboard page */
    include $tpl . 'footer.php'; 
}else {

    header('Location: index.php');
    exit();
}
?>

