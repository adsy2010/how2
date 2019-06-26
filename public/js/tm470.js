$(".clickable-row").click(function() {
    window.location = $(this).data("href");
});


function addStep(){
    $("#steplist").append(
        "<div class=\"row step\"><div class=\"col-md-10\">" +
        "<textarea name='step[content][]' class='form-control' rows='2'></textarea>" +
        "</div>" +
        "<div class=\"col-md-2\"><input type='file' name='step[supplementary][]'><a class='btn btn-danger form-control' style='margin-top: 3px; color: whitesmoke;' onclick=\"deleteStep(this);\">" +
        "Remove step <span class='fa fa-trash'></a></div>" +
        "<div class='col-md-12'><hr></div></div>" /* row is required or additional hr tags are left behind */
    );
}

function deleteStep(target) {
    $(target).closest('.step').remove();
    return false;
}

function rate(url, rating, csrf) {
    $.post(url, {
        [rating]: 1,
        "_token": csrf
    });
}

function approve(url, approval, csrf)
{
    $.post(url, {
        "approval": approval,
        "_token": csrf
    })
}

function reject(url, approval, csrf)
{
    $.post(url, {
        "approval": approval,
        "_token": csrf
    })
}