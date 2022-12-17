<?php

//start the session firstly
session_start();

//unset for sessions
session_unset();

//destory the session
session_destroy();

//Redirect after this to index.php file
header('Location: index.php');

//make exit to exit from any error can make do
exit();