// маски инпута 
$(".phone-input").mask("+9(999) 999-99-99", {autoclear: false});



function validateForm() {
  // Получаем все поля формы
  var formInputs = document.forms["registrationForm"].querySelectorAll('input:not(#withoutverification, #js-AddressField)');

  // Флаг для проверки заполнения всех полей
  var isValid = true;
  var messageValid = true;
  // Флаг для проверки поля электронной почты
  var emailIsValid = true;
  
  // Проверяем каждое поле на заполненность
  for (var i = 0; i < formInputs.length; i++) {
      if (formInputs[i].value === "") {
          // Если поле пустое, добавляем красную рамку
          formInputs[i].style.border = "1px solid #FF3300";
          isValid = false;
          messageValid = false;

      } else {
          // Иначе убираем красную рамку
          formInputs[i].style.border = "";
      }
  }

  // Проверяем поле с email на наличие знака "@"
  var emailInput = document.getElementById("email");
  if (emailInput && emailInput.value.indexOf("@") === -1) {
      emailInput.style.border = "1px solid #FF3300";
      emailIsValid = false;
      isValid = false;
  }

  // Если есть ошибки, выводим сообщение
  if (!isValid) {
      var message = "";
      if (!emailIsValid && !messageValid) {
          message = "Множетсво ошибок!";
      } else if(!messageValid) {
          message = "Пожалуйста заполните обязательные поля";
      } else {
        message = "Может ты забыл знак @? Важный ингредиент!";
      }
      
      var div = document.createElement("error-div");
      div.innerHTML = message;
      div.style.backgroundColor = "#FF3300";
      div.style.color = "white";
      div.style.padding = "10px";
      div.style.position = "fixed";
      div.style.top = "50%";
      div.style.left = "50%";
      div.style.transform = "translate(-50%, -50%)";
      div.style.borderRadius = "10px";
      document.body.appendChild(div);
      setTimeout(function() {
        document.body.removeChild(div);
      }, 3000);
  }
  
  return isValid;
}


// <!-- выпадающее меню для истории заказов -->
function toggleMenu(id) {
    var menu = document.getElementById(id);
    if (menu.style.display == "block") {
      
      document.getElementById(id+"-vector").style.transform="rotate(0deg) scaleX(-1)"; // меняем значёк
      window.scrollTo({ top: 0, behavior: 'smooth' });
      setTimeout(function() { 
        menu.style.display = "none";
      }, 500);
    }
     else if(menu.style.display = "none"){
     menu.style.display = "block";
     document.getElementById(id+"-vector").style.transform="rotate(180deg) scaleX(-1)";

    // Проматываем сайт до элемента
    document.getElementById(id+"-vector").scrollIntoView({ behavior: 'smooth' });
    } 
   }
    // <!-- выпадающее меню закончено -->



   // <!-- выпадающее меню для заказа -->
   function toggleMenuProduct(id) {
    var menu = document.getElementById(id);
    if (menu.style.display == "flex") {
      
      // document.getElementById(id+"-vector").style.transform="rotate(0deg) scaleX(-1)"; // меняем значёк
     
        menu.style.display = "none";
 
    }
     else if(menu.style.display = "none"){
     menu.style.display = "flex";
     document.getElementById(id+"-vector").style.transform="rotate(180deg) scaleX(-1)";

    // Проматываем сайт до элемента
    document.getElementById(id+"-vector").scrollIntoView({ behavior: 'smooth' });
    } 
   }
    // <!-- выпадающее меню для заказа закончено -->