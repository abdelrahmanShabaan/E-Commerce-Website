$(function (){
    'use strict';

    // Dashboard
    $('.toggle-info').click(function (){
            $(this).parent().next('.panel-body').fadeToggle(100);

    });
    

    // Hide Placeholder On from Focuss
    $('[placeholder]').focus(function() {

        $(this).attr('data-text' , $(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function(){

        $(this).attr('placeholder', $(this).attr('data-text'));
    });


    
// Add Asterisj on required field

$('input').each(function () {

    if($(this).attr('required') === 'required'){

        $(this).after('<span class="asterisk">*</span>');
    }
});

//convert password field to text field on hover

 var passField = $('.password');

 $('.show-pass').hover(function (){
        passField.attr('type', 'text');
}, function(){
    passField.attr('type', 'password');
    
});

// Confirmation message on button
 
$('.confirm').click(function(){

        return confirm('Are you Sure?');
});

// Categories view option
$('.cat h3').click(function (){
    $(this).next('.full-view').fadeToggle(500);

});


});

