// Объявляем переменную для хранения названий выбранных (нажатых) картинок
var selectedImages = [];

// Получите все картинки в слайдере
var slides = document.getElementsByClassName('slide');

// Обновленный обработчик событий на каждую картинку
for (var i = 0; i < slides.length; i++) {
    slides[i].addEventListener('click', function() {
      var isSelected = this.classList.contains('selected');
      var imageName = this.getAttribute('src').split('/').pop();
      var fileNameParts = imageName.split('.');
      var fileExtension = fileNameParts.pop();
      imageName = fileNameParts.join('.') + '.' + fileExtension;
  
      if (isSelected) {
        // Если выбранная картинка была уже выбрана ранее, убираем ее состояние и удаляем из массива
        this.style.transform = '';
        this.style.outline = '';
        this.classList.remove('selected');
  
        // Удаляем ее название из массива выбранных картинок
        var index = selectedImages.indexOf(imageName);
        if (index > -1) {
          selectedImages.splice(index, 1);
        }
      } else {
        // Если выбранная картинка ранее не была выбрана, обновляем ее состояние и добавляем в массив
        this.style.transform = 'scale(1.1)';
        this.style.outline = '2px solid blue';
        this.classList.add('selected');
  
        // Добавляем ее название в массив выбранных картинок
        selectedImages.push(imageName);
      }
  
      // Обновляем кнопку "Удалить"
      updateDeleteButton();
    });
  }

// Функция для создания и обновления кнопки "Удалить"
function updateDeleteButton() {
    // Проверяем, есть ли уже кнопка "Удалить"
    var deleteButton = document.getElementById('deletebutton');
    if (deleteButton) {
      // Если кнопка уже существует, обновляем ее текст и обработчик событий
      deleteButton.textContent = 'Удалить (' + selectedImages.length + ')';
      deleteButton.removeEventListener('click', Delete);  // Удаляем предыдущий обработчик событий
    } else {
      // Если кнопки нет, создаем новую
      deleteButton = document.createElement('button');
      deleteButton.textContent = 'Удалить (' + selectedImages.length + ')';
      deleteButton.id = 'deletebutton';
      deleteButton.classList.add('delete-button');
      document.getElementById('deletebutton-container').appendChild(deleteButton);
    }
  
    // Добавляем обновленный обработчик событий на кнопку "Удалить"
    deleteButton.addEventListener('click', Delete);
  }


  
  // Функция для удаления выбранных картинок и обновления
  function Delete() {

    // alert("Удалено: " + selectedImages );
    // Выполняете запрос к БД для удаления выбранных картинок
     
    $.ajax({
        url: './good_add_image.php',
        type: 'POST',
        data: { selectedImages: selectedImages },
        success: function(response) {
            location.reload();
        },
        error: function(xhr, status, error) {
          console.log('Произошла ошибка при удалении картинок. Статус: ' + status, error);
        }
      });

  
    // Очищаете массив выбранных картинок
    selectedImages = [];
  
    // Удаляете кнопку "Удалить" и сбрасываете стили для всех картинок
    for (var i = 0; i < slides.length; i++) {
      slides[i].style.transform = '';
      slides[i].style.outline = '';
      slides[i].classList.remove('selected');
    }
  
    // Удаляете кнопку "Удалить"
    var deleteButton = document.getElementById('deletebutton');
    deleteButton.parentNode.removeChild(deleteButton);
  }
  
