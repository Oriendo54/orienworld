function showcaseUpdated() {
    let title = $('#cloud-item-title').html(
        $(showcase.closest('img')).attr('alt')
    );

    let c = Math.cos(Math.random(0, 100) % 1) * 2 * Math.PI;
    title.css('opacity', 0.7 + (0.5 * c));
}

$('.cloud9-nav > button').click(function(e) {
    let b = $(e.target).addClass('down');
    setTimeout(function() {
        b.removeClass('down');
    }, 80);
});

$(document).keydown(function(e) {
    switch(e.keyCode) {
        case 37:
            $('#cloud9-button-left').click();
            break;
        case 39:
            $('#cloud9-button-right').click();
            break;
    }
})

$(function() {

    let showcase = $('#showcase');
    $(showcase).Cloud9Carousel( {
        buttonLeft: $("#cloud9-button-left"),
        buttonRight: $("#cloud9-button-right"),
        autoPlay: 0,
        bringToFront: true,
        onRendered: showcaseUpdated,
        onLoaded: function(showcase) {
            $(showcase).css('visibility', 'visible');
            $(showcase).css('display', 'none');
            $(showcase).fadeIn(1500);
        },
        xRadius: 180,
        yOrigin: 50,
        yRadius: 50,
        xOrigin: 180,
    });
})
