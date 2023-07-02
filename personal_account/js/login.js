function validateForm() {
    // Получаем все поля формы
    var formInputs = document.forms["loginForm"].getElementsByTagName("input");
   
    // Флаг для проверки заполнения всех полей
    var isValid = true;
  
    // Проверяем каждое поле на заполненность
    for (var i = 0; i < formInputs.length; i++) {
      if (formInputs[i].value === "") {
        // Если поле пустое, добавляем красную рамку
        formInputs[i].style.border = "1px solid #FF3300";
        isValid = false;
      } else {
        // Иначе убираем красную рамку
        formInputs[i].style.border = "";
      }
    }
    if (!isValid) {
        var div = document.createElement("error-div");
        div.innerHTML = "Пожалуйста, заполните все поля";
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