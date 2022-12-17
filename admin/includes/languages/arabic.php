<?php

 function language( $phrase) {
    static $lang = array(

        'message' => 'مرحبا ',
        'admin' => 'أدمن'
    );
    
    return $lang[$phrase];
}
