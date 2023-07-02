<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sass/catalog.css">
    
    <title>SWEET TEMPTATION</title>
</head>
<body>



<div class="container">
		<header class="header">
            <nav class="menu">
                <ul class="wrapper">
                  <li class="menu-list-logo"><a href="../index.php" class="menu-link"><img src="../images/logo.png" alt="Logo"></a></li>
                  <li class="menu-list"><a href="../common/stocks.html" class="menu-link">Акции</a></li>
                  <li class="menu-list"><a href="#" class="menu-link"><u>Ассортимент</u></a></li>
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

            <input class="search-input" type="text" placeholder="Поиск"  name="referal">
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
              <?php  session_start(); // итак, это начало долгого пути
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
      <a href="../personal_account/order.php" class="total-menu-order-button">Перейти к оформлению</a>
    </div>

  </nav>    
  <div class="hidden-overley"></div> <!-- выдвижное меню конец -->


            <div class="main-block"> <!-- Главный блок -->
                <h1 class="main-heading">Найдено <span id="num_rows"></span></h1>
               
                    <div class="main-block-flex"> 
                        <div class="sidebar">

                         <h1 class="sidebar-heading">Цена</h1>

                        <div class="wrapper-price">
                            <div class="price-input">    
                                <div class="field">
                                    <span>Min</span>
                                    <input type="number" class="input-min" value="<?php  
                                    $sql = "SELECT MAX(price) AS max_price FROM products";
                                    $result = $mysql->query($sql);
                                    
                                    if ($result->num_rows > 0) {
                                      // Обработка результата запроса
                                        $row = $result->fetch_assoc();
                                        $maxPrice = round($row['max_price']);
                                      echo $rounded_number = ceil($maxPrice/30)*10;;
                                    }
                                    ?>"></input>
                                </div>
                                <div class="seperator">-</div>
                                <div class="field">
                                    <span>Max</span>
                                    <input type="number" class="input-max" value="<?php  echo $maxPrice ?>">
                                </div>
                            </div>
                            <div class="slider">
                                <div class="progress"></div>
                            </div>
                            <div class="range-input">
                                <input type="range" class="range-min" min="0" max="<?php  echo $maxPrice+1000 ?>" value="0" step="10">
                                <input type="range" class="range-max" min="0" max="<?php  echo $maxPrice+1000 ?>" value="<?php  echo $maxPrice ?>" step="10">
                            </div>
                        </div>



                
                <div class="sidebar-block" onClick="toggleMenu('drop-downPanel-type')">
                    <h1 class="sidebar-heading">Тип изделия</h1>
                    <img id="drop-downPanel-type-vector" class="sidebar-vector" src="../images/pop-up-vector.png" alt="">
                </div>
                    <div id="drop-downPanel-type">
                        <ul> 
                            <!--  -->
                            <?php 
                                $category_result = $mysql->query("SELECT pc.*, 
                                (SELECT COUNT(*) 
                                    FROM products 
                                    WHERE ID_category = pc.ID
                                ) AS total_product_count 
                            FROM product_category pc"); // получаем всё        
                                while($productInfo = $category_result->fetch_assoc()){ // цикл вывода всего
                                    echo '<li><input class="menu-checkbox" type="checkbox" data-id=category_'.$productInfo["ID"].'><p class="menu-name">'.$productInfo['name'].'</p><p class="menu-page">'.$productInfo["total_product_count"].'</p></li>';
                                } // вывод закончен
                            ?>


                        </ul>
                    </div>
                

                <div class="sidebar-block" onClick="toggleMenu('drop-downPanel-size')">
                    <h1 class="sidebar-heading">Размер</h1>
                    <img id="drop-downPanel-size-vector" class="sidebar-vector" src="../images/pop-up-vector.png" alt="">
                </div>
                    <div id="drop-downPanel-size">
                        <ul>
                            <?php 
                                $category_result = $mysql->query("SELECT pc.*, 
                                (SELECT COUNT(*) 
                                    FROM products 
                                    WHERE ID_size = pc.ID
                                ) AS total_product_count 
                            FROM product_size pc"); // получаем всё        
                                while($productInfo = $category_result->fetch_assoc()){ // цикл вывода всего
                                    echo '<li><input class="menu-checkbox" type="checkbox" data-id=size_'.$productInfo["ID"].'><p class="menu-name">'.$productInfo['name'].'</p><p class="menu-page">'.$productInfo["total_product_count"].'</p></li>';
                                } // вывод закончен
                            ?>
                        </ul>
                    </div>
                   
                <div class="sidebar-block" onClick="toggleMenu('drop-downPanel-filling')">
                    <h1 class="sidebar-heading">Начинка</h1>
                    <img id="drop-downPanel-filling-vector" class="sidebar-vector" src="../images/pop-up-vector.png" alt="">
                </div>
                    <div id="drop-downPanel-filling">
                        <ul>
                        <?php
                            $category_result = $mysql->query("SELECT f.ID AS ID, f.name AS filling, COUNT(pf.ID) AS filling_count
                            FROM filling f
                            INNER JOIN `product-filling` pf
                            ON f.ID = pf.ID_filling
                            GROUP BY f.ID, f.name;
                            "); // получаем всё        
                            while($productInfo = $category_result->fetch_assoc()){ // цикл вывода всего
                                echo '<li><input class="menu-checkbox" type="checkbox"  data-id=filling_'.$productInfo["ID"].'><p class="menu-name">'.$productInfo['filling'].'</p><p class="menu-page">'.$productInfo["filling_count"].'</p></li>';
                                } // вывод закончен
                                ?>
                        </ul>
                    </div>

                </div>
                <!-- Сайд бар закончен -->

                


                    <div class="products">
                       

                        <div id="results"></div>
                        <input type="button" id="show-more" value="Показать больше"></input>


                    </div>   <!-- Вывод товаров закончен -->
               </div>
            </div>
        </section>
</div>
    <!--  -->
   

    <footer class="footer">
      <div class="footer-block-1">
        <img src="../images/logo.png" alt="">
        <a class="footer-list" href="#">Список продуктов</a>
        <a class="footer-list" href="#">Вакансии</a>
        <a class="footer-list" href="common/feedback.html">Служба поддержки</a>
        <a class="footer-list" href="common/individual_order.html">Индивидуальный заказ</a>
      </div>
      <div class="footer-block-2">
        <a href="#"><p class="footer-page">Юридическая информация и конфиденциальность</p></a>
        <!-- <div class="footer-block-2-flex"> -->
          <a href="#"><p class="footer-page">Обновления сетевых компонентов</p></a>
          <a href="#"><p class="footer-page">Пользовательское соглашение</p></a>
        <!-- </div> -->
        <a href="#"><p class="footer-page">НОВЫЕ правила соблюдения конфиденциальности информации и идентификации пользователя</p></a><br>
        <span class="footer-page">© 2023 Magic Vision Company</span>
      </div>
    </footer>

</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/catalog.js"></script>
    <script src="js/search.js"></script>

  <script src="https://www.ahunter.ru/js/min/ahunter_suggest.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
  
  





</body>

<script> 
$(window).on("scroll", function(){ 
  $('input[name="scroll"]').val($(window).scrollTop());
});
<?php  if(!empty($_POST['scroll'])):  ?>
$(document).ready(function(){
  window.scrollTo(0, <?php echo  intval($_REQUEST['scroll']); ?>)
});
<?php endif; ?>
</script>

</html>