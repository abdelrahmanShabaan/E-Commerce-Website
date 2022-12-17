<?php

/*
    Categories => [ Manage | Edit | update | Add | Insert | Delete | stats]
*/

$do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;


// if the page is main page

if($do == 'Manage'){

    echo 'welcome you are in manage page';

}elseif ($do == 'Add'){

    echo 'welcome you are Add Categories page';
}else {
    echo 'Error there\'s page with this name ';
}