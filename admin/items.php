<?php

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
       
        // select all user except admin
        $stmt = $con->prepare("SELECT * FROM items");
        // execute the statments
            $stmt->execute();
            // Asign to variables
            $items = $stmt->fetchAll();
      ?>
       <h1 class="text-center">Mange item page </h1>
            <div class="container">
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                    <tr>
                        <td>#ID</td>
                        <td>name</td>
                        <td>Description</td>
                        <td>Price</td>
                        <td>Adding Date</td>
                        <td>category</td>
                        <td>Member_ID</td>
                        <td>control</td>
                    </tr>
                    <?php 
                        foreach($items as $item){
                        echo "<tr>";
                        echo "<td>" . $item['item_ID'] . "</td>";
                        echo "<td>" . $item['name'] . "</td>";
                        echo "<td>" . $item['description'] . "</td>";
                        echo "<td>" . $item['price'] . "</td>";
                        echo "<td>" . $item['add_Date'] . "</td>";
                        echo "<td>" . $item['Cat_ID'] . "</td>";
                        echo "<td>" . $item['Member_ID'] . "</td>";
                        echo "<td>
                            <a href='items.php?do=Edit&itemid=".$item['item_ID']."' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
                            <a href='items.php?do=Delete&itemid=".$item['item_ID']."' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>";
                            if ($item['Approve']==0){
                                echo   "<a href='items.php?do=Approve&itemid=".$item['item_ID']."' 
                                class='btn btn-primary activite'><i class='fa fa-check'>
                                </i> Approve</a>";
                                        }
                            echo  "</td>";
                        echo "</tr>";
                        }
                    ?>
                    </table>
                </div>
            <a href="items.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New Item </a>
      </div>    

