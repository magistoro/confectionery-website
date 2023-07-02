<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sass/good.css">
    
    <title>SWEET TEMPTATION</title>
</head>
<body>



<div class="container">
		<header class="header">
            <nav class="menu">
                <ul class="wrapper">
                  <li class="menu-list-logo"><a href="../index.php" class="menu-link"><img src="../images/logo.png" alt="Logo"></a></li>
                  <li class="menu-list"><a href="../common/stocks.html" class="menu-link">Акции</a></li>
                  <li class="menu-list"><a href="catalog.php" class="menu-link">Ассортимент</a></li>
                  <li class="menu-list"><a href="../common/individual_order.html" class="menu-link">Индивидуальный заказ</a></li>
                  <li class="menu-list"><a href="../common/feedback.html" class="menu-link">Сотрудничество</a></li>
                  <li class="menu-list"><a href="../common/contacts.html" class="menu-link">Контакты</a></li>

                  <li class="menu-list-accaunt"><a href="../personal_account/index.php" class="menu-link"><img src="../images/Account.png" alt="Logo"></a></li>
                  <li class="menu-list-slash">/</li>
                  <li class="menu-list-login"><a href="../personal_account/login.php" class="menu-link"><img src="../images/Login.png" alt="Logo"></a></li>
                </ul>
            </nav>
        </header>

        <section>
        <div class="search-bar">
            <div class="search-bar-catalog" onclick="">
                <img class="search-bar-img" src="../images/catalog-vector.png" alt="">
                <p class="search-bar-catalog-page">Каталог</p>
            </div>

            <input class="search-input" type="text" placeholder="Поиск" name="referal">
            <ul class="search_result"></ul>

            <div class="basket-button" id="nav-icon3">
                <img class="basket-img" src="../images/basket.png" alt="">
                <div class="basket-counter">
                    <p id="basket-counter-page" class="basket-counter-page"></p>
                </div>
            </div>
        </div>

       
        </section>

        <section>

        <nav class="left-menu">
            <div class="text d-flex p-2">
                  <h4>КОРЗИНА</h4>
            <div id="nav-icon3" class="pushmenu opened">
      </div>	
    </div>
    <div class="menu-main-menu-container">
        <ul id="menu-main-menu">
               <?php  session_start(); 

                if(isset($_POST['good_id_page'])){
                  $_SESSION['good_id'] = $_POST['good_id_page'];
                  }
                  
            
              include('left-menu.php');
             ?>
        </li> 
        
    <!-- li не трогать!!! -->

        </ul>
    </div>

    <div class="total-menu"> 
      <p class="total-menu-page">Итого:<br></p>
      <div id="totalCost"></div> 

     
      <?php 
      echo '<script>document.getElementById("totalCost").innerHTML = "₽'.$totalCost.'";</script>';

      echo '<script>document.getElementById("basket-counter-page").innerHTML = "'.$totalCost.'";</script>';

      if($loop == 0){ // ни одного товара нет
      echo '<script>document.getElementById("totalCost").innerHTML = "В вашей корзине пусто!";</script>';
      }
      
      ?>
      <a class="total-menu-order-button">Перейти к оформлению</a>
    </div>

  </nav>    
  <div class="hidden-overley"></div> <!-- выдвижное меню конец -->


            <div class="main-block"> <!-- Главный блок -->

            <?php 
          
                        $result_2 = $mysql->query("SELECT * FROM `products` WHERE `ID` = $_SESSION[good_id]"); 
                      
                        $good = $result_2->fetch_assoc();
                        $good_name = $good['name']; 
                        $good_price = $good['price']; 
                        $good_description = $good['description'];
                      ?>

                <h1 class="main-heading"><a href="catalog.php"><span>Ассортимент</span></a> / "<span><?php  echo $good_name; ?></span>"</h1> 
               
                    <div class="main-block-flex"> 
                        <div class="sidebar">
                        <?php 
                              //  echo "Идентификатор товара: ". $_SESSION['good_id'];
                                if(isset($_POST['good_id']) || isset( $_SESSION['good_id'])){ // если существует 'id'
                                  if(isset( $_SESSION['good_id'])){
                              
                                    $id_good =  $_SESSION['good_id'];
                                  } 
                                  if(isset($_POST['good_id'])){
                                    $id_good = $_POST['good_id'];
                              
                                     $_SESSION['good_id'] =  $id_good;
                                  }
                                  // echo 'Идентификатор товара: ', $id_good;
                                } else {
                                  echo 'Тут ничего нет. *Звуки сверчков*';
                                }
                            ?>      
                          <div class="sidebar-slider">
                            
                            <?php 
                              if(isset($_SESSION['good_id'])){ // выводим картинки
                              $sql = "SELECT * FROM `product-image` WHERE ID_product = $_SESSION[good_id]";
                              $result = $mysql->query($sql);
                              if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                echo "<div class='slide'><img id='image' src='images/" . $row['image'] . "' data-id='" . $row['ID'] . "'></div>";
                                  }
                                }
                              }
                            ?>                 
                          </div>
                        </div>
                <!-- Сайд бар закончен -->

                
                

                    <div class="main-image">
                      <img class="main-img" src="" alt="" id="main-img">
                    </div>   <!-- Вывод товаров закончен -->
                    
                    <div class="main-description">

                      <p class="main-description-name"><?php  echo $good_name; ?></p>
                      <p class="main-description-price"><?php echo $good_price; ?>₽</p>
                      <div>
                        <form class="main-description-buttons" enctype="multipart/form-data" method="post">
                          <input type="hidden" name="good_id_page_card" value=" <?php echo $_SESSION['good_id'] ?> " />
                          <input class="main-description-button-card" name="send" type="submit" value="В корзину">
                          
                          <div class="main-description-buttons-block">
                            <p class="main-description-button"  onClick="countOfCard_minus()"  >-</p>
                            <p class="left-menu-price" id="countOfCard">1</p>
                            <p class="main-description-button"  onClick="countOfCard_plus()">+</p>
                          </div>
                          <input class="main-description-button-oneclick" type="submit" value="Купить в 1 клик">
                        </form>

                      </div>

                    <!-- Состав -->

                      <div class="sidebar-block" onClick="toggleMenu('drop-downPanel-type')">
                        <h1 class="main-description-page">Состав</h1>
                        <img id="drop-downPanel-type-vector" class="sidebar-vector" src="../images/pop-up-vector.png" alt="">
                      </div>
                    <div id="drop-downPanel-type">
                        <ul> 
                            <?php 
                                $ingredient_result = $mysql->query("SELECT ingredients.name
                                FROM `product-ingredient`
                                JOIN ingredients 
                                  ON `product-ingredient`.ID_ingredient = `ingredients`.ID
                                WHERE `product-ingredient`.`ID_product` = '$_SESSION[good_id]' "); // получаем всё    

                                while($productInfo_ingredient = $ingredient_result->fetch_assoc()){ // цикл вывода всего
                                  echo '<li><p class="menu-name">'.$productInfo_ingredient['name'].'</p></li>';
                                } // вывод закончен
                            ?>


                        </ul>
                    </div>

                      <p class="main-description-page-2">Описание продукта</p>
                      <p class="main-description-text"><?php echo $good_description ?></p>
                    </div>

                    <div class="overlay"></div>
                    <div class="popup">
                        <img src="" class="popup-img">
                    </div>
               </div>
            </div>
        </section>
</div>
    <!--  -->
   

    <!-- <footer class="footer">
      <div class="footer-block-1">
        <img src="../images/logo.png" alt="">
        <a class="footer-list" href="#">Список продуктов</a>
        <a class="footer-list" href="#">Вакансии</a>
        <a class="footer-list" href="common/feedback.html">Служба поддержки</a>
        <a class="footer-list" href="common/individual_order.html">Индивидуальный заказ</a>
      </div>
      <div class="footer-block-2">
        <a href="#"><p class="footer-page">Юридическая информация и конфиденциальность</p></a>
       
          <a href="#"><p class="footer-page">Обновления сетевых компонентов</p></a>
          <a href="#"><p class="footer-page">Пользовательское соглашение</p></a>
        
        <a href="#"><p class="footer-page">НОВЫЕ правила соблюдения конфиденциальности информации и идентификации пользователя</p></a><br>
        <span class="footer-page">© 2023 Magic Vision Company</span>
      </div>
    </footer> -->

</div>
    
  <script src="https://www.ahunter.ru/js/min/ahunter_suggest.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
  
  <script src="js/good.js"></script>
  <script src="js/catalog.js"></script>
  <script src="js/search.js"></script>





</body>

<script> // это джава и я не понимаю ни строчки, но оно работает (PS. этото код делает так чтобы после нажатия на кнопку и обновлния формы всё не скролилось вверх)  
$(window).on("scroll", function(){ // передаю привет человекам читающим это
  $('input[name="scroll"]').val($(window).scrollTop());
});
<?php  if(!empty($_POST['scroll'])):  ?>
$(document).ready(function(){
  window.scrollTo(0, <?php echo  intval($_REQUEST['scroll']); ?>)
});
<?php endif; ?>
</script>

</html>