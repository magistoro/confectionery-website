
$(document).ready(function() {

    var firstImgSrc = $("#image:first-child").attr("src");
    var mainImg = document.getElementById("main-img");
    mainImg.src = "" + firstImgSrc;

    $('.slide img').click(function() {
     var imgSrc = $(this).attr('src');
     var imgId = $(this).data('id');


     var mainImg = document.getElementById("main-img");
     mainImg.src = "" + imgSrc;

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


   // Логика панели +-
   
    countOfCard_minus();
   function countOfCard_minus() {
    var countOfCard = parseInt(document.getElementById("countOfCard").textContent);
    if(countOfCard > 1){
        countOfCard-=1;
        document.getElementById("countOfCard").textContent = countOfCard;

       
    }
    $.ajax({
        type: "POST",
        url: "./good.php",
        data: { countOfCard:countOfCard },
        success: function() {
            console.log("Передано минус");
        }
    });
   }



   function countOfCard_plus() {
    var countOfCard = parseInt(document.getElementById("countOfCard").textContent);
    countOfCard+=1;
    document.getElementById("countOfCard").textContent = countOfCard;

   $.ajax({
    type: "POST",
    url: "./good.php",
    data: {countOfCard:countOfCard},
   
    success: function() {
        console.log("Передано плюс" );
    }
});
}


// Логика передачи данных после поиска

    let card = localStorage.getItem('card');
    //  alert (card);


// $(function(){
    
        
// })
