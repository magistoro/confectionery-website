
 // <!-- Выдвижное меню -->

jQuery(document).ready(function($){
    // Клик по кнопке-гамбургеру открывает меню, повторный клик закрывает  
    $('.basket-button').click(function(){
      $('.basket-button').toggleClass("open");
      $('.left-menu').toggleClass("show");
      $('.hidden-overley').toggleClass("show");
      $('body').toggleClass("left-menu-opened")
    });
    // Когда панель открыта, клик по облсти вне панели закрывает ее 
    $('.hidden-overley').click(function(){
      $(this).toggleClass("show");
      $('.left-menu').toggleClass("show");
      $('.basket-button').toggleClass("open");
      $('body').toggleClass("left-menu-opened")
    });
    // меняем активность пункта меню по клику (НЕОБЯЗАТЕЛЬНО)
    $('.left-menu ul li').click(function(){
        $(this).addClass("current-menu-item").siblings().removeClass("current-menu-item");
    });
    // Для анимации поворота каретки
    $('.menu-parent-item a:first-child').click(function(){
        $(this).siblings().toggleClass("show");
        $(this).find("i").toggleClass("rotate");
    }); 
  });



  // <!-- выпадающее меню -->
  function toggleMenu(id) {
    var menu = document.getElementById(id);
    if (menu.style.display == "block") {
      menu.style.display = "none";
      document.getElementById(id+"-vector").style.transform="rotate(0deg) scaleX(-1)"; // меняем значёк
    }
     else if(menu.style.display = "none"){
     menu.style.display = "block";
     document.getElementById(id+"-vector").style.transform="rotate(180deg) scaleX(-1)";
    } 
   }
    // <!-- выпадающее меню закончено -->


    $(document).ready(function() { 



      function refreshSearch() {
        start = 0; // Сбрасываем стартовый индекс
        
        requestData = '';
        $('.menu-checkbox:checked').each(function() {
          var dataId = $(this).data('id');
          var categoryName = dataId.trim().split('_')[0];
          var categoryId = dataId.split('_')[1];
          requestData += (categoryName + "_" + categoryId + "-");
        });
        
        getData(limit, start); // Вызываем функцию получения товаров
        
        // Обновляем кнопку "Показать больше"
        if (requestData.trim() !== '') {
          $('#show-more').show();
          $('#show-more').data('start', 0);
        } else {
          $('#show-more').hide();
        }
      }
      



// Панель ЦЕНА

const rangeInput = document.querySelectorAll(".range-input input");
priceInput = document.querySelectorAll(".price-input input");
progress = document.querySelector(".slider .progress");

let priceGap = 300;

//
function initializeValues() {
  priceInput[0].value = 0;
  priceInput[1].value = parseInt(priceInput[1].value);

  const minVal = parseInt(priceInput[0].value);
  const maxVal = parseInt(priceInput[1].value);

  progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
  progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
}
initializeValues();
//

priceInput.forEach(input => {
  input.addEventListener("input", e =>{
    let minVal = parseInt(priceInput[0].value),
    maxVal = parseInt(priceInput[1].value);

    if((maxVal - minVal >= priceGap) && maxVal <=10000){
      if(e.target.className === "input-min"){
        rangeInput[0].value = minVal;
        
        progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";

        refreshSearch()
        getData(limit, start, requestData);
      }else{
        rangeInput[1].value = maxVal;
        progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";

        refreshSearch()
        getData(limit, start, requestData);
      }
    }
  });
});

rangeInput.forEach(input => {
  input.addEventListener("input", e =>{
    
    let minVal = parseInt(rangeInput[0].value),
    maxVal = parseInt(rangeInput[1].value);

    if(maxVal - minVal < priceGap){
      if(e.target.className === "range-min"){
        rangeInput[0].value = maxVal - priceGap;

      }else{
        rangeInput[1].value = minVal + priceGap;
      }
      
    }else{
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }

    refreshSearch()
    getData(limit, start, requestData);
  });
});
// Панель ЦЕНА закончена


 // поиск
  var limit = 12; // Лимит товаров на странице
  var start = 0; // Стартовый индекс из базы данных

  $('#show-more').click(function() {
    start += limit;
  requestData = '';
  $('.menu-checkbox:checked').each(function() {
    var dataId = $(this).data('id');
    var categoryName = dataId.trim().split('_')[0];
    var categoryId = dataId.split('_')[1];
    requestData += (categoryName + "_" + categoryId + "-");
  });
  getData(requestData, limit, start); // Вызываем функцию для получения товаров из базы данных
  });

  $('#search').on('keyup', function() {
    start = 0; // Сбрасываем стартовый индекс при поиске
    getData(limit, start); // Запускаем функцию получения товаров
  });

  getData(limit, start); // Первоначальная загрузка товаров




      var requestData = "";
      $('.menu-checkbox').change(function(){
       
        if($(this).is(":checked")) {
          var dataId = $(this).data('id');
          var categoryName = dataId.trim().split('_')[0];
          var categoryId = dataId.split('_')[1];
          requestData += (categoryName + "_" + categoryId + "-");
        } else {
          var dataId = $(this).data('id');
          var categoryName = dataId.trim().split('_')[0];
          var categoryId = dataId.split('_')[1];
          var toRemove = categoryName + "_" + categoryId + "-";
          requestData = requestData.replace(toRemove, '');
        }

        refreshSearch()
        getData(requestData, limit, start);
        // отправляем requestData на сервер с помощью Ajax-запроса на PHP
      });


function getData() {
  $.ajax({
    url: './withdrawalOfGoods.php',
    method: 'POST',
    data: {
      request: requestData,
      limit: limit,
      start: start,
      inputMin: rangeInput[0].value,
      inputMax: rangeInput[1].value
    },
    success: function(data) {
      if (start == 0) {
        $('#results').html(data); // Если запрашиваем первый блок товаров, то замещаем текущие результаты
      } else {
        $('#results').append(data); // В обратном случае дополняем список
      }

      if (data.trim() == '<div class="table"><table></table></div>') {
        $('#show-more').hide(); // Если результаты закончились, прячем кнопку
      } else {
        $('#show-more').show(); // В противном случае, показываем кнопку
      }

      // обнуляем счетчик при изменении фильтра
      $('#show-more').data('start', 0);
    }
  });
}
  });
// checkbox