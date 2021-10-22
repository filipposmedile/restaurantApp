window.onscroll = function(){
    if($(window).scrollTop() > 0){
        $('header').css('transform','translateY(70px)');
    } else {
        $('header').css('transform','translateY(0)');
    }
}
window.onload = function(){
    $('#page-loader').css('opacity',0);
    $('#page-loader-2').css('opacity',0);
    setTimeout(displayNone($('#page-loader'),$('#page-loader-2')),1000);
}
function grid(x){
    $('#div-img-'+ x).css('display','flex');
    $('#div-img-'+ x).css('opacity', 1);
}
function imageDisappear(){
    $('.image-show').css({'display': 'none' , 'opacity': 0});
}
function displayNone(a , b){
    a.css('display','none');
    b.css('display','none');
}
