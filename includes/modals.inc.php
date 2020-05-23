    <!-- Delete User Modal -->
    <div class="modal fade" id="confirm-delete-user" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-user" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete User <b><i class="title"></i></b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>You are about to delete user <b><i class="title"></i></b>, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-ok">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Quiz Modal -->
    <div class="modal fade" id="confirm-delete-quiz" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-quiz" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Quiz <b><i class="title"></i></b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>You are about to delete quiz <b><i class="title"></i></b>, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-ok">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Ban User Modal -->
    <div class="modal fade" id="confirm-ban-user" tabindex="-1" role="dialog" aria-labelledby="confirm-ban-user" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ban User <b><i class="title"></i></b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>You are about to ban user <b><i class="title"></i></b>, this procedure is reversible but will appear permanent to the user.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-ok">Ban</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Play Quiz -->
    <div class="modal fade" id="play-quiz" tabindex="-1" role="dialog" aria-labelledby="play-quiz" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b><?php echo $quizTitle ?></i></b></h4>
                </div>
                <div class="modal-body">
                    <p>This quiz was created by <b><?php echo $author ?></i></b>, enjoy!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-quit" data-dismiss="modal">Quit</button>
                    <button type="button" class="btn btn-success btn-play" data-dismiss="modal">Play</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Check Password -->
    <div class="modal fade" id="password-check" tabindex="-1" role="dialog" aria-labelledby="password-check" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b><i class="title"></i></b></h4>
                </div>
                <div class="modal-body">
                    <p>This quiz requires a password!</p>
                    <form id="play-quiz-form" action="play-quiz.php" method="post">
                        <input type="password" class="password form-control" name="password" placeholder="Enter Password.."/>
                        <input type="hidden" name="quizTitle" class="title"/>
                        <input type="hidden" name="author" class="author"/>
                        <input type="hidden" name="quizID" class="id"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Back</button>
                    <button type="submit" class="btn btn-success btn-play" data-dismiss="modal">Play</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Next Question -->
    <div class="modal fade" id="next-question" tabindex="-1" role="dialog" aria-labelledby="next-question" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Next Question</b></h4>
                </div>
                <div class="modal-body">
                    <p>When you are ready to move on to the next question click next question!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-ok" data-dismiss="modal">Next Question</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Finish Quiz -->
    <div class="modal fade" id="finish-quiz" tabindex="-1" role="dialog" aria-labelledby="finish-quiz" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b><?php echo $quizTitle ?></i></b></h4>
                </div>
                <div class="modal-body">
                    <p>You have completed the quiz, <b><?php echo $quizTitle ?></i></b>, with a score of: <b class="score"></b></p>
                    <p>Check out the leaderboard to see how you stack up!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-finish" data-dismiss="modal">Finish</button>
                </div>
            </div>
        </div>
    </div>