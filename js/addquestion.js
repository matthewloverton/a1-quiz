var counter = 1;
// Upon clicking add question, increase the counter to create a new unique name and add a new question.
$("#addQuestion").click(function () {
    counter++;
    $("#questions").append(
        `
        <div class="card">
            <div class="card-header">
                <input class="input mb-2" type="text" name="question[` + counter + `][questionTitle]" placeholder="Enter Question Title..">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse` + counter + `" aria-expanded="false" aria-controls="collapse` + counter + `"><i class="dark-icon" data-feather="edit"></i></button>
                <button class="btn btn-link remove" type="button"><i class="red-icon" data-feather="x"></i></button>
                <input type="file" name="media[` + counter + `][questionMedia]" id="media[` + counter + `][questionMedia]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                <label for="media[` + counter + `][questionMedia]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
            </div>
            <div id="collapse` + counter + `" class="collapse" data-parent="#questions">
                <div class="card-body">
                    <input class="input mb-2" type="text" name="question[` + counter + `][choice1]" placeholder="Choice 1..">
                    <input type="file" name="media[` + counter + `][choice1Media]" id="media[` + counter + `][choice1Media]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                    <label for="media[` + counter + `][choice1Media]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                    <input class="input mb-2" type="text" name="question[` + counter + `][choice2]" placeholder="Choice 2..">
                    <input type="file" name="media[` + counter + `][choice2Media]" id="media[` + counter + `][choice2Media]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                    <label for="media[` + counter + `][choice2Media]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                    <input class="input mb-2" type="text" name="question[` + counter + `][choice3]" placeholder="Choice 3..">
                    <input type="file" name="media[` + counter + `][choice3Media]" id="media[` + counter + `][choice3Media]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                    <label for="media[` + counter + `][choice3Media]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                    <input class="input mb-2" type="text" name="question[` + counter + `][answer]" placeholder="Answer..">
                    <input type="file" name="media[` + counter + `][answerMedia]" id="media[` + counter + `][answerMedia]" class="inputfile" accept=".wav,.mp3,.jpg,.png"/>
                    <label for="media[` + counter + `][answerMedia]"><i class="dark-icon" data-feather="upload"></i><span>Choose optional multimedia</span></label>
                </div>
            </div>
        </div>
        `
    );

    // Add icons.
    feather.replace();

    $('[name^="question"]').each(function() {
        $(this).rules('add', {
            required: true,
            })
    });

    // Finds the last field added and adds a nice animation to it
    $('#questions').find(".card:last").hide().slideDown("fast");
});

// remove a field with a nice slide animation
$(document).on("click", ".remove", function () {
    $(this).parent().parent().slideUp("fast", function () {
        $(this).remove();
    });
});