
$(document).ready(function() {

    var firstImgSrc = $("#image:first-child").attr("src");
    var mainImg = document.getElementById("main-img");
    mainImg.src = "../images/" + firstImgSrc;

    $('.slide img').click(function() {
     var imgSrc = $(this).attr('src');
     var imgId = $(this).data('id');


     var mainImg = document.getElementById("main-img");
     mainImg.src = "../images/" + imgSrc;



    // $('.popup-img').attr('src', imgSrc);
    // $('.overlay').fadeIn(200);
    // $('.popup').fadeIn(400);
    });
   
    $('.overlay, .close-btn').click(function() {
     $('.overlay').fadeOut(200);
     $('.popup').fadeOut(400);
    });
   });


   $(document).ready(function(){ // код для всплывающего окна с изображением
    $('.main-img').click(function() {
     var imgSrc = $(this).attr('src');
     var imgId = $(this).data('id');


    $('.popup-img').attr('src', imgSrc);
    $('.overlay').fadeIn(200);
    $('.popup').fadeIn(400);
    });
   
    $('.overlay, .close-btn').click(function() {
     $('.overlay').fadeOut(200);
     $('.popup').fadeOut(400);
    });
   });
