<?php

 function language( $phrase) {
    static $lang = array(

        //Dashboard page
        'HOME_ADMIN' => 'Home',
        'CATEGORIES' => 'categories',
        'ITEMS' => 'items',
        'MEMBERS' => 'Members',
        'COMMENTS' => 'Comments',
        'STATISTICS' => 'statistics',
        'LOGS' => 'logs'

    );
    
    return $lang[$phrase];
}
