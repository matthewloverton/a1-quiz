// Add a custom validation rule to check for positive numbers.
$.validator.addMethod('positiveNumber',
    function (value) { 
        return Number(value) > 0;
    }, 'Enter a positive number.');
// JQueryValidate rules
$(document).ready(function(){
    $("#form").validate({
        ignore: false,
        rules: {
            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 6
            },
            password_repeat: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
            email: {
                required: true,
                email: true
            },
            quizAttempts: {
                digits: true
            },
            quizTitle:{
                required: true
            }

        },
        messages: {
            username:{
                required: "Please enter a username.",
            },
            password: {
                required: "Please enter a password.",
                minlength: "Your password must be at least 6 characters long."
            },
            password_repeat:{
                required: "Please repeat your password.",
                minlength: "Your password must be at least 6 characters long.",
                equalTo: "The passwords must match."
            },
            quizAttempts:{
                digits: "Please only enter positive numbers"
            }
        }
    })

// Add validation to questions added dynamically.
    $('[name^="question"]').each(function() {
        $(this).rules('add', {
            required: true,
            })
    });
});