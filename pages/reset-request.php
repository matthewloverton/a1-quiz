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
    <!-- Reset password request form checks to see if there is a user with an email and sends them a reset password email -->
    <div class="wrapper">
        <h1>Reset Password</h1>
        <p>A reset password request will be sent to your email.</p>
        <form id="form" method="post" action="../includes/reset-request.inc.php">
            <input type="email" name="email" placeholder="Email"/>
            <button type="submit" name="reset_request_submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
        </form>
        <p>Remember your password?<a href="../pages/login.php"> Login!</a></p>
    </div>
</body>
<?php

    require "../footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
<script src="../js/validation.js"></script>
