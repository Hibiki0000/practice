$(function(){
    $('.modalbtn').on('click', () => {
        $('.modal').css('display','block');
    });
    $('.modal_back').on('click', () => {
        $('.modal').fadeOut();
    });

    console.log("ai");
});