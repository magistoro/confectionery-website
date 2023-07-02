<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="script.js"></script>
    <title>PROTOTYPE</title>
</head>
<body>
  <h1>Умный поик адреса</h1>
  <div>
    <input id="js-AddressField" placeholder="Введите адрес">  
  </div>

  <div class="pushmenuu">
    <div id="nav-icon3" class="pushmenu">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
 

  <nav class="sidebar">
    <div class="text d-flex p-2">
      <h4>КОРЗИНА</h4>
      <div id="nav-icon3" class="pushmenu opened">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>	
    </div>
    <div class="menu-main-menu-container">
    
    <ul id="menu-main-menu">
     

        <li class="current-menu-item"><a href="#" >Главная</a></li>
        <li class="menu-parent-item"><a href="#">Услуги<i></i></a>
          <ul class="sub-menu">
            <li><a href="#">Какая-то услуга 1</a></li>
            <li><a href="#">Какая-то услуга 2</a></li>
            <li><a href="#">Какая-то услуга 4</a></li>
          </ul>
        </li>
        <li><a href="#">Клиентам</a></li>
        <li><a href="#">Контакты</a></li>
      </ul>
    </div>
  </nav>    
  <div class="hidden-overley"></div>

  <a class="RegButton" href="reg.php">Регистрация</a><br>
  <a class="RegButton" href="avtoriz.php">Авторизация</a><br> 
  <a class="RegButton" href="products.php">К продуктам</a>






</body>















  <script>

    //запускаем модуль подсказок
    AhunterSuggest.Address.Solid( options );
    
  </script>
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- скрипт -->
    <!-- для адреса -->
    <script src="https://www.ahunter.ru/js/min/ahunter_suggest.js"></script>
  <script src="skript.js"></script>
</body>
</html>