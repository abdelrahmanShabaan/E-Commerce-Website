<?php

/*
===================================================
== Mange Comments Page
== You can  ADD | EDIT | DELETE | Approve FROM HERE
===================================================
*/

// Start session for user login
session_start();

//make page titile
$pageTitle = 'comments';

if(isset($_SESSION['username'])){
    include('init.php');
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;

    // start Manage page
  if ($do == 'Manage'){    //mange Members page

    // select all user except admin
    $stmt = $con->prepare("SELECT
    comments.* , items.name AS Item_Name , 
    users.username AS Member 
     FROM comments 
      INNER JOIN items
      ON
      items.item_ID = comments.item_id
      INNER JOIN 
      users 
      ON users.userID = comments.user_id");
    // execute the statments
        $stmt->execute();
        // Asign to variables
        $rows = $stmt->fetchAll();
  ?>
   <h1 class="text-center">Mange Comments page </h1>
        <div class="container">
            <div class="table-responsive">
                <table class="main-table text-center table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>comments</td>
                    <td>Item Name</td>
                    <td>User Name</td>
                    <td>Added Date</td>
                    <td>control</td>
                </tr>
                <?php 
                    foreach($rows as $row){
                    echo "<tr>";
                    echo "<td>" . $row['c_id'] . "</td>";
                    echo "<td>" . $row['comment'] . "</td>";
                    echo "<td>" . $row['Item_Name'] . "</td>";
                    echo "<td>" . $row['Member'] . "</td>";
                    echo "<td>" . $row['comment_date'] . "</td>";
                    echo "<td>
                        <a href='comments.php?do=Edit&comid=".$row['c_id']."' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
                        <a href='comments.php?do=Delete&comid=".$row['c_id']."' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>";
                        if ($row['status']==0){
                echo   "<a href='comments.php?do=Approve&comid=".$row['c_id']."' class='btn btn-primary activite'><i class='fa fa-close'></i> Approve</a>";

                        }
                       echo  "</td>";
                    echo "</tr>";
                    }
                ?>
                </table>
            </div>
  </div>
    
   <?php }elseif ($do == 'Edit'){ //start edit page 

                //Check if get request userid is numeric and get the integer calue if it
            $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
             //  check if th user is exist from userID
          $stmt = $con->prepare("SELECT *  FROM comments WHERE c_id= ? ");
            //execute the quiers
            $stmt->execute(array($comid));
            // fetch the Date
            $row = $stmt->fetch();
            // the row count 
            $count = $stmt->rowCount();
            // if there is id show form
        if ($stmt->rowCount() > 0) { ?>

                    <h1 class="text-center">Edit comment </h1>

                        <div class="container">
                            <form class="form-horizontal" action="?do=update" method="POST">
                                <input type="hidden" name="comid" value="<?php echo $comid ?>"/>
                                <!-- Start comment field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label">comment</label>
                                    <div class="col-sm-10 col-md-6">
                                        <textarea name="comment" class="form-control" ><?php echo $row['comment']?></textarea>
                                    </div>
                                </div>
                                <!-- End comment field -->

                                    <!-- Start submit field -->
                                    <div class="form-group form-group-lg">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" value="save edit" class="btn btn-primary btn-sm"/>
                                    </div>
                                </div>
                                <!-- End submit field -->
                            </form>
                        </div>


 <?php
        // if there is no such id show error message
        }else {
            echo 'There is no such iD';
        }
}else if($do == 'update'){ //update page

        echo "<h1 class='text-center'>Update Members </h1>";
        echo "<div class='container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            //get variables from form ::
            $comid       = $_POST['comid'];
            $com = $_POST['comment'];
        
        
            //check if there is no error proced the update operations
                //update the database with this info
                $stmt = $con->prepare("UPDATE comments SET comment = ? WHERE c_id = ? ");
                $stmt->execute(array($com ,$comid ));

                // Echo the success messages
                echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' comment Updated </div>';

        }else {
            echo "You cant browse this page directly";
        }
        echo "</div>";
}elseif($do == 'Delete'){

        echo "<h1 class='text-center'>Delete Comments</h1>";
        echo "<div class='container'>";
        // Delete Member page  
        //Check if get request comid is numeric and get the integer calue if it
      $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
         //  check if th user is exist from comid
         $stmt = $con->prepare("SELECT *  FROM comments WHERE c_id= ? ");
        //execute the quiers
        $stmt->execute(array($comid));
         // the row count 
          $count = $stmt->rowCount();
         // if there is id show form
        if ($stmt->rowCount() > 0) {

            $stmt = $con->prepare("DELETE FROM comments WHERE c_id = :zuser");
            //bind mean rabt
            $stmt->bindParam(":zuser", $comid);
            //execute stmt
            $stmt->execute();
            echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' comment Deleted </div>';

        }else{
            echo "Good this id is exist";
        }

        echo '</div>';
}elseif($do == 'Approve'){


    echo "<h1 class='text-center'> Activite Member</h1>";
    echo "<div class='container'>";
    // Activate Member page  

    //Check if get request userid is numeric and get the integer calue if it
     $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
     //  check if th user is exist from userID
     $stmt = $con->prepare("SELECT *  FROM comments WHERE c_id= ? ");
    //execute the quiers
    $stmt->execute(array($comid));
     // the row count 
      $count = $stmt->rowCount();
     // if there is id show form
    if ($stmt->rowCount() > 0) {

        $stmt = $con->prepare("UPDATE comments SET status = 1 WHERE c_id = ?");
        //execute stmt
        $stmt->execute(array($comid));
        echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' comment Approved </div>';

    }else{
        echo "Good this id is exist";
    }

    echo '</div>';


}

    include $tpl . 'footer.php'; 
}else {

    header('Location: index.php');
    exit();
}