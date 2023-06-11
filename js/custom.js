/* global $, console */
$(function () {
    'use strict';

    
    /*
        // 1st method for showing errors using jQuery
        $('.username').blur(function () {
            if ($(this).val().length < 4) {
                $(this).css('border', '1px solid #f00');
                $(this).parent().find('.my-custom-alert').fadeIn(1000);
                $(this).parent().find('.asterisk').fadeIn(1000);
            } else {
                $(this).css('border', '1px solid #080');
                $(this).parent().find('.my-custom-alert').fadeOut(1000);
                $(this).parent().find('.asterisk').fadeOut(1000);
            }
        });
        
        
        $('.email').blur(function () {
            if ($(this).val() === '') {
                $(this).css('border', '1px solid #f00');
                $(this).parent().find('.my-custom-alert').fadeIn(1000);
                $(this).parent().find('.asterisk').fadeIn(1000);
            } else {
                $(this).css('border', '1px solid #080');
                $(this).parent().find('.my-custom-alert').fadeOut(1000);
                $(this).parent().find('.asterisk').fadeOut(1000);
            }
        });
        
        
        $('.message').blur(function () {
            if ($(this).val().length < 11) {
                $(this).css('border', '1px solid #f00');
                $(this).parent().find('.my-custom-alert').fadeIn(1000);
                $(this).parent().find('.asterisk').fadeIn(1000);
            } else {
                $(this).css('border', '1px solid #080');
                $(this).parent().find('.my-custom-alert').fadeOut(1000);
                $(this).parent().find('.asterisk').fadeOut(1000);
            }
        });
    */
    
    
    // 2nd method for showing errors using jQuery and expoiting it to prevent Submitting
    // Setting error status
    var userNameError = true,
        emailError    = true,
        messageError  = true;
    
    $('.username').blur(function () { // Error
        if ($(this).val().length < 4) {
            $(this).css('border', '1px solid #f00').parent().find('.my-custom-alert').fadeIn(1000)
                .end().parent().find('.asterisk').fadeIn(1000);
            userNameError = true;
        } else { // No error
            $(this).css('border', '1px solid #080').parent().find('.my-custom-alert').fadeOut(1000)
                .end().parent().find('.asterisk').fadeOut(1000);
            userNameError = false;
        }
    });


    
    $('.email').blur(function () { // Error
        if ($(this).val() === '') {
            $(this).css('border', '1px solid #f00').parent().find('.my-custom-alert').fadeIn(1000)
                .end().parent().find('.asterisk').fadeIn(1000);
            emailError = true;
        } else { // No error
            $(this).css('border', '1px solid #080').parent().find('.my-custom-alert').fadeOut(1000)
                .end().parent().find('.asterisk').fadeOut(1000);
            emailError = false;
        }
    });

    
    
    $('.message').blur(function () { // Error
        if ($(this).val().length < 11) {
            $(this).css('border', '1px solid #f00').parent().find('.my-custom-alert').fadeIn(1000)
                .end().parent().find('.asterisk').fadeIn(1000);
            messageError = true;
        } else { // No error
            $(this).css('border', '1px solid #080').parent().find('.my-custom-alert').fadeOut(1000)
                .end().parent().find('.asterisk').fadeOut(1000);
            messageError = false;
        }
    });

    
    
    // Form Validation
    $('.my-contact-form').submit(function (e) {
        if (userNameError === true || emailError === true || messageError === true) {
            e.preventDefault();
            // console.log(e); // To know what kind of (e)event
            $('.username, .email, .message').blur();
        }
    });
    
});