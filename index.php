<?php

    require "header.php"

?>
<head>
    <!-- Custom styles for this page -->
    <link href="main.css" rel="stylesheet">
    <link href="css/searchbar.css" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
        <a id="logo" class="navbar-brand js-scroll-trigger hvr-grow-rotate" href="#page-top">pickone</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="white-icon" data-feather="menu"></i></span>
        </button>
        <div class="collapse navbar-collapse text-center" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link hvr-float" href="pages/quizzes.php">Quizzes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link hvr-float" href="pages/leaderboards.php">Leaderboards</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger hvr-float" href="#about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger hvr-float" href="#contact">Contact</a>
            </li>
            <!-- Check to see if a user is logged in and/or is an admin, show appropriate nav links. -->
            <?php
                    if (isset($_SESSION['userID'])) {
                        if ($_SESSION['admin'] == 1) {
                            echo'<li class="nav-item"><a class="nav-link hvr-float" href="pages/admin.php">admin</a></li>';
                        }
                        $username = $_SESSION['username'];
                        echo"<li class='nav-item'><a class='nav-link hvr-float' href='pages/account.php'><i data-feather='user'></i>$username</a></li>";
                        echo'<li class="nav-item"><a class="nav-link hvr-float" href="includes/logout.inc.php">logout</a></li>';
                    }
                    else{
                        echo'<li class="nav-item"><a class="nav-link hvr-float" href="pages/register.php">register</a></li>';
                        echo'<li class="nav-item"><a class="nav-link hvr-float" href="pages/login.php">login</a></li>';
                    }
                ?>
            </ul>
        </div>
        </div>
    </nav>
    <header class="masthead text-center text-white d-flex">
        <div class="container my-auto">
        <div class="row">
            <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
                <strong>Become a top quizzer now!</strong>
            </h1>
            <hr>
            </div>
            <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Using this website you can create and play a variety of quizzes!</p>
            <!-- If there is a user logged in go to the create quiz page, else go to the login page -->
            <a class="btn btn-primary btn-xl js-scroll-trigger mr-5" href="<?php if (isset($_SESSION['userID'])) { echo 'pages/create-quiz.php'; }
                                                                            else{ echo 'pages/login.php'; }?>">Create a Quiz</a>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="<?php if (isset($_SESSION['userID'])) { echo 'pages/quizzes.php'; }
                                                                            else{ echo 'pages/login.php'; }?>">Play a Quiz</a>
            </div>
        </div>
        </div>
    </header>
    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-heading text-white">A site perfect for your multiple choice quiz needs!</h2>
                    <hr class="light my-4">
                    <p class="mb-5 text-white">This site was desgined with user experience in mind, with leaderboards to show off your general knowledge prowess to your friends.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="contact">
        <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Contact us via email!</h2>
            <hr class="my-4">
            <p class="mb-5 text-white">If you have any feedback for the website feel free to contact us via the email below.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 ml-auto mr-auto text-center">
            <i class="white-icon" data-feather="mail"></i>
            <p>
                <a href="mailto:info@overtonportfolio.net">info@overtonportfolio.net</a>
            </p>
            </div>
        </div>
        </div>
    </section>
    <footer>
        <p class="text-white text-center pt-3">&copy;2019 Matthew Overton - overtonportfolio.net</p>
    </footer>
</body>
<?php

    require "footer.php";

?>
<script src="js/scrolltop.js"></script>
<script src="js/navigation.js"></script>