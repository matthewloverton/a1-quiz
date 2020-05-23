<?php

    require "../header.php";

    // Check to see if someone is logged in.
    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    }
    else{
        header('Location: ../index.php');
    }

    require "../includes/datatables.inc.php";

?>
<head>
    <!-- Custom styles for this page -->
    <link href="../main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../vendor/datatables/datatables.min.css"/>
</head>
<body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
        <a id="logo" class="navbar-brand js-scroll-trigger hvr-grow-rotate" href="../index.php">pickone</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" 
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="white-icon" data-feather="menu"></i>
        </button>
        <div class="collapse navbar-collapse text-center" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link hvr-float" href="../pages/quizzes.php">Quizzes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link hvr-float" href="../pages/leaderboards.php">Leaderboards</a>
            </li>
            <!-- Check to see if a user is logged in and/or is an admin, show appropriate nav links. -->
            <?php
                    if (isset($_SESSION['userID'])) {
                        if ($_SESSION['admin'] == 1) {
                            echo'<li class="nav-item hvr-float"><a class="nav-link" href="../pages/admin.php">admin</a></li>';
                        }
                        $username = $_SESSION['username'];
                        echo"<li class='nav-item hvr-float'><a class='nav-link active' href='../pages/account.php'><i data-feather='user'></i>$username</a></li>";
                        echo'<li class="nav-item hvr-float"><a class="nav-link" href="../includes/logout.inc.php">logout</a></li>';
                    }
                    else{
                        echo'<li class="nav-item hvr-float"><a class="nav-link" href="../pages/register.php">register</a></li>';
                        echo'<li class="nav-item hvr-float"><a class="nav-link" href="../pages/login.php">login</a></li>';
                    }
                ?>
            </ul>
        </div>
        </div>
    </nav>
    <!-- Area to show what quizzes the user has created. -->
    <section class="bg-dark">
        <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Your Quizzes</h2>
            <hr class="light my-4">
            <?php echo $createdtable ?>
            </div>
        </div>
        </div>
    </section>
    <!-- Area to show stats from quizzes the user has played. -->
    <section class="bg-primary">
        <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Your Stats</h2>
            <hr class="light my-4">
            <?php echo $statstable ?>
            </div>
        </div>
        </div>
    </section>
    <!-- Area to edit account details [FUTURE]. -->
    <section class="bg-dark">
        <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Edit account</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4">Account tools such as email change, password change, delete account</p>
            <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">Get Started!</a>
            </div>
        </div>
        </div>
    </section>
    <footer>
        <p class="text-white text-center pt-3">&copy;2019 Matthew Overton - overtonportfolio.net</p>
    </footer>
</body>
<?php

    require "../footer.php";

?>
<script src="../vendor/datatables/datatables.min.js"></script>
<script src="../js/datatable.js"></script>
<script src="../js/scrolltop.js"></script>
<script src="../js/navigation.js"></script>