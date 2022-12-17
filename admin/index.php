<?php
session_start();
$noNavbar = '';
$pageTitle = 'Login';
if(isset($_SESSION['username'])){
    header('Location: dashboard.php'); // Redirect to dashboard
}
// HERE WE WILL MAKE CONNECT FOR INIT PAGE TO BE HERE TOO
include 'init.php';


//check if user comming from http post request
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $username = $_POST['user'];
    $password = $_POST['pass'];
    $hashedPass = sha1($password);

    //  check if th user is exist 
    $stmt = $con->prepare("SELECT userID , username , password
     FROM users
     WHERE username= ?
      AND password= ? 
       LIMIT 1");
    $stmt->execute(array($username, $hashedPass));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    //IF Count > 0 This The Database Contain Information About this username  
    if($count > 0 ){
        $_SESSION['username'] = $username; // Regestration login users
        $_SESSION['ID'] = $row['userID']; // Regestration session ID
        header('Location: dashboard.php'); // Redirect to dashboard
        exit();
    }
}
?>

<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <h4 class="text-center">Admin Login</h3>
    <input class="form-control input-lg"  type="text" name="user" placeholder="Username" autocomplete="off"/>
    <input class="form-control input-lg" type="password" name="pass" placeholder="password" autocomplete="new-password"/>
    <input class="btn btn-primary btn-block input-lg" type="submit"  value="Login">
    
</form>

<!-- HERE WE WILL MAKE FOTTER CONNECT WITH CONTENT OF THIS PAGE -->
<?php include $tpl . 'footer.php'; ?>