<?php    } elseif ($do == 'Add') { ?>

        <!-- Start Add Page -->
        <h1 class="text-center">Add New Items </h1>
            <div class="container">
        <form class="form-horizontal" action="?do=Insert" method="POST">

            <!-- Start name field -->
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" name="name" placeholder="name of the item" class="form-control"  required="required"/>
                </div>
            </div>
            <!-- End name field -->

               <!-- Start Description field -->
               <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" name="description" placeholder="description of the item" class="form-control"  required="required"/>
                </div>
            </div>
            <!-- End Description field -->

              <!-- Start price field -->
              <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" name="price" placeholder="price of the item" class="form-control"  required="required"/>
                </div>
            </div>
            <!-- End price field -->

            
            
                <!-- Start country_made field -->
                <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Country</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" name="countries" placeholder="country of the item" class="form-control"  required="required"/>
                </div>
            </div>
            <!-- End  country_made field -->


            
                <!-- Start status field -->
                <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10 col-md-6">
                    <select class="form-control" name="status">
                        <option value="1">...</option>
                        <option value="2">New</option>
                        <option value="3">Like New</option>
                        <option value="4">Used</option>
                        <option value="5">Very Old</option>
                    </select>
                </div>
            </div>
            <!-- End status field -->

               <!-- Start Members field -->
               <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Member</label>
                <div class="col-sm-10 col-md-6">
                    <select class="form-control" name="member">
                        <option value="0">...</option>
                      <?php
        $stmt = $con->prepare("SELECT * FROM users");
        $stmt->execute();
        $users = $stmt->fetchAll();
        foreach($users as $user){
            echo "<option value='". $user['userID'] ."'>" .$user['username'] . "</option>";
        }

                      ?>
                    </select>
                </div>
            </div>
            <!-- End Members field -->

               <!-- Start categories field -->
               <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Categories</label>
                <div class="col-sm-10 col-md-6">
                    <select class="form-control" name="category">
                        <option value="0">...</option>
                      <?php
        $stmt2 = $con->prepare("SELECT * FROM categories");
        $stmt2->execute();
        $cats = $stmt2->fetchAll();
        foreach($cats as $cat){
            echo "<option value='". $cat['ID'] ."'>" .$cat['name'] . "</option>";
        }

                      ?>
                    </select>
                </div>
            </div>
            <!-- End Members field -->

                    <!-- Start Rating field -->
                    <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Rating</label>
                <div class="col-sm-10 col-md-6">
                    <select class="form-control" name="rating">
                        <option value="1">...</option>
                        <option value="2">1</option>
                        <option value="3">2</option>
                        <option value="4">3</option>
                        <option value="5">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <!-- End Rating field -->


                <!-- Start submit field -->
                <div class="form-group form-group-lg">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Add Item" class="btn btn-primary btn-sm"/>
                </div>
            </div>
            <!-- End submit field -->
        </form>
    </div>


  <?php  } elseif ($do == 'Insert') {


   //Insert items page
 
   if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    echo "<h1 class='text-center'>Insert Item </h1>";
    echo "<div class='container'>";
     
    //get variables from form ::
    $name       = $_POST['name'];
    $desc       = $_POST['description'];
    $prices     = $_POST['price'];
    $country    = $_POST['countries'];
    $statues    = $_POST['status'];
    $rate       = $_POST['rating'];
    $cat        = $_POST['category'];
    $memb        = $_POST['member'];

        // check if user exist in database 
        $check = checkItem("name", "items", $name);
        if ($check == 1) {
            echo "<div class='alert alert-danger'>" . "sorry this user is exist ";
        } else {
            //Insert Info TO Database
            $stmt = $con->prepare("INSERT INTO 
        items(name, description , price, country_made, status ,add_Date ,rating , Cat_ID, Member_ID )
        VALUES(:zname , :zdescription , :zprice ,:zcountry_made, :zstatus , now() , :zrating, :zcatid , :zmembers )"); 
            $stmt->execute( array(
                    'zname'         => $name,
                    'zdescription'  => $desc,
                    'zprice'        => $prices,
                    'zcountry_made' => $country,
                    'zstatus'       => $statues,
                    'zrating'       => $rate,
                    'zcatid'        => $cat,
                    'zmembers'      => $memb
                ));
            // Echo the success messages
            echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted </div>';

        }

}else {
 $errorMsg = "You cann't browse this page directly";
    redirectHome($errorMsg);
}
echo "</div>";

// end Insert page

    } elseif ($do == 'Edit') {

            //Check if get request itemID is numeric and get the integer calue if it
            $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
             //  check if th user is exist from userID
              $stmt = $con->prepare("SELECT *  FROM items WHERE item_ID= ? ");
            //execute the quiers
            $stmt->execute(array($itemid));
            // fetch the Date
            $item = $stmt->fetch();
            // the row count 
            $count = $stmt->rowCount();
            // if there is id show form
        if ($stmt->rowCount() > 0) { ?>

     <!-- Start Add Page -->
     <h1 class="text-center">Edit Items </h1>
            <div class="container">
        <form class="form-horizontal" action="?do=update" method="POST">
        <input type="hidden" name="itemid" value="<?php echo $itemid ?>"/>


            <!-- Start name field -->
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" name="name" 
                    placeholder="name of the item"
                     class="form-control" 
                     required="required"
                     value="<?php echo $item['name']; ?>"/>
                </div>
            </div>
            <!-- End name field -->

               <!-- Start Description field -->
               <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" name="description" placeholder="description of the item" class="form-control"  required="required"
                    value="<?php echo $item['description']; ?>"/>
                </div>
            </div>
            <!-- End Description field -->

              <!-- Start price field -->
              <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" name="price" placeholder="price of the item" class="form-control"  required="required"
                    value="<?php echo $item['price']; ?>"/>
                </div>
            </div>
            <!-- End price field -->

            
            
                <!-- Start country_made field -->
                <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Country</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" name="countries" placeholder="country of the item" class="form-control"  required="required"
                    value="<?php echo $item['country_made']; ?>"/>
                </div>
            </div>
            <!-- End  country_made field -->


            
                <!-- Start status field -->
                <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10 col-md-6">
                    <select class="form-control" name="status">
                        <option value="0">...</option>
                        <option value="1" <?php if ($item['status'] == 1){echo 'selected';}?>>New</option>
                        <option value="2" <?php if ($item['status'] == 2){echo 'selected';}?>>Like New</option>
                        <option value="3" <?php if ($item['status'] == 3){echo 'selected';}?>>Used</option>
                        <option value="4" <?php if ($item['status'] == 4){echo 'selected';}?>>Very Old</option>
                    </select>
                </div>
            </div>
            <!-- End status field -->

               <!-- Start Members field -->
               <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">member</label>
                <div class="col-sm-10 col-md-6">
                    <select class="form-control" name="member" >
                        <option value="1"><?php echo $item['Cat_ID']; ?></option>
                      <?php
        $stmt = $con->prepare("SELECT * FROM users");
        $stmt->execute();
        $users = $stmt->fetchAll();
        foreach($users as $user){
            echo "<option value='". $user['userID'] ."'>" .$user['username'] . "</option>";
        }

                      ?>
                    </select>
                </div>
            </div>
            <!-- End Members field -->

               <!-- Start categories field -->
               <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Categories</label>
                <div class="col-sm-10 col-md-6">
                    <select class="form-control" name="category">
                        <option value="1"><?php echo $item['Member_ID']; ?></option>
                      <?php
        $stmt = $con->prepare("SELECT * FROM categories");
        $stmt->execute();
        $users = $stmt->fetchAll();
        foreach($users as $user){
            echo "<option value='". $user['ID'] ."'>" .$user['name'] . "</option>";
        }

                      ?>
                    </select>
                </div>
            </div>
            <!-- End Members field -->

                    <!-- Start Rating field -->
                    <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Rating</label>
                <div class="col-sm-10 col-md-6">
                    <select class="form-control" name="rating">
                        <option value="1"><?php echo $item['rating']; ?></option>
                        <option value="2">1</option>
                        <option value="3">2</option>
                        <option value="4">3</option>
                        <option value="5">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <!-- End Rating field -->


                <!-- Start submit field -->
                <div class="form-group form-group-lg">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Add Item" class="btn btn-primary btn-sm"/>
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

    } elseif ($do == 'update') {

        echo "<h1 class='text-center'> Update Item </h1>";
        echo "<div class='container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            //get variables from form ::
                $id         = $_POST['itemid'];
                $name       = $_POST['name'];
                $desc       = $_POST['description'];
                $prices     = $_POST['price'];
                $country    = $_POST['countries'];
                $statues    = $_POST['status'];
                $rate       = $_POST['rating'];
                $member     = $_POST['member'];
                $cat        = $_POST['category'];            

                //update the database with this info
                $stmt = $con->prepare("UPDATE items SET name = ?, description = ?, price= ? , country_made = ?, status= ? , rating= ? , Member_ID = ? , Cat_ID = ? WHERE item_ID = ? ");
                $stmt->execute(array($name, $desc, $prices,  $country ,$statues , $rate , $member , $cat, $id ));

                // Echo the success messages
                echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' item Updated </div>';
            
        }else {
            echo "You cant browse this page directly";
        }
        echo "</div>";

        
    } elseif ($do == 'Delete') {

        echo "<h1 class='text-center'>Delete Item</h1>";
        echo "<div class='container'>";
        // Delete Member page  
        //Check if get request userid is numeric and get the integer calue if it
      $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
         //  check if th user is exist from userID
         $stmt = $con->prepare("SELECT *  FROM items WHERE item_ID= ? LIMIT 1 ");
        //execute the quiers
        $stmt->execute(array($itemid));
         // the row count 
          $count = $stmt->rowCount();
         // if there is id show form
        if ($stmt->rowCount() > 0) {

            $stmt = $con->prepare("DELETE FROM items WHERE item_ID = :zuser");
            //bind mean rabt
            $stmt->bindParam(":zuser", $itemid);
            //execute stmt
            $stmt->execute();
            echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Item Deleted </div>';

        }else{
            echo "Good this id is exist";
        }

        echo '</div>';

    } elseif ($do == 'Approve') {

        echo "<h1 class='text-center'>Approve Item</h1>";
    echo "<div class='container'>";
    // Activate Member page  
    //Check if get request userid is numeric and get the integer calue if it
  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
     //  check if th user is exist from userID
     $stmt = $con->prepare("SELECT *  FROM items WHERE item_ID= ? LIMIT 1 ");
    //execute the quiers
    $stmt->execute(array($itemid));
     // the row count 
      $count = $stmt->rowCount();
     // if there is id show form
    if ($stmt->rowCount() > 0) {

        $stmt = $con->prepare("UPDATE items SET Approve = 1 WHERE item_ID = ?");
        //execute stmt
        $stmt->execute(array($itemid));
        echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Approve  Activited </div>';

    }else{
        echo "Good this id is exist";
    }

    echo '</div>';


    }

    include $tpl . 'footer.php';

}else {

    header('Location :index.php');
    exit();
}
ob_end_flush(); //Relase the output

?>