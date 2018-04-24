$(document).ready(function () {

    //delete task
    var taskDelete = $('.js-task-delete');
    taskDelete.on('click', function (e) {
        e.preventDefault();
        var btn = $(this);
        var deleteHref = btn.attr('href');
        $.getJSON(deleteHref, function () {
            btn.closest('#task').remove();
        })
    });

    //delete category
    var categoryDelete = $('.js-category-delete');
    categoryDelete.on('click', function (e) {
        e.preventDefault();
        var btn = $(this);
        var deleteHref = btn.attr('href');
        $.getJSON(deleteHref, function () {
            btn.closest('#category').remove();
        })
    });

    //delete comment
    var commentDelete = $('.js-comment-delete');
    commentDelete.on('click', function(e) {
        e.preventDefault();
        var btn = $(this);
        var deleteHref = btn.attr('href');
        $.getJSON(deleteHref, function () {
            btn.closest('#comment').remove();
        })
    });

});
