<?php 
session_start();
$pageTitle = 'Login';

if(isset($_SESSION['user'])){
    header('Location: index.php'); // Redirect to dashboard
}

include 'init.php';

//check if user comming from http post request
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $hashedPass = sha1($pass);
    //  check if th user is exist 
    $stmt = $con->prepare("SELECT userID, username , password
    FROM users
    WHERE
     username = ?
     AND password= ? ");
    $stmt->execute(array($user, $hashedPass));
    $count = $stmt->rowCount();

    //IF Count > 0 This The Database Contain Information About this username  
    if($count > 0 ){
        $_SESSION['user'] = $user; // Regestration login users
       header('Location: index.php'); // Redirect to dashboard
       exit();  
    }
  }else{

        $formErrors = array();
        $usernames = $_POST['username'];
        $passwords = $_POST['password'];
        $emails = $_POST['email'];
    
        if(isset($_POST['username'])) {
            $filter_user = filter_var($_POST['username'] , FILTER_SANITIZE_STRING );
            if(strlen($filter_user) < 4 )
            {
                $formErrors[] =  "your name must be bigger than 4 characters";
            }elseif(strlen($filter_user) > 20 )
            {
                $formErrors[] =   "your name must be smaller than 4 characters";
            }
        }


        if(isset($_POST['password']) && isset($_POST['password2'])) {

            $pass1 = sha1($_POST['password']);
            $pass2 = sha1($_POST['password2']);

            if ($pass1 !== $pass2) {

                $formErrors[] = 'Sorry your passwords not match';
            }
        }

        if(isset($_POST['email'])) {
            $filterEmail = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL);
            if(filter_var($filterEmail , FILTER_VALIDATE_EMAIL) != true)
            {
                $formErrors[] = 'This email is not vaild';
            }
        }

        
            //check if there is no error proced the update operations
            if (empty($formErrors)) {

                // check if user exist in database 
                $check = checkItem("username", "users", $username);
                if ($check == 1) {

                    $formErrors[] = 'sorry this user is exist';

                } else {
                    //Insert Info TO Database
                    $stmt = $con->prepare("INSERT INTO 
                users(username , password , email  , regstatus ,date)
                VALUES(:zuser , :zpassword , :zemail , 0, now())"); 

                    $stmt->execute(
                        array(
                            'zuser' => $usernames,
                            'zpassword' => sha1($passwords),
                            'zemail' => $emails
                        )
                    );
                    // Echo the success messages
                    // echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted </div>';
                $successFun = 'congrate you are now registerd user';

                }

        }else {
         $errorMsg = "You cann't browse this page directly";
        }

        
    }
 }
?>

<div class="container login-pages">
    <h1 class="text-center">
    <span class="cell-selected" data-class="login">Login</span> |
     <span data-class="signup">Signup</span>
</h1>



<!-- Start login form -->
<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
<div class="input-container">
    <input class="form-control input-xlarge" type="text"  size="50" autocomplete="off" name="username" placeholder="type your username" required/>
    <div class="input-container">
    <input class="form-control input-xlarge" type="password" autocomplete="new-password" name="password"  placeholder="type your password" required/>
    </div>
    <input class="btn btn-primary btn-block" name="login" type="submit" value="login"/>
    </div>
</form>
<!-- End login form -->

<!-- Start Signup fom, -->
<form class="signup" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <input class="form-control input-xlarge" type="text"  autocomplete="off" name="username" placeholder="type your username" />
    <input class="form-control input-xlarge" type="password"   name="password"  placeholder="type complex password"/>
    <input class="form-control input-xlarge" type="password"   name="password2"  placeholder="type a password again"/>
    <input class="form-control input-xlarge" type="email" name="email"  placeholder="type your email" />
    <input class="btn btn-success btn-block" type="submit" value="Signup"/>
</form>
<!-- End Signup form -->
 <div class="the-errors text-center">
<?php
        if(!empty($formErrors))
        {
            foreach($formErrors as $error){
                echo '<div class="alert alert-danger">' . $error .'</div>' .'<br>' ;
            }
        }

        if (empty($formErrors) && isset($successFun))
        {
             echo '<div class="alert alert-success">' . $successFun . '</div>';
        }
?>

</div>
</div>


<?php include $tpl . 'footer.php';?>