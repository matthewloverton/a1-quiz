// Upon opening the modal set the title to the username and add the userID to the ok button.
$('#confirm-ban-user').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('record-id', data.recordId);
});

// Upon clicking the ok button send an ajax request to the ban user include with the userID. Then hide the modal
// and reload the page.
$('#confirm-ban-user').on('click', '.btn-ok', function(e) {
    modal = $(e.delegateTarget);
    var userID = $(this).data("recordId");
    var url = "../includes/ban-user.inc.php";

    $.ajax({
        type: "POST",
        url: url,
        data: {f_userID: userID},
        success: function(){
            location.reload();
        }
    }).then(function(){
        modal.modal('hide');
    });
});

// Upon opening the modal set the title to the username and add the userID to the ok button.
$('#confirm-delete-user').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('record-id', data.recordId);
});

// Upon clicking the ok button send an ajax request to the delete user include with the userID. Then hide the modal
// and reload the page.
$('#confirm-delete-user').on('click', '.btn-ok', function(e) {
    modal = $(e.delegateTarget);
    var userID = $(this).data("recordId");
    var url = "../includes/delete-user.inc.php";

    $.ajax({
        type: "POST",
        url: url,
        data: {f_userID: userID},
        success: function(){
            location.reload();
        }
    }).then(function(){
        modal.modal('hide');
    });
});

// Upon opening the modal set the title to the quizTitle and add the quizID to the ok button.
$('#confirm-delete-quiz').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('record-id', data.recordId);
});

// Upon clicking the ok button send an ajax request to the delete quiz include with the quizID. Then hide the modal
// and reload the page.
$('#confirm-delete-quiz').on('click', '.btn-ok', function(e) {

    modal = $(e.delegateTarget);
    var quizID = $(this).data("recordId");
    var url = "../includes/delete-quiz.inc.php";

    $.ajax({
        type: "POST",
        url: url,
        data: {f_quizID: quizID},
        success: function(){
            location.reload();
        }
    }).then(function(){
        modal.modal('hide');
    });
});

// Upon opening the modal set the values of the hidden inputs to the quizTitle, author and quizID.
$('#password-check').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $('.title', this).val(data.recordTitle);
    $('.author', this).val(data.recordAuthor);
    $('.id', this).val(data.recordId);
    $('.btn-play', this).data('record-id', data.recordId);
});

// Upon clicking the play button, prevent the form from submitting then find the entered password.
// Send an ajax request to the check password include with the quizID and password to check if the password matches.
// Then hide the modal.
$('#password-check').on('click', '.btn-play', function(e) {
    e.preventDefault();
    modal = $(e.delegateTarget);
    var quizID = $(this).data("recordId");
    var url = "../includes/check-password.inc.php";
    var password = $('#play-quiz-form').find('.password').val();
    $.ajax({
        url: url,
        method: "POST",
        data: {quizID : quizID, password : password},
        dataType: "json",
        success: function(data){
            if (data == "correct") {
                $('#play-quiz-form').submit();
            }
        },
        error: function(data){
            console.log("Error checking answer.")
        }
    }).then(function(){
        modal.modal('hide');
    });
});