<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sass/order.css">
    
    <title>ОФОРМЕНИЕ ЗАКАЗА</title>
</head>
<body>

<?php  
    session_start();
    include('..\config\main.php');
?>

<div class="container">
		<header class="header">
            <nav class="menu">
                <ul class="wrapper">
                  <li class="menu-list-logo"><a href="../index.php" class="menu-link"><img src="../images/logo.png" alt="Logo"></a></li>
                  <li class="menu-list"><a href="../common/stocks.html" class="menu-link">Акции</a></li>
                  <li class="menu-list"><a href="../goods/catalog.php" class="menu-link">Ассортимент</a></li>
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
            <div class="main-block"> <!-- Главный блок -->     
                <div class="order-input-block">
                    <h1 class="main-heading">Оформление заказа</h1>
                    <?php 
                    if(isset($_SESSION['id_user'])){
                        $result = $mysql->query("SELECT * FROM users WHERE `ID` = '$_SESSION[id_user]' "); // проверяем есть ли такой товар у нашего пользователя
                        $user = $result->fetch_assoc();
                    }else{
                        header("Location: ../goods/");
                    }
                     
                    ?>
                    <form method="POST" id="loginForm" onsubmit="return validateForm()">
                    <div class="order-form-flex">
                        <input type="text" name="name" placeholder="Имя *" value="<?php echo $user['name'] ?>"> <br>
                        <input type="text" name="surname" placeholder="Фамилия" value="<?php echo $user['surname'] ?>" id="withoutverification"> <br>
                    </div>
                    <div class="order-form-flex">
                        <input type="text" name="email" placeholder="Email *" value="<?php echo $user['email'] ?>" disabled="disabled"> <br>
                        <input class="phone-input" type="phone" name="phone" placeholder="Телефон *" value="<?php echo $user['phone'] ?>" id=""> <br>                
                    </div>
                    <div class="order-form-flex">
                        <input class="account-input-address" name="address" id="js-AddressField" placeholder="Адрес" value="<?php echo $user['address'] ?>"> <br>
                        <input class="order-input-date" name="bdate" placeholder="Дата получения заказа" step="3600" onfocus="(this.type='datetime-local')" onblur="if(this.value==''){this.type=''}"><br>
                    </div>
                    <textarea class="comment-area" name="comment" placeholder="Комментарий"></textarea>
                    <h1 class="main-heading">Стоимость заказа</h1>
                    <div class="order-price-block">
                        <div class="order-price-panel">
                            <div class="order-price-block">
                                <p class="order-price-page-1">Сумма скидки</p>
                                <p class="order-price-page-2">0</p>
                            </div>
                            <div class="order-price-block">
                                <p class="order-price-page-3">Итого к оплате</p>
                                <p class="order-price-page-4" id="total_price"></p>
                            </div>
                        </div>

                         <form action=""  method="post"> 
                        
                        <div class="over-button" id="order-price-button-block">
                            <button class="order-price-button" id="order-price-button" name="OK" type="submit" 
                            <?php
                             if(isset($user['ID_status'])){  // проверка на то, что у пользователя подтверждённы аккаунт (почта)
                                if($user['ID_status'] != "1"){
                                   
                             } else  echo "disabled";
                                } else  echo "disabled";
                                ?>
                                >
                            
                                <p class="order-price-button-page">Оформить</p>
                            </button>
                        </div>
                        <span id="confirmation-message" style="opacity: 0;">Чтобы оформить заказ, необходимо подтвердить почту.</span>
                           
                            
                        </form>
                    </div>
                </div><!-- конец главного блока -->



                <div class="product-container">
                    <h1 class="main-heading">Товары в корзине</h1>
                    <div class="menu-main-menu-container">

                        <ul id="menu-main-menu">
                            <?php
                            include('basket_process.php');
                            ?>
                            </li> 
                        </ul>
                    </div>
                </div>

                
              



                   
           
        </section>
    </div>
     <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   
    <!-- <script src="js/catalog.js"></script> -->
 <!-- для адреса -->
  <script src="https://www.ahunter.ru/js/min/ahunter_suggest.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
  
  <script src="js/order.js"></script>





</body>

<script src="js/login.js"></script>

</html>