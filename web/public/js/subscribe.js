$(document).ready(function () {

        setTimeout (function(){
            $('.popup,.popup_overlay').fadeIn(400);
        }, 15000);


    $('.closer,.popup_overlay').click(function(){
        $('.popup,.popup_overlay').fadeOut(400);
    });
});