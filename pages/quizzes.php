<?php

    require "../header.php";

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    }

    require "../includes/db.inc.php";

    require "../includes/datatables.inc.php";

?>
<head>
    <!-- Custom styles for this page -->
    <link href="../main.css" rel="stylesheet">
    <link href="../css/searchbar.css" rel="stylesheet">
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
                    <a class="nav-link hvr-float active" href="../pages/quizzes.php">Quizzes</a>
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
                            echo"<li class='nav-item hvr-float'><a class='nav-link' href='../pages/account.php'><i data-feather='user'></i>$username</a></li>";
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
    <!-- Featured quiz section [FUTURE] -->
    <section class="bg-dark" id="featured">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <h2 class="section-heading text-white">Featured Quizzes</h2>
                    <hr class="light my-4">
                    <div class="card-deck">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo "Quiz Title" ?></h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                                <a class="btn btn-light btn-xl js-scroll-trigger" href="<?php ?>">Play!</a>
                            </div>
                        </div>
                        <div class="card bg-primary">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo "Quiz Title" ?></h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                                <a class="btn btn-light btn-xl js-scroll-trigger" href="<?php ?>">Play!</a>
                            </div>
                        </div>
                        <div class="card bg-primary">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo "Quiz Title" ?></h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                                <a class="btn btn-light btn-xl js-scroll-trigger" href="<?php ?>">Play!</a>
                            </div>
                        </div>
                    </div>
                    <!-- If there is a user logged in go to the create quiz page, else go to the login page -->
                    <a class="btn btn-primary btn-xl js-scroll-trigger mt-5" href="<?php if (isset($_SESSION['userID'])) { echo 'create-quiz.php'; }
                                                                            else{ echo 'login.php'; }?>">Create a Quiz</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Show all of the quizzes -->
    <section class="bg-primary" id="table">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <h2 class="section-heading text-white">All Quizzes</h2>
                    <hr class="light my-4">
                    <form autocomplete="off">
                        <div class="container h-100">
                            <div class="d-flex justify-content-center h-100">
                                <div class="searchbar">
                                    <input id="quizSearch" class="search_input" type="text" name="search" placeholder="Search...">
                                    <button type=submit class="search_icon" disabled><i data-feather="search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr class="light my-4">
                    <?php echo $datatable ?>
                </div>
            </div>
        </div>
    </section>
    <?php require "../includes/modals.inc.php"; ?>
    <footer>
        <p class="text-white text-center pt-3">&copy;2019 Matthew Overton - overtonportfolio.net</p>
    </footer>
</body>
<?php

    require "../footer.php";

?>
<script src="../js/navigation.js"></script>
<script src="../js/scrolltop.js"></script>
<script src="../vendor/datatables/datatables.min.js"></script>
<script src="../js/datatable.js"></script>
<script src="../js/admin.js"></script>