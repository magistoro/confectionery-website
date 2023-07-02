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

    // поиск


$(document).ready(function() {
  var limit = 15; // Лимит товаров на странице
  var start = 0; // Стартовый индекс из базы данных

  $('#show-more').click(function() {
    start += limit;
    getData(limit, start); // Вызываем функцию для получения товаров из базы данных
  });

  $('#search').on('keyup', function() {
    start = 0; // Сбрасываем стартовый индекс при поиске
    getData(limit, start); // Запускаем функцию получения товаров
  });

  getData(limit, start); // Первоначальная загрузка товаров

  function getData(limit, start) {
    var query = $('#search').val(); // Получаем значение из input

    $.ajax({
      url: './fetch.php',
      method: 'POST',
      data: {
        query: query,
        limit: limit,
        start: start
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
      }
    });
  }
});
