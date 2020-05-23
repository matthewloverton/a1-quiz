// Datatable customization options.
$(document).ready( function () {
    quizzes = $('#quizzes').DataTable({
    ordering: false,
    lengthChange: false,
    "pagingType": "simple",
    info: false,
    "dom": 'tp'
    });
    adminQuizzes = $('#adminQuizzes').DataTable({
        ordering: false,
        lengthChange: false,
        "pagingType": "simple",
        info: false,
        "dom": 'tp'
    });
    users = $('#users').DataTable({
        ordering: false,
        lengthChange: false,
        "pagingType": "simple",
        info: false,
        "dom": 'tp'
    });
    created = $('#userCreated').DataTable({
        ordering: false,
        lengthChange: false,
        "pagingType": "simple",
        info: false,
        "dom": 'tp'
    });
    leaderboard = $('#leaderboard').DataTable({
        ordering: true,
        "order": [[2, 'desc']],
        lengthChange: false,
        "pagingType": "simple",
        info: false,
        "dom": 'tp'
    });
    stats = $('#stats').DataTable({
        ordering: true,
        "order": [[1, 'desc']],
        lengthChange: false,
        "pagingType": "simple",
        info: false,
        "dom": 'tp'
    });
});

// Use Datatables api to use my custom searchbar.
$('#quizSearch').keyup(function(){
    quizzes.search($(this).val()).draw();
    adminQuizzes.search($(this).val()).draw();
    leaderboard.search($(this).val()).draw();
});

$('#userSearch').keyup(function(){
    users.search($(this).val()).draw();
});