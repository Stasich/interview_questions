$(document).ready(function () {
    $('.incr').click(function (e) {
        incr();
        getTime();
        e.preventDefault();
    });
    $('.decr').click(function (e) {
        decr();
        getTime();
        e.preventDefault();
    });

});
var timer = setInterval(getTime, 500);

function getTime()
{
    $.get('index.php', {ajax: "true"})
        .done(function (data) {
            var arrjson = JSON.parse(data);
            var time = new Date((arrjson['time']) * 1000);

            $('#time').text(time.toLocaleString());
        })
        .fail(function () {
            alert("Что-то пошло не так. Повторите пожалуйста позже");
        });
}

function incr() {
    $.post('index.php?ajax=true', {
        incr: 'true'
    })
}

function decr() {
    $.post('index.php?ajax=true', {
        decr: 'true'
    })
}