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
    <!-- Register form with an option for Logging in if you already have an account. -->
    <div class="wrapper">
        <h1>Register</h1>
        <form id="form" method="post" action="../includes/register.inc.php">
            <input type="text" name="username"  placeholder="Username" value="<?php if (isset($_GET['username'])) {echo $_GET['username']; } ?>"/>
            <input type="email" name="email" placeholder="Email" value="<?php if (isset($_GET['email'])) {echo $_GET['email']; } ?>" required/>
            <input id="password" type="password" name="password" placeholder="Password"/>
            <input id="password_repeat" type="password" name="password_repeat" placeholder="Repeat Password"/>
            <button type="submit" name="register_submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
        </form>
        <p>Already have an account?<a href="../pages/login.php"> Login!</a></p>
    </div>
</body>
<?php

    require "../footer.php";

?>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
<script src="../js/validation.js"></script>
