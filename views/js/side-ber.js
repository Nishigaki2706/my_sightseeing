'use strick';
//メニュー開閉
$(function(){
$('.side-ber').hide();
$('header nav').on('click', function(){
    $('.side-ber').slideToggle();
})
});

//トップに戻る、サンプルを押したらメニューバーが閉じる
$(function(){
    $('top').on('click',function() {
        $('.side-ber').hide();
    });
});