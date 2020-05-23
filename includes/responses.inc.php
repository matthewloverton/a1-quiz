<?php
    // checks to see if there is an error tag in the URL, if so print an alert with the error.
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyFields") {
            echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Oh Snap!</strong> Please make sure all the fields are filled.
            </div>";
        }
        else if ($_GET['error'] == "invalidEmail") {
            echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Oh Snap!</strong> Please enter a valid email address, e.g example@example.com
            </div>";
        }
        else if ($_GET['error'] == "invalidUsername") {
            echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Oh Snap!</strong> Please enter a valid username, only alphanumeric.
            </div>";
        }
        else if ($_GET['error'] == "passwordCheck") {
            echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Oh Snap!</strong> Those passwords do not match.
            </div>";
        }
        else if ($_GET['error'] == "userTaken") {
            echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Oh Snap!</strong> That username is taken.
            </div>";
        }
        else if ($_GET['error'] == "emailUsed") {
            echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Oh Snap!</strong> This email is in use.
            </div>";
        }
        else if ($_GET['error'] == "wrongPassword" || $_GET['error'] == "noUser") {
            echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Oh Snap!</strong> The username or password is incorrect.
            </div>";
        }
        else if ($_GET['error'] == "noEmail" || $_GET['error'] == "noUser") {
            echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Oh Snap!</strong> No user exists with that email.
            </div>";
        }
        else if ($_GET['error'] == "userBanned") {
            echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Oh Snap!</strong> You're banned!
            </div>";
        }
    }
    // checks to see if there is an success tag in the URL, if so print an alert with the success.
    else if (isset($_GET['success'])) {
        if ($_GET['success'] == "register"){
            echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Congratulations!</strong> Registration successful, please log in.
            </div>";
        }
        else if ($_GET['success'] == "reset"){
            echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Congratulations!</strong> Reset successful, please check your email.
            </div>";
        }
        else if ($_GET['success'] == "passwordUpdated"){
            echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Congratulations!</strong> Password successfully reset, please log in.
            </div>";
        }
    }
?>