<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php getTitle() ?> </title>
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo $css; ?>frontend.css"/>
    <link rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css"/>

</head>
<body>

<!-- Start NAV BAR -->
<div class="upper-bar">
  <div class="container">
    <?php  
        if(isset($_SESSION['user'])){
            echo 'welcome ' .  $sessionUser .' ';
      echo '<a class="btn btn-primary" href="profile.php">Profile </a>';
      echo '<a  class="btn btn-primary" style="margin:2px;" href="newad.php"> New Add </a>';
      echo '<a class="btn btn-danger" href="logout.php"> Logout</a>';
         $userStatus =   checkUserStatus($sessionUser);
          if ( $userStatus == 1 ){
        // echo 'your membership need to activate';
          } 
            
        }else{
            ?>
       <a href="login.php">
        <span  class="pull-right btn btn-primary">Login/Signup</span>
       </a>     
       <?php  };
      ?>
  </div>
</div>
    <div class="upper-bar"> <!--upper--> </div>
<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">HomePage</a>
    </div> 

    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav navbar-right">
<?php
    foreach(getCat() as $cat) {
    echo '<li> <a href="categories.php?pageid=' .  $cat['ID'] .'&pagename=' . str_replace( ' ' , '-' ,$cat['name']) .'">'. $cat['name'] . '</a></li>';
}
?>
 </ul>
    </div>
  </div>
</nav>
    
    
