// Set Quiz Variables
var counter = 0;
var question = 1;
var questionID;
var score = 0;

// Set Timer Variables
var initial = 1000;
var seconds = initial;
var interval; //10 will run it every 100th of a second


// Random number generator.
function random(min , max) {
    let random_number = Math.random() * (max-min) + min;
    return Math.floor(random_number);
}

// Display the Question in the div.
function displayQuestion(counter, data){
    // Set the question title to the value of question title.
    $("#questionTitle").text(data[counter]["f_questionTitle"]);

    // In order to prevent the answer being in the 4th slot everytime, the choices are randomly displayed.
    var choice = 1;
    // The choices are put in an array.
    var choices = [data[counter]['f_choice1'], data[counter]['f_choice2'], data[counter]['f_choice3'], data[counter]['f_answer']];
    // While there are still choices left a random number is generated and that choice is placed into the Question div.
    while(choices.length > 0){
        randomNumber = random(0, choices.length);
        $("#choice" + choice).text(choices[randomNumber]);
        choices.splice(randomNumber, 1);
        choice++;
    }
}

// Start the timer.
function timer() {
    if (seconds <= 0) {
        clearInterval(interval);
        return;
    }
    seconds--;
    displayTimer(seconds);
}

// Show the timer counting down, attach it to the #timer id.
function displayTimer(seconds) {
    // Set the resolution to milliseconds.
    var res = seconds / 100;
    $("#timer").text(res.toPrecision(seconds.toString().length));
}

// Next question method.
function nextQuestion(counter, data){
    // Show the next question modal and prevent clicking off it using the mouse or keyboard.
    $('#next-question').modal({backdrop: 'static', keyboard: false}, 'show');
    // Upon clicking the ok button, reset the timer.
    $('.btn-ok').off().on('click', function(){
        clearInterval(interval);
        seconds = initial;
        displayTimer(seconds);
        interval = setInterval(timer, 10);

        // Show the question and then increase the counter and question variables.
        displayQuestion(counter, data);
        counter++;
        question++;
        // Update the question counter to the current question.
        $("#question").text("Question: " + question + "/" + data.length);
        // Set a timeout for when the timer runs out (10s). If there are more questions show the next question modal, if not show the finish quiz modal.
        setTimeout(function(){
            if ($("#timer").text() === "0") {
                if(question < data.length){
                    nextQuestion(counter, data);
                }
                else{
                    setTimeout(function(){
                        // Show the finish quiz modal and prevent clicking off it using the mouse or keyboard.
                        $("#finish-quiz").modal({backdrop: 'static', keyboard: false}, 'show');
                        // Display the final score inside the modal.
                        $('#finish-quiz').find('.score').text(score);
                        // Upon clicking the finish button send an ajax request to the leaderboard include to insert a new record.
                        $('.btn-finish').on('click', function (){
                            $.ajax({
                                url: "../includes/leaderboard.inc.php",
                                method: "POST",
                                data: {score : score, userID : userID, quizID : quizID},
                                dataType: "json",
                                success: function(data){
                                    // Redirect to the leaderboard page upon success.
                                    window.location.replace("leaderboards.php");
                                },
                                error: function(){
                                    console.log("Error updating leaderboard.");
                                }
                            })
                        })
                    }, 200);
                }
            }}, 10100
        );
    })
}

// Calculate the score by multiplying the remaining time by 100.
function calculateScore(time){
    var points = time * 100;
    score = Math.floor(score + points);
    // Update the score in real time.
    $('#score').text("Score: " + score);
}

$(document).ready(function() {
    // Set the Quiz Title.
    $("#quizTitle").text(quizTitle);
    // Send an ajax request to retrieve the quiz data.
    $.ajax({
        url: "../includes/play-quiz.inc.php",
        method: "POST",
        data: {quizID : quizID},
        dataType: "json",
        success: function(data){
            // Show the play quiz modal and prevent clicking off it with the mouse and keyboard.
            $('#play-quiz').modal({backdrop: 'static', keyboard: false}, 'show');
            // Upon clicking the play button set a timeout for 10s, if there are remaining questions show the next question modal else show the finish quiz modal.
            $('.btn-play').on('click', function (){
                setTimeout(function(){
                    if ($("#timer").text() === "0") {
                        if(question < data.length){
                            nextQuestion(counter, data);
                        }
                        else{
                            setTimeout(function(){
                                $("#finish-quiz").modal({backdrop: 'static', keyboard: false}, 'show');
                                $('#finish-quiz').find('.score').text(score);
                                $('.btn-finish').on('click', function (){
                                    $.ajax({
                                        url: "../includes/leaderboard.inc.php",
                                        method: "POST",
                                        data: {score : score, userID : userID, quizID : quizID},
                                        success: function(data){
                                            console.log(data);
                                            window.location.replace("leaderboards.php");
                                        },
                                        error: function(){
                                            console.log("Error updating leaderboard.");
                                        }
                                    })
                                })
                            }, 200);
                        }
                    }}, 10100
                );
                // Set up the timer.
                displayTimer(initial);
                interval = setInterval(timer, 10);
                // Display the current question number.
                $("#question").text("Question: "+ question + "/" + data.length);
                // Display the current score.
                $("#score").text("Score: " + score);
                // Display the current question and choices.
                displayQuestion(counter, data);
            })
            // Upon clicking the quit button redirect to quizzes page.
            $('.btn-quit').on('click', function (){
                window.location.replace("quizzes.php");
            })
            // Upon clicking a choice stop the timer.
            $(".choice").on("click", function(){
                clearInterval(interval);
                // Send an ajax request to the check answer include with the value of the choice that was clicked.
                $.ajax({
                    url: "../includes/check-answer.inc.php",
                    method: "POST",
                    data: {quizID : quizID, questionID : data[counter]['f_questionID'], choice : $(this).find("h4").text()},
                    dataType: "json",
                    success: function(data){
                        // If the answer was correct, calculate the score.
                        if (data == "correct") {
                            calculateScore($('#timer').text());
                        }
                    },
                    error: function(){
                        console.log("Error checking answer.")
                    }
                })
                counter++;
                // If there are remaining questions go to the next question, else show the finish quiz modal.
                if(question < data.length){
                    nextQuestion(counter, data);
                }
                else{
                    setTimeout(function(){
                        $("#finish-quiz").modal({backdrop: 'static', keyboard: false}, 'show');
                        $('#finish-quiz').find('.score').text(score);
                        $('.btn-finish').on('click', function (){
                            $.ajax({
                                url: "../includes/leaderboard.inc.php",
                                method: "POST",
                                data: {score : score, userID : userID, quizID : quizID},
                                success: function(data){
                                    console.log(data);
                                    window.location.replace("leaderboards.php");
                                },
                                error: function(){
                                    console.log("Error updating leaderboard.");
                                }
                            })
                        })
                    }, 200);
                }
            })
        },
        error: function(){
            console.log("Error finding quiz.")
        }
    });
});