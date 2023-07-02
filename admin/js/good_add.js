
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


    // Чекбоксы 
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', (event) => {
    const checkboxLabel = event.target.nextElementSibling;
    checkboxLabel.classList.toggle('active');
  });
});
    //

function validateForm() {
    // Получаем все поля формы
    var formInputs = document.forms["NewProductForm"].querySelectorAll('input,textarea:not(#withoutverification, #js-AddressField)');
  
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
    } else{
        getValue();
    }
    
    return isValid;
  }



  function getValue() {
    var inputName = document.querySelector('input[name="name"]').value;
    var inputPrice = document.querySelector('input[name="price"]').value;
    var inputWeight = document.querySelector('input[name="weight"]').value;
    var inputstock_balance = document.querySelector('input[name="stock_balance"]').value;
    var textareaDesc = document.querySelector('textarea[name="desc"]').value;
    var textareaRecipe = document.querySelector('textarea[name="recipe"]').value;

    var selectElement_1 = document.getElementById("list-1");
    var selectElement_2 = document.getElementById("list-2");

    // начало
    var checkboxes = document.querySelectorAll('.menu-checkbox:checked');
    
    // Создаем массив для хранения значений data-id всех отмеченных checkbox
    var checkedValues = [];

    // Проходимся по всем отмеченным checkbox и добавляем значения data-id в массив
    checkboxes.forEach(function(checkbox) {
        var dataId = checkbox.getAttribute('data-id');
        // Убираем "filling_" из dataId
        dataId = dataId.replace('filling_', '');
        checkedValues.push(dataId);
      });
      
      // Преобразуем массив в строку с разделителем "_"
      var dataIds = checkedValues.join('_');


    $.ajax({
        type: 'POST',
        url: 'good_add.php',
        data: {
          category: selectElement_1.value,
          size: selectElement_2.value, 

          inputName:inputName,
          inputPrice:inputPrice,
          inputWeight:inputWeight,
          balance:inputstock_balance,
          textareaDesc:textareaDesc,
          textareaRecipe:textareaRecipe,
          
          dataIds:dataIds
        },
        success: function(response) {
          // Обработка успешного ответа от сервера
          window.location.href = 'good_add_image.php';
        },
        error: function(xhr, status, error) {
          // Обработка ошибки
          console.log(status);
        }
      });
  }
  