<?php

session_start();
$pageTitle = 'Create New Add';
include 'init.php';

if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){


        $formErrors = array();

        $title = $_POST['name'];
        $desc = $_POST['description'];
        $price = $_POST['price'];
        $country = $_POST['countries'];
        $status = $_POST['status'];
        $category = $_POST['category'];

            if(strlen($title) < 4 ){
                $formErrors[] = 'Item Title Must Be At least 4 characters';
            }
             if(strlen($desc) < 10 ){
             
                $formErrors[] = 'Item description Must Be At least 10 characters';
            }
             if(($country) < 2){
                $formErrors[] = 'Item country Must Be At least 2 characters';
             }
             if(empty($price)){
                $formErrors[] = 'Item price Must Be not empty';
             }
            if(empty($category)){
                $formErrors[] = 'Item category Must Be not empty';
            }

            if(empty($status)){
                $formErrors[] = 'Item status Must Be not empty';
            }

                   // check if user exist in database 
        if (empty($formErrors)){
            //Insert Info TO Database
            $stmt = $con->prepare("INSERT INTO 
                items(name, description , price, country_made, status ,add_Date  , Cat_ID )
              VALUES(:zname , :zdescription , :zprice ,:zcountry_made, :zstatus , now() , :zcatid )"); 
            $stmt->execute( array(
                    'zname'         => $title,
                    'zdescription'  => $desc,
                    'zprice'        => $price,
                    'zcountry_made' => $country,
                    'zstatus'       => $status,
                    'zcatid'        => $category,

                ));
            // Echo the success messages
                if($stmt) {

                $successFun = 'Item Has Been Add';
                }

        }
    }
?>

<h1 class="text-center">Create New Add</h1>
<div class="create-ad block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel panel-heading"> Create new add </div>
                <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
            
                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

<!-- Start name field -->
<div class="form-group form-group-lg">
    <label class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10 col-md-6">
        <input type="text" name="name" placeholder="name of the item" class="form-control live_name"  />
    </div>
</div>
<!-- End name field -->

   <!-- Start Description field -->
   <div class="form-group form-group-lg">
    <label class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10 col-md-6">
        <input type="text" name="description" placeholder="description of the item" class="form-control live_des"  />
    </div>
</div>
<!-- End Description field -->

  <!-- Start price field -->
  <div class="form-group form-group-lg">
    <label class="col-sm-2 control-label">Price</label>
    <div class="col-sm-10 col-md-6">
        <input type="text" name="price" placeholder="price of the item" class="form-control live_price"  />
    </div>
</div>
<!-- End price field -->



    <!-- Start country_made field -->
    <div class="form-group form-group-lg">
    <label class="col-sm-2 control-label">Country</label>
    <div class="col-sm-10 col-md-6">
        <input type="text" name="countries" placeholder="country of the item" class="form-control live_cout"  />
    </div>
</div>
<!-- End  country_made field -->



    <!-- Start status field -->
    <div class="form-group form-group-lg">
    <label class="col-sm-2 control-label">Status</label>
    <div class="col-sm-10 col-md-6">
        <select class="form-control" name="status">
            <option value="">...</option>
            <option value="2">New</option>
            <option value="3">Like New</option>
            <option value="4">Used</option>
            <option value="5">Very Old</option>
        </select>
    </div>
</div>
<!-- End status field -->

 

   <!-- Start categories field -->
   <div class="form-group form-group-lg">
    <label class="col-sm-2 control-label">Categories</label>
    <div class="col-sm-10 col-md-6">
        <select class="form-control" name="category">
            <option value="0">...</option>
          <?php
                $cats =  getAllFrom('categories','ID');
                foreach($cats as $cat){
                echo "<option value='". $cat['ID'] ."'>" .$cat['name'] . "</option>";
}

          ?>
        </select>
    </div>
</div>
<!-- End Members field -->

   


    <!-- Start submit field -->
    <div class="form-group form-group-lg">
    <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" value="Add Item" class="btn btn-primary btn-sm"/>
    </div>
</div>
<!-- End submit field -->
</form>
  </div>

        <!-- start show ad  -->
        <div class="col-md-4">
        <div class="thumbnail item-box live_preview">
        <span class="price_tag">$</span>
        <img class="img-responsive" src="rab.png" alt=""/>
        <div class="caption">
        <h3 class="text-center">Titel</h3>
        <p class="text-center">paragraph</p>
            </div>
            </div>
        </div>
        </div>


        <!-- Start looping from errors -->

            <?php 
                if (!empty($formErrors)){
                    foreach ($formErrors as $error){
                        echo '<div class="alert alert-danger">' . $error . '</div>';
                    }
                }

                if (isset($successFun)){
        echo '<div class="alert  alert-success">' . $successFun . '</div>';
                }
            ?>

        <!-- end looping from errors -->
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
