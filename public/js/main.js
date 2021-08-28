$(document).ready(function () {
    let headerHeight = $('.site-header').height() + 50;
    $('.content-box').css("margin-top", headerHeight);
});

$(window).resize(function () {
    let headerHeight = $('.site-header').height() + 50;
    $('.content-box').css("margin-top", headerHeight);
});
