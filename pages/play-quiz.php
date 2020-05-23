<?php

    require "../header.php";

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
        $username = $_SESSION['username'];
    }

    if (isset($_POST['quizTitle'])) {
        $quizTitle = $_POST['quizTitle'];
        $quizID = $_POST['quizID'];
        $author = $_POST['author'];
    }
    else{
        header("Location: quizzes.php");
    }
   
?>
<head>
    <!-- Custom styles for this page -->
    <link href="../main.css" rel="stylesheet">
    <link href="../css/create-quiz.css" rel="stylesheet">
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
    <!-- Empty fields for Quiz Title, Question Title, 4 Choices, Time, Score and Question number. -->
    <section class="bg-dark">
        <div class="container bg-primary pt-5 pb-5 text-center shadow">
            <div class="row mb-3">
                <div class="col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="text-white" id="quizTitle"></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
            <div class="col-lg-2">
                </div>
                <div class="col-lg-8 p-0">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-white" id="questionTitle"></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4 p-0">
                    <div class="card choice">
                        <div class="card-body">
                            <h4 class="text-white" id="choice1"></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-0">
                    <div class="card choice">
                        <div class="card-body">
                            <h4 class="text-white" id="choice2"></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4 p-0">
                    <div class="card choice">
                        <div class="card-body">
                            <h4 class="text-white" id="choice3"></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-0">
                    <div class="card choice">
                        <div class="card-body">
                            <h4 class="text-white" id="choice4"></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
            <div class="row mb-3 mt-3">
                <div class="col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4"><h5 class="text-white" id="timer"></h5></div>
                                <div class="col-4"><h5 class="text-white" id="score"></h5></div>
                                <div class="col-4"><h5 class="text-white" id="question"></h5></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <p class="text-white text-center pt-3">&copy;2019 Matthew Overton - overtonportfolio.net</p>
    </footer>
    <?php require "../includes/modals.inc.php"?>
</body>
<?php

    require "../footer.php";

?>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
<script src="../js/validation.js"></script>
<script src="../js/scrolltop.js"></script>
<script src="../js/navigation.js"></script>
<script src="../js/inputfile.js"></script>
<script> 
    var userID = <?php echo $userID ?>;
    var quizID = <?php echo $quizID ?>;
    var quizTitle = "<?php echo $quizTitle ?>";
</script>
<script src="../js/playquiz.js"></script>