//Готовим опции для модуля подсказок
var options = 
{ 
  //Наше поле, куда пользователи будут вводить почтовые адреса
  id: "js-AddressField",

  //Веб-адрес облачной версии сервиса
  ahunter_url : "https://ahunter.ru/",

  //Не будем показывать предупреждающее сообщение, когда подсказок нет
  empty_msg : "",

  //Будем показывать только 5 топовых подсказок
  limit : 5,
  
  //Не будем показывать подсказки при возврате фокуса в поле ввода
  suggest_on_focus : false,

  //При выборе подсказки будем выводить её в отладочную консоль
  on_fetch : function( Suggestion, Address ) 
  {
    console.log( Suggestion, Address );
  },
  
  //Указываем свой открытый API-токен, чтобы работал on_fetch
  user : "demotoken",
  
  //Будем запрашивать подсказки для адресов Казахстана
  country : "kaz",
  
  //В on_fetch будем получать коды ФИАС для всех полей выбранного адреса
  api_options : { output : "afiasall" }
};

//Запускаем модуль подсказок
AhunterSuggest.Address.Solid( options );






// маски инпута 
$("#phone").mask("+9(999) 999-99-99", {autoclear: false, completed: function(){
  alert("спасибо, что ввели данные, теперь они мои");
    }
  });



  // капча 
  function onSubmit(token) {
    document.getElementById("demo-form").submit();
  }