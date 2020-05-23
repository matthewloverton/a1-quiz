<?php

    require "../header.php";
    $username = $_SESSION['username'];
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
    <!-- Create quiz main area -->
    <section class="bg-dark">
        <!-- Quiz title area -->
        <div class="container bg-primary pt-5 pb-5 text-center shadow">
            <form id="form" role="form" action="../includes/add-quiz.inc.php" method="post" autocomplete="off">
            <input type="hidden" name="username" value="<?php echo "$username"?>"/>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h3 class="section-heading text-white">Quiz Title</h3>
                    <input class="title input" type="text" name="quizTitle" placeholder="Enter Quiz Title..">
                </div>
            </div>
            <hr class="light">
            <!-- Quiz questions area -->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion" id="questions">
                        <div class="card">
                            <div class="card-header">
                                <!-- Quiz question title input with 2d array names for POSTing. -->
                                <input class="input mb-2 validate" type="text" name="question[0][questionTitle]" placeholder="Enter Question Title..">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse0" aria-expanded="true" aria-controls="collapse0"><i class="dark-icon" data-feather="edit"></i></button>
                                <button class="btn btn-link" type="button" disabled><i class="hidden-icon" data-feather="x"></i></button>
                                <input type="file" name="media[0][questionMedia]" id="media[0][questionMedia]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                                <label for="media[0][questionMedia]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                            </div>
                            <div id="collapse0" class="collapse show" data-parent="#questions">
                                <!-- When expanded the choices input comes up, also stored as 2d arrays for POSTing. -->
                                <div class="card-body">
                                    <input class="input mb-2" type="text" name="question[0][choice1]" placeholder="Choice 1..">
                                    <input type="file" name="media[0][choice1Media]" id="media[0][choice1Media]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                                    <label for="media[0][choice1Media]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                                    <input class="input mb-2" type="text" name="question[0][choice2]" placeholder="Choice 2..">
                                    <input type="file" name="media[0][choice2Media]" id="media[0][choice2Media]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                                    <label for="media[0][choice2Media]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                                    <input class="input mb-2" type="text" name="question[0][choice3]" placeholder="Choice 3..">
                                    <input type="file" name="media[0][choice3Media]" id="media[0][choice3Media]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                                    <label for="media[0][choice3Media]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                                    <input class="input mb-2" type="text" name="question[0][answer]" placeholder="Answer..">
                                    <input type="file" name="media[0][answerMedia]" id="media[0][answerMedia]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                                    <label for="media[0][answerMedia]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <input class="input mb-2" type="text" name="question[1][questionTitle]" placeholder="Enter Question Title..">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1"><i class="dark-icon" data-feather="edit"></i></button>
                                <button class="btn btn-link remove" type="button"><i class="red-icon" data-feather="x"></i></button>
                                <input type="file" name="media[1][questionMedia]" id="media[1][questionMedia]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                                <label for="media[1][questionMedia]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                            </div>
                            <div id="collapse1" class="collapse" data-parent="#questions">
                                <div class="card-body">
                                    <input class="input mb-2" type="text" name="question[1][choice1]" placeholder="Choice 1..">
                                    <input type="file" name="media[1][choice1Media]" id="media[1][choice1Media]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                                    <label for="media[1][choice1Media]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                                    <input class="input mb-2" type="text" name="question[1][choice2]" placeholder="Choice 2..">
                                    <input type="file" name="media[1][choice2Media]" id="media[1][choice2Media]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                                    <label for="media[1][choice2Media]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                                    <input class="input mb-2" type="text" name="question[1][choice3]" placeholder="Choice 3..">
                                    <input type="file" name="media[1][choice3Media]" id="media[1][choice3Media]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                                    <label for="media[1][choice3Media]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                                    <input class="input mb-2" type="text" name="question[1][answer]" placeholder="Answer..">
                                    <input type="file" name="media[1][answerMedia]" id="media[1][answerMedia]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                                    <label for="media[1][answerMedia]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <button class="btn btn-dark" id="addQuestion" type="button"> Add Question </button>
            </div>
            <!-- Button to log the fields in the console -->
            <!-- <div class="row justify-content-center mt-2">
                <button class="btn btn-dark" id="checkFields" type="button"> Check </button>
            </div> -->
            <hr class="light">
            <!-- Optional settings like password and attempts -->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                        <div>
                        <span class="text-muted"><small> optional</small></span>
                        <input class="input mb-2" type="password" name="quizPassword" placeholder="Enter password to access the quiz.." autocomplete="new-password">
                        </div>
                        <div>
                        <span class="text-muted"><small> optional</small></span>
                        <input class="input mb-2" type="text" name="quizAttempts" placeholder="Enter number of attempts available..">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="light">
            <div class="row justify-content-center">
                <button class="btn btn-light btn-xl" name="add_quiz_submit" type="submit"> Submit Quiz! </button>
            </div>
            </form>
        </div>
    </section>
    <footer>
        <p class="text-white text-center pt-3">&copy;2019 Matthew Overton - overtonportfolio.net</p>
    </footer>
</body>
<?php

    require "../footer.php";

?>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
<script src="../js/validation.js"></script>
<script src="../js/navigation.js"></script>
<script src="../js/inputfile.js"></script>
<script src="../js/scrolltop.js"></script>
<script src="../js/addquestion.js"></script>

<!-- <script>
        // script to the store the values of the fields and log them to the console for debugging.
        $("#checkFields").click(function () { 
            var checks = $('.input').map(function() { return this.value; }).get();
            console.log("Inputs [question]")
            console.log(checks);

            var file = $('.inputFile').map(function() { return this.value; }).get();
            console.log("Files [question]")
            console.log(file);
        });        
</script> -->