<?php

/*
===================================================
== Mange memebers Page
== You can here ADD | EDIT | DELETE | MEMBERS FROM HERE
===================================================
*/

// Start session for user login
session_start();

//make page titile
$pageTitle = 'Members';

if(isset($_SESSION['username'])){
    include('init.php');
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;

    // start Manage page
  if ($do == 'Manage'){    //mange Members page
    $query = '';
    if(isset($_GET['page']) && ['page' == 'pending']){
            $query = 'AND regstatus = 0';
    } 
    // select all user except admin
    $stmt = $con->prepare("SELECT * FROM users WHERE groupID != 1  $query");
    // execute the statments
        $stmt->execute();
        // Asign to variables
        $rows = $stmt->fetchAll();
  ?>
   <h1 class="text-center">Mange Member page </h1>
        <div class="container">
            <div class="table-responsive">
                <table class="main-table text-center table table-bordered">
                <tr>
                    <td>#ID</td>
                    <td>username</td>
                    <td>email</td>
                    <td>fullname</td>
                    <td>registred Date</td>
                    <td>control</td>
                </tr>
                <?php 
                    foreach($rows as $row){
                    echo "<tr>";
                    echo "<td>" . $row['userID'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['fullname'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>
                        <a href='members.php?do=Edit&userid=".$row['userID']."' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
                        <a href='members.php?do=Delete&userid=".$row['userID']."' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>";
                        if ($row['regstatus']==0){
                echo   "<a href='members.php?do=Activate&userid=".$row['userID']."' class='btn btn-primary activite'><i class='fa fa-close'></i> Activite</a>";

                        }
                       echo  "</td>";
                    echo "</tr>";
                    }
                ?>
                </table>
            </div>
        <a href="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Members </a>
  </div>


 <?php }elseif ($do == 'Add'){ ?>
        <!-- Add memebers page -->

                <h1 class="text-center">Add New Members </h1>
                <div class="container">
            <form class="form-horizontal" action="?do=Insert" method="POST">
                <!-- Start username field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">username</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="username" placeholder="username to login into shop" class="form-control"  autocomplete="off" required="required"/>
                    </div>
                </div>
                <!-- End username field -->

                    <!-- Start password field -->
                    <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="password" name="password" class="password form-control"  placeholder="password must be hard and complex"   required="required" autocomplete="new-password" />
                        <i class="show-pass fa fa-eye fa-2x"></i>
                    </div>
                </div>
                <!-- End password field -->

                    <!-- Start Email field -->
                    <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="email" name="email" placeholder="email must be vaild"  class="form-control" required="required"/>
                    </div>
                </div>
                <!-- End Email field -->

                        <!-- Start Fullname field -->
                        <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Fullname</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="full" placeholder="Fullname Appear in your page"  class="form-control" required="required"/>
                    </div>
                </div>
                <!-- End Fullname field -->

                    <!-- Start submit field -->
                    <div class="form-group form-group-lg">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Add Member" class="btn btn-primary btn-lg"/>
                    </div>
                </div>
                <!-- End submit field -->
            </form>
        </div>
 <?php 
  }elseif ($do == 'Insert'){

        //Insert Member page
 
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            echo "<h1 class='text-center'>Update Members </h1>";
            echo "<div class='container'>";
             
            //get variables from form ::
            $username = $_POST['username'];
            $pass     = $_POST['password'];
            $email    = $_POST['email'];
            $name     = $_POST['full'];

            $hashPass = sha1($_POST['password']);
          
            // make empty arrrays 
            $formErrors = array();


            if (strlen($username) < 4 ){
                $formErrors[] = 'username must be bigger than 4 characters </div>';
            }

            if (strlen($username) > 20 ){
                $formErrors[] = 'username must be less than 20 characters </div>';
            }
            //validate the from 
            if (empty($username)){
                $formErrors[]= ' username cant be <strong>Empty</strong> </div>';   
            } 

            if (empty($pass)){
                $formErrors[]= ' password cant be <strong>Empty</strong> </div>';   
            } 

            if (empty($email)){
                $formErrors[] = '  email cant be <strong>Empty</strong> </div>';   
            } 
        
            if (empty($name)){
                $formErrors[] = 'fullname cant be <strong>Empty</strong>  </div>';   
            } 

            foreach($formErrors as $error){
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }

            //check if there is no error proced the update operations
            if (empty($formErrors)) {

                // check if user exist in database 
                $check = checkItem("username", "users", $username);
                if ($check == 1) {
                    echo "<div class='alert alert-danger'>" . "sorry this user is exist ";
                } else {
                    //Insert Info TO Database
                    $stmt = $con->prepare("INSERT INTO 
                users(username , password , email , fullname , regstatus ,date)
                VALUES(:zuser , :zpassword , :zemail , :zname, 1, now())"); 

                    $stmt->execute(
                        array(
                            'zuser' => $username,
                            'zpassword' => $hashPass,
                            'zemail' => $email,
                            'zname' => $name
                        )
                    );
                    // Echo the success messages
                    echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted </div>';

                }
            }

        }else {
         $errorMsg = "You cann't browse this page directly";
            redirectHome($errorMsg);
        }
        echo "</div>";

        // end Insert page
    
    }elseif ($do == 'Edit'){ //start edit page 

                //Check if get request userid is numeric and get the integer calue if it
            $uerid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
             //  check if th user is exist from userID
          $stmt = $con->prepare("SELECT *  FROM users WHERE userID= ? LIMIT 1 ");
            //execute the quiers
            $stmt->execute(array($uerid));
            // fetch the Date
            $row = $stmt->fetch();
            // the row count 
            $count = $stmt->rowCount();
            // if there is id show form
        if ($stmt->rowCount() > 0) { ?>

                    <h1 class="text-center">Edit Members </h1>

                        <div class="container">
                            <form class="form-horizontal" action="?do=update" method="POST">
                                <input type="hidden" name="userid" value="<?php echo $uerid ?>"/>
                                <!-- Start username field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label">username</label>
                                    <div class="col-sm-10 col-md-6">
                                        <input type="text" name="username" placehodler="username" class="form-control" value="<?php echo $row['username']?>" autocomplete="off" required="required"/>
                                    </div>
                                </div>
                                <!-- End username field -->

                                    <!-- Start password field -->
                                    <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10 col-md-6">
                                    <input type="hidden" name="oldpassword" placeholder="password" value="<?php echo $row['password']?>"/>
                                        <input type="password" name="newpassword" placeholder="password" class="form-control" autocomplete="new-password" />
                                    </div>
                                </div>
                                <!-- End password field -->

                                    <!-- Start Email field -->
                                    <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10 col-md-6">
                                        <input type="email" name="email" placeholder="email" value="<?php echo $row['email']?>" class="form-control" required="required"/>
                                    </div>
                                </div>
                                <!-- End Email field -->

                                        <!-- Start Fullname field -->
                                        <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label">Fullname</label>
                                    <div class="col-sm-10 col-md-6">
                                        <input type="text" name="full" placeholder="Fullname"  value="<?php echo $row['fullname']?>" class="form-control" required="required"/>
                                    </div>
                                </div>
                                <!-- End Fullname field -->

                                    <!-- Start submit field -->
                                    <div class="form-group form-group-lg">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" value="save" class="btn btn-primary btn-lg"/>
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
            $id       = $_POST['userid'];
            $username = $_POST['username'];
            $email    = $_POST['email'];
            $name     = $_POST['full'];

            // password trick
            $pass = empty($_POST['newpassword']) ?   $pass = $_POST['oldpassword'] :  $pass =sha1( $_POST['newpassword']);

            // make empty arrrays 
            $formErrors = array();


            if (strlen($username) < 4 ){
                $formErrors[] = 'username must be bigger than 4 characters </div>';
            }

            if (strlen($username) > 20 ){
                $formErrors[] = 'username must be less than 20 characters </div>';
            }
            //validate the from 
            if (empty($username)){
                $formErrors[]= ' username cant be <strong>Empty</strong> </div>';   
            } 

            if (empty($email)){
                $formErrors[] = '  email cant be <strong>Empty</strong> </div>';   
            } 
        
            if (empty($name)){
                $formErrors[] = 'fullname cant be <strong>Empty</strong>  </div>';   
            } 

            foreach($formErrors as $error){
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }

            //check if there is no error proced the update operations
            if (empty($formErrors)){
                //update the database with this info
                $stmt = $con->prepare("UPDATE users SET username = ? ,email = ? , fullname =? , password = ? WHERE userID = ? ");
                $stmt->execute(array($username, $email, $name,  $pass ,$id ));

                // Echo the success messages
                echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated </div>';
            }

        }else {
            echo "You cant browse this page directly";
        }
        echo "</div>";
}elseif($do == 'Delete'){
      
        echo "<h1 class='text-center'>Delete Member</h1>";
        echo "<div class='container'>";
        // Delete Member page  
        //Check if get request userid is numeric and get the integer calue if it
      $uerid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
         //  check if th user is exist from userID
         $stmt = $con->prepare("SELECT *  FROM users WHERE userID= ? LIMIT 1 ");
        //execute the quiers
        $stmt->execute(array($uerid));
         // the row count 
          $count = $stmt->rowCount();
         // if there is id show form
        if ($stmt->rowCount() > 0) {

            $stmt = $con->prepare("DELETE FROM users WHERE userID = :zuser");
            //bind mean rabt
            $stmt->bindParam(":zuser", $uerid);
            //execute stmt
            $stmt->execute();
            echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted </div>';

        }else{
            echo "Good this id is exist";
        }

        echo '</div>';
}elseif($do == 'Activate'){


    echo "<h1 class='text-center'>Activite Member</h1>";
    echo "<div class='container'>";
    // Activate Member page  
    //Check if get request userid is numeric and get the integer calue if it
  $uerid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
     //  check if th user is exist from userID
     $stmt = $con->prepare("SELECT *  FROM users WHERE userID= ? LIMIT 1 ");
    //execute the quiers
    $stmt->execute(array($uerid));
     // the row count 
      $count = $stmt->rowCount();
     // if there is id show form
    if ($stmt->rowCount() > 0) {

        $stmt = $con->prepare("UPDATE users SET regstatus = 1 WHERE userID = ?");
        //execute stmt
        $stmt->execute(array($uerid));
        echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Activited </div>';

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