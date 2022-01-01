'use strick';
//メニュー開閉
$(function(){
$('.side-ber').hide();
$('header nav').on('click', function(){
    $('.side-ber').slideToggle();
})
});

$(function(){
    var top = document.getElementById('top');
    top.addEventListener('click',() => {
        $('.side-ber').hide();
    })
    // // サイドバー以外のところを押したらサイドバーが消える
    // if(top.hasClass('active')){
    //     var close = $('.side-ber');
    //     var body_element = document.querySelector('html body');
    //     body_element.on('click',function(){
    //         top.removeClass('active');
    //         body_element.removeClass('active');
    //         close.hide();
    //     });
    // }
})

//トップに戻る、サンプルを押したらメニューバーが閉じる
$(function(){
    $('top').on('click',function() {
        $('.side-ber').hide();
    });
});