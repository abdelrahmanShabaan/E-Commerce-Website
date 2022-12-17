<?php

/*
===================================================
== Categories  Page
== You can here ADD | EDIT | DELETE | MEMBERS FROM HERE
===================================================
*/

ob_start(); // Output Buffering Start
// Start session for user login
session_start();

//make page titile
$pageTitle = 'categories';

if (isset($_SESSION['username'])) {
     
    include('init.php');
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    // start Manage page
    if ($do == 'Manage') {
        $sorting = 'ASC';
        $sort_array = array('ASC', 'DESC');
        if(isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)){
            $sorting = $_GET['sort'];
        }
        $stmt2 = $con->prepare("SELECT * FROM categories ORDER BY ordering $sorting");
        $stmt2->execute();
        $cats = $stmt2->fetchAll();?>

                <h1 class="text-center">Manage Categories
                </h1>
                <div class="container categories">
                    <div class="panel panel-defualt">
                        <div class="panel-heading">
                        <i class="fa fa-edit"></i> Manage Categories
                        <div class="ordering pull-right">
                        <i class="fa fa-sort"></i> Ordering:
                        <a class="<?php if ($sorting == 'ASC') { echo 'active';}?>" href="?sort=ASC">ASC</a>
                        <a  class="<?php if ($sorting == 'DESC') { echo 'active';}?>" href="?sort=DESC">DESC</a>
                    </div>
                        </div>
                        <div class="panel-body">
                            <?php 
                            foreach($cats as $cat){
                                 echo "<div class='cat'>";
                                 echo "<div class='hidden-button'>";
                                echo "<a href='categories.php?do=Edit&catid=". $cat['ID'] ."' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i>Edit</a>";
                                echo "<a href='categories.php?do=Delete&catid=". $cat['ID'] ."' class='confirm btn btn-xs btn-danger'><i class='fa fa-delete'></i>Delete</a>";
                                echo"</div>";
                                 echo "<h3>" .$cat['name'] .  "</h3>" . '<br/>';
                    echo "<div class='full-view'>";
                                 echo "<p>"; if ($cat['description'] == '') {   echo 'This Category is no description'; } else { echo $cat['description'];} echo "</p>";
                                 if($cat['visibility'] == 1 ){echo'<span class="visibilties"><i class="fa fa-eye"></i> Hidden</span>';}
                                 if($cat['allow_comment'] == 1 ){echo'<span class="commentings"><i class="fa fa-close"></i> Comment Disable</span>';}
                                 if($cat['allow_ads'] == 1 ){echo'<span class="advertisning"><i class="fa fa-close"></i> Ads Disable</span>';}
                    echo "</div>";
                                 echo "</div>";
                                echo "<hr>";
                            }
                            ?>
                        </div>
                    <a class="add-category btn btn-primary" href="categories.php?do=Add"><i class="fa fa-plus"></i> Add New Category</a>
                    </div>
                </div>

<?php } elseif ($do == 'Add') { ?>

            <!-- Start Add Page -->
            <h1 class="text-center">Add New Category </h1>
                <div class="container">
            <form class="form-horizontal" action="?do=Insert" method="POST">
                <!-- Start name field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="name" placeholder="name of the category" class="form-control"  autocomplete="off" required="required"/>
                    </div>
                </div>
                <!-- End name field -->

                    <!-- Start description field -->
                    <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="description" class="form-control"  placeholder="description of category"  autocomplete="new-password" />
                    </div>
                </div>
                <!-- End description field -->

                    <!-- Start Ordering field -->
                    <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Ordering</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="ordering" placeholder="Number to arrange the category"  class="form-control" />
                    </div>
                </div>
                <!-- End Ordering field -->

                        <!-- Start Visibilty field -->
                        <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">visibility</label>
                    <div class="col-sm-10 col-md-6">
                        <div>
                           <input id="vis-yes" type="radio"  name="visibility" value="0" checked/>
                           <label for="vis-yes">Yes</label>
                        </div>
                        <div>
                           <input id="vis-no" type="radio"  name="visibility" value="1" />
                           <label for="vis-no">No</label>
                        </div>
                    </div>
                </div>
                <!-- End Visibilty field -->

                   <!-- Start Allow-comment field -->
                   <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Allow comment</label>
                    <div class="col-sm-10 col-md-6">
                        <div>
                           <input id="com-yes" type="radio"  name="commenting" value="0" checked/>
                           <label for="com-yes">Yes</label>
                        </div>
                        <div>
                           <input id="com-no" type="radio"  name="commenting" value="1" />
                           <label for="com-no">No</label>
                        </div>
                    </div>
                </div>
                <!-- End Allow-comment field -->

                <!-- Start Allow-ADS field -->
                      <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Allow Ads</label>
                    <div class="col-sm-10 col-md-6">
                        <div>
                           <input id="adv-yes" type="radio"  name="advertising" value="0" checked/>
                           <label for="adv-yes">Yes</label>
                        </div>
                        <div>
                           <input id="adv-no" type="radio"  name="advertising" value="1" />
                           <label for="adv-no">No</label>
                        </div>
                    </div>
                </div>
                <!-- End Allow-ADS field -->

                    <!-- Start submit field -->
                    <div class="form-group form-group-lg">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Add Category" class="btn btn-primary btn-lg"/>
                    </div>
                </div>
                <!-- End submit field -->
            </form>
        </div>

    <?php } elseif ($do == 'Insert') {


 //Insert categories page
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    echo "<h1 class='text-center'>Insert Category </h1>";
    echo "<div class='container'>";
     
    //get variables from form ::
    $name        = $_POST['name'];
    $desc        = $_POST['description']; 
    $order       = $_POST['ordering'];
    $visible     = $_POST['visibility'];
    $comment     = $_POST['commenting'];
    $ads         = $_POST['advertising'];


        // check if Categories exist in database 
        $check = checkItem("name", " categories", $name);
        if ($check == 1) {
            echo "<div class='alert alert-danger'>" . "sorry this category  is exist ";
        } else {
            //Insert category TO Database
            $stmt = $con->prepare("INSERT INTO 
        categories(name , description , ordering , visibility , allow_comment ,allow_ads)
        VALUES(:zname , :zdesc , :zorder , :zvisibile, :zcomment,:zads )");

                $stmt->execute(array(
                        'zname' => $name,
                        'zdesc' => $desc,
                        'zorder' => $order,
                        'zvisibile' => $visible,
                        'zcomment' => $comment,
                        'zads' => $ads
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

        //Check if get request category_ID is numeric and get the integer calue if it
        $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
        //  check if th user is exist from userID
        $stmt = $con->prepare("SELECT *  FROM categories WHERE ID = ?");
        //execute the quiers
        $stmt->execute(array($catid));
        // fetch the Date
        $cat = $stmt->fetch();
        // the row count 
        $count = $stmt->rowCount();
        // if there is id show form
    if ($count > 0) { ?>
            <!-- Start Add Page -->
            <h1 class="text-center">Edit Category </h1>
                <div class="container">
            <form class="form-horizontal" action="?do=update" method="POST">
            <input type="hidden" name="catid" value="<?php echo $catid ?>"/>

                <!-- Start name field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="name" placeholder="name of the category" class="form-control"  required="required" value="<?php echo $cat['name']?>"/>
                    </div>
                </div>
                <!-- End name field -->

                    <!-- Start description field -->
                    <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="description" class="form-control"  placeholder="description of category" value="<?php echo $cat['description']?>" />
                    </div>
                </div>
                <!-- End description field -->

                    <!-- Start Ordering field -->
                    <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Ordering</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="ordering" placeholder="Number to arrange the category" value="<?php echo $cat['ordering']?>"  class="form-control" />
                    </div>
                </div>
                <!-- End Ordering field -->

                        <!-- Start Visibilty field -->
                        <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">visibility</label>
                    <div class="col-sm-10 col-md-6">
                        <div>
                           <input id="vis-yes" type="radio"  name="visibility" value="0"<?php if ($cat['visibility'] == 0) {echo 'checked';}?> />
                           <label for="vis-yes">Yes</label>
                        </div>
                        <div>
                           <input id="vis-no" type="radio"  name="visibility" value="1" <?php if ($cat['visibility'] == 1) {echo 'checked';}?>/>
                           <label for="vis-no">No</label>
                        </div>
                    </div>
                </div>
                <!-- End Visibilty field -->

                   <!-- Start Allow-comment field -->
                   <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Allow comment</label>
                    <div class="col-sm-10 col-md-6">
                        <div>
                           <input id="com-yes" type="radio"  name="commenting" value="0" <?php if ($cat['allow_comment'] == 0) {echo 'checked';}?> />
                           <label for="com-yes">Yes</label>
                        </div>
                        <div>
                           <input id="com-no" type="radio"  name="commenting" value="1"<?php if ($cat['allow_comment'] == 1) {echo 'checked';}?> />
                           <label for="com-no">No</label>
                        </div>
                    </div>
                </div>
                <!-- End Allow-comment field -->

                <!-- Start Allow-ADS field -->
                      <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Allow Ads</label>
                    <div class="col-sm-10 col-md-6">
                        <div>
                           <input id="adv-yes" type="radio"  name="advertising" value="0" <?php if ($cat['allow_ads'] == 0) {echo 'checked';}?>/>
                           <label for="adv-yes">Yes</label>
                        </div>
                        <div>
                           <input id="adv-no" type="radio"  name="advertising" value="1" <?php if ($cat['allow_ads'] == 1) {echo 'checked';}?> />
                           <label for="adv-no">No</label>
                        </div>
                    </div>
                </div>
                <!-- End Allow-ADS field -->

                    <!-- Start submit field -->
                    <div class="form-group form-group-lg">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Save" class="btn btn-primary btn-lg"/>
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
           ?>
   

 <?php   } elseif ($do == 'update') {

        echo "<h1 class='text-center'>Update Categories </h1>";
        echo "<div class='container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            //get variables from form ::
            $id          = $_POST['catid'];
            $name        = $_POST['name'];
            $desc        = $_POST['description'];
            $order       = $_POST['ordering'];
            $visible     = $_POST['visibility'];
            $comment     = $_POST['commenting'];
            $ads         = $_POST['advertising'];

           
            //check if there is no error proced the update operations
                //update the database with this info
                $stmt = $con->prepare("UPDATE categories
                 SET name = ? ,description = ? , 
                 ordering =? , visibility=?, 
                 allow_comment=?, allow_ads=? 
                 WHERE ID = ? ");
                $stmt->execute(array($name, $desc, $order,  $visible , $comment , $ads ,$id ));

                // Echo the success messages
                echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated </div>';

        }else {
            echo "You cant browse this page directly";
        }
        echo "</div>";


        ?>

   <?php } elseif ($do == 'Delete') {

                echo "<h1 class='text-center'>Delete categories</h1>";
                echo "<div class='container'>";
                // Delete Member page  
                //Check if get request userid is numeric and get the integer calue if it
                $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
                //  check if th user is exist from userID
                $stmt = $con->prepare("SELECT *  FROM categories WHERE ID= ? LIMIT 1 ");
                //execute the quiers
                $stmt->execute(array($catid));
                // the row count 
                $count = $stmt->rowCount();
                // if there is id show form
                if ($stmt->rowCount() > 0) {

                    $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zuser");
                    //bind mean rabt
                    $stmt->bindParam(":zuser", $catid);
                    //execute stmt
                    $stmt->execute();
                    echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' category Deleted </div>';

                }else{
                    echo "problem with deleting";
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