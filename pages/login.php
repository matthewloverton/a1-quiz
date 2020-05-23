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
    <!-- Login form with options for Registering and recovering password. -->
    <div class="wrapper">
        <h1>Login</h1>
        <form method="post" action="../includes/login.inc.php">
            <input type="text" name="username" placeholder="Username"/>
            <input type="password" name="password" placeholder="Password"/>
            <button type="submit" name="login_submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
        </form>
        <p><a href="../pages/reset-request.php">Forgotten your password?</a></p>
        <p>Need an account?<a href="../pages/register.php"> Register!</a></p>
    </div>
    
    
</body>
<?php

    require "../footer.php";

?>
