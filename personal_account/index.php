<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sass/index.css">
    <title>Личный кабинет</title>
</head>
<body>
<div class="container">
    <header class="header">
        <nav class="menu">
            <ul class="wrapper">
              <li class="menu-list-logo"><a href="../index.php" class="menu-link"><img src="../images/logo.png" alt="Logo"></a></li>
              <li class="menu-list"><a href="../common/stocks.html" class="menu-link">Акции</a></li>
              <li class="menu-list"><a href="../goods/catalog.php" class="menu-link">Ассортимент</a></li>
              <li class="menu-list"><a href="../common/individual_order.html" class="menu-link">Индивидуальный заказ</a></li>
              <li class="menu-list"><a href="../common/contacts.html" class="menu-link">Сотрудничество</a></li>
              <li class="menu-list"><a href="../common/contacts.html" class="menu-link">Контакты</a></li>

              <li class="menu-list-accaunt"><a href="../personal_account/index.php" class="menu-link"><img src="../images/Account.png" alt="Logo"></a></li>
              <li class="menu-list-slash">/</li>
              <li class="menu-list-login"><a href="login.php" class="menu-link"><img src="../images/Login.png" alt="Logo"></a></li>
            </ul>
        </nav>
    </header>

    <section>
        <div class="registration-main">

        <?php
    include ('../config/main.php'); // тут мы подключаем файл main.php 
    session_start();
    include ('personal_accaunt_process.php'); // тут мы подключаем файл main.php 
    ?>
        
            <h1 class="registration-heading">Личный кабинет</h1>
            <p class="registration-page">*-поля обязательные для заполнения</p>
            <div id="emailfirst"></div>
            <div id="emailsub"></div>
            <div class="registration-form">
                <form method="POST" id="registrationForm" onsubmit="return validateForm()">
                <div class="registration-form-flex">
                    <input type="text" name="name" placeholder="Имя *" value='<?php echo $name;?>'> <br>
                    <input type="text" name="surname" placeholder="Фамилия" value="<?php echo $surname;?>"> <br>
                </div>
                <div class="registration-form-flex">
                    <input type="phone" class="phone-input" id="withoutverification" name="phone" placeholder="Телефон" value="<?php echo $phone;?>"> <br>
                    <input type="text" name="bdate" value="<?php echo $bdate;?>" onfocus="(this.type='date')" onblur="if(this.value=='<?php echo $bdate;?>' ){this.type='text'}"> <br>
                </div>
                <div class="registration-form-flex">
                    <input type="text" name="email" placeholder="<?php echo $email;?>" disabled="disabled" id="withoutverification"> <br>
                    <input type="password" name="pass" placeholder="******" disabled="disabled" id="withoutverification"> <br>
                </div>
                <div class="registration-form-flex">
                    <input class="account-input-address" type="address" name="address" id="js-AddressField" placeholder="Адрес" value="<?php echo $address;?>"> <br>
                    <div class="registration-radios">
                        М:<input type="radio" id="radio1" name="gender" value="1" <?php if($gender=="1")echo "checked" ?>/> 
                        <label for="radio1" class="radio"></label>
                        Ж:<input type="radio" id="radio2" name="gender" value="2" <?php if($gender=="2")echo "checked" ?>/> 
                        <label for="radio2" class="radio"></label>
                    </div>
                </div>
                <input class="registration-basic-button" type="submit" name="UPD" value="Изменить">
                </form>
                <div class="errorMessage"></div>
                <a href="login.php"><p class="RegButton">Выйти из аккаунта</p></a><br>

            </div>

            <?php
            if(isset($_SESSION['registory'])){
                echo '<script>document.getElementById("emailfirst").innerHTML = "Спасибо за регистрацию, теперь вам доступно добавление товаров в корзину <br>";</script>';
                unset($_SESSION['registory']);
            }
    
            if($status == 1){
                echo '<script>document.getElementById("emailsub").innerHTML = "Чтобы оформлять заказы, подтвердите email. <form method=POST><input class=emailsub-button name=remail  value='." 'Отправить повторно' ".' type=submit></form>";</script>';
            }

            if(isset($_POST['remail']) && $status == 1){

                function pluralForm($number, $one, $few, $many) {
                    $mod10 = $number % 10;
                    $mod100 = $number % 100;
                
                    if ($mod10 === 1 && $mod100 !== 11) {
                        return $one;
                    } elseif ($mod10 >= 2 && $mod10 <= 4 && ($mod100 < 10 || $mod100 >= 20)) {
                        return $few;
                    } else {
                        return $many;
                    }
                }

                if (!isset($_SESSION['last_run']) || time() - $_SESSION['last_run'] > 60) {
                    // Выполняем функцию
                    
                    
                $to = $email; // Адрес получателя
                $subject = 'Подтвердите email'; // Тема письма
                $message =  '<html>
                <head>
                    <title>Подтвердите Email</title>
                    <style>
                        /* Стилизация элементов письма */
                        @import url("https://fonts.googleapis.com/css2?family=Baskervville&display=swap");

                        body {
                            font-family: Arial, sans-serif;
                            background-color: #272624;
                            color: #FFFFFF;
                            padding: 20px;
                        }
                        .container {
                            max-width: 600px;
                            margin: 0 auto;
                            padding: 20px;
                            background-color: #272624;
                            border-radius: 6px;
                        }
                        h1 {
                            font-family: "Baskervville";
                            color: #E8D47F;
                            text-align: center;
                        }
                        p {
                            text-align: center;
                            color:white;
                        }
                        img {
                            display: block;
                            margin: 0 auto;
                        }
                        a { color: inherit; } 
                        .button {
                            display: inline-block;
                            padding: 10px 20px;
                            background-color: #E8D47F;
                            text-decoration: none !important;
                            border-radius: 4px;
                            text-align: center;
                            transition: background-color 0.3s ease;
                            color:white;
                        }
                        .button:hover {
                            background-color: #C8B86F;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h1>SWEET TEMPTATION</h1>
                        <p><img src="https://i.postimg.cc/Gm9vVN6b/logo.png" alt="Логотип"></p>
                        <p>' . $name . ', добро пожаловать в наше кондитерское сообщество!</p>
                        <p>Чтобы подтвердить свой Email, пожалуйста, перейдите по ссылке ниже:</p>
                        <p>
                            <a href="http://localhost/_Practice/personal_account/confirmed.php?hash=' . $hash . '" class="button" style="color: #272624; text-decoration: none;">Подтвердить Email</a>
                        </p>
                        <p>Спасибо!</p>
                    </div>
                </body>
                </html>'; // Текст письма
                $headers = 'From: masking20531@gmail.com' . "\r\n";
                $headers .= 'Reply-To: masking20531@gmail.com' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $headers .= 'X-Mailer: PHP/' . phpversion();

                unset($_POST['remail']);
                
                // Отправка письма
                if (mail($to, $subject, $message, $headers)) {
                    echo '<script>document.getElementById("emailfirst").innerHTML = "Письмо успешно отправлено!";</script>';
                } else {
                    echo 'Ошибка при отправке письма.';
                }
                
                    // Записываем время последнего запуска
                    $_SESSION['last_run'] = time() + 60; // Время последнего запуска плюс 60 секунд (1 минута)
                } else {
                    // Выводим время до следующего возможного запуска
                    $remainingTime = 60 - (time() - $_SESSION['last_run']);

                    $secondsWord = pluralForm($remainingTime, 'секунда', 'секунды', 'секунд');
                   

                    echo '<script>document.getElementById("emailfirst").innerHTML = " Отправить повторно можно запустить через ' . $remainingTime . ' ' . $secondsWord.'<br>";</script>';
                }
            }
?>

        </div>
    </section>
    <section>
        <div class="history-block">
            <div class="sidebar-block" onClick="toggleMenu('drop-downPanel-history')">
                <h1 class="sidebar-heading">История заказов</h1>
                <img id="drop-downPanel-history-vector" class="sidebar-vector" src="../images/pop-up-vector.png" alt="">
            </div>
            <div  id="drop-downPanel-history">
                        <ul> 
                            <!--  -->
                            <?php 
                                $category_result = $mysql->query("SELECT * FROM orders WHERE ID_user = $_SESSION[id_user]"); // получаем всё        
                                while($productInfo = $category_result->fetch_assoc()){ // цикл вывода всего
                                    echo '<li>
                                <div class=basket-card>
                                    <div>
                                        <p class="menu-name">Заказ №'.$productInfo['ID'].'</p>
                                        
                                        <p class="menu-page">Всего '.$productInfo["total_price"].' товаров <br>На сумму '.$productInfo["total_price"].'₽</p>
                                    </div>
                                    <p class="menu-page">'.$productInfo["created_at"].'</p> 

                                    <div class="arrow-2" onClick="toggleMenuProduct('."'"   .$productInfo['ID'].   "'".')">
                                        <div class="arrow-2-top"></div>
                                        <div class="arrow-2-bottom"></div>
                                    </div>

                                </div>
                                <div class=basket-card-products id='.$productInfo['ID'].'></div>
                                    </li>';


                                    $category_result_good = $mysql->query("SELECT * FROM ordered_products
                                    JOIN products ON ordered_products.ID_product = products.ID
                                    WHERE ordered_products.ID_order = $productInfo[ID]"); // получаем всё 
                                    while($productInfo_2 = $category_result_good->fetch_assoc()){ 
                                        echo "<script>
                                        var container = document.getElementById(".$productInfo['ID'].");
                                      
                                        ";
                                         
                                        echo "container.innerHTML += '<div class=\"basket-card-product\"><span class=\"product-name\">Название: </span><span class=\"product-name\">" 
                                        . $productInfo_2['name'] . "</span><br><span class=\"product-name\">Цена: </span><span class=\"product-price\">" 
                                        . $productInfo_2['price'] . "</span><br><span class=\"product-name\">Количество: </span><span class=\"product-quantity\">" 
                                        . $productInfo_2['quantity'] . "</span></div>';";
                                        echo "</script>";
                                        
                                      
                                        }
                                } // вывод закончен
                            ?>


                        </ul>
                </div>
        </div>
    </section>
            </div>
    <script src="https://www.ahunter.ru/js/min/ahunter_suggest.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script src="js/index.js"></script>
</body>
</html>