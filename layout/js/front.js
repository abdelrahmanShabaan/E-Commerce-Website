$(function (){
    'use strict';  

    

$('.login-pages h1 span').click(function (){

    $(this).children().addClass('cell-selected').parent().siblings().removeClass('cell-selected');    
    $('.login-pages form').hide();
    $('.' + $(this).data('class')).fadeIn(100);

    
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

// Confirmation message on button
 
$('.confirm').click(function(){

        return confirm('Are you Sure?');
});

$('.live_name').keyup(function () {

         $('.live_preview .caption h3').text($(this).val());
       //  console.log($(this).val());
});


$('.live_des').keyup(function () {

    $('.live_preview .caption p').text($(this).val());
});


$('.live_price').keyup(function () {

    $('.live_preview .price_tag').text( '$' + $(this).val());
});

});

