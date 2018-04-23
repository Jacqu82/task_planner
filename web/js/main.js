$(document).ready(function () {

    //delete task
    $('body').on('click', '.js-task-delete', function (e) {
        e.preventDefault();
        var btn = $(this);
        var deleteUrl = btn.attr('href');
        $.getJSON(deleteUrl, function () {
            btn.closest('#task').remove();
        })
    });

    //delete category
    $('body').on('click', '.js-category-delete', function (e) {
        e.preventDefault();
        var btn = $(this);
        var deleteUrl = btn.attr('href');
        $.getJSON(deleteUrl, function () {
            btn.closest('#category').remove();
        })
    });

});
