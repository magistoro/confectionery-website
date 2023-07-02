
$(function(){
    $('.search-input').bind("change keyup input click", function() {
        if(this.value.length >= 2){
            $.ajax({
                type: 'post',
                url: "./search.php", //Путь к обработчику
                data: {'referal':this.value},
                response: 'text',
                success: function(data){
                   $(".search_result").html(data).fadeIn(); //Выводим полученые данные в списке
                }
            })
        }
        if(this.value.length == 0){
            $(".search_result").fadeOut(); //скрываем панельку с выводом
        }
    })
    
    $(".search_result").hover(function(){
        $(".search-input").blur(); //Убираем фокус с input
    })
    
    //При выборе результата поиска, прячем список и заносим выбранный результат в input
    $(".search_result").on("click", "li", function(){
        s_user = $(this).text();
          
        let result = parseInt(s_user.match(/(-?\d+(\.\d+)?)/g).map(v => +v)); 


        $.ajax({
            type: 'post',
            url: "./catalog.php", //Путь к обработчику
            data: {referal:result},
            response: 'text',
            success: function(data){
                localStorage.clear();
             }
        });

         window.location.href = 'good.php';               
    })
})

