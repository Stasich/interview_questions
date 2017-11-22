$(document).ready(function () {
    $('a').click(function () {
        $(this).parent().parent().remove();
    });
});