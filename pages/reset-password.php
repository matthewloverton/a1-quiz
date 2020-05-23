<?php

    require "../header.php"

?>
<head>
    <link rel="stylesheet" href="../css/form.css">

</head>

<body>
    <div class="container text-center" style="padding-top: 150px;">
        <a id="logo" class="navbar-brand js-scroll-trigger hvr-grow-rotate" href="..\index.php">pickone</a>
    </div>
    <div class="container mb-4 mt-4">
        <?php
            require "../includes/responses.inc.php";
        ?>
    </div>
    <!-- Reset password form takes in takes selector and token from the url and puts them into hidden inputs -->
    <div class="wrapper">
        <h1>Reset Password</h1>
        <p>Enter a new password below.</p>
        <form id="form" method="post" action="../includes/reset-password.inc.php">
            <input type="hidden" value="<?php echo $_GET['selector'] ?>" name="selector"/>
            <input type="hidden" value="<?php echo $_GET['validator'] ?>" name="validator"/>
            <input type="password" name="password" id="password" placeholder="New Password"/>
            <input type="password" name="password_repeat" placeholder="Repeat New Password"/>
            <button type="submit" name="reset_password_submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
        </form>
    </div>
</body>
<?php

    require "../footer.php";

?>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
<script src="../js/validation.js"></script>

