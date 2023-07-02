<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sass/style.css">
    <title>АДМИН ПАНЕЛЬ</title>
</head>
<body>
<?php
             session_start(); 
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
            <div class="main-block">
                <h1 class="admin-heading">Панель администратора</h1>
                <div class="admin-flex">
                    <div class="sidebar">
                        <form>
                            <input class="sidbar-input" type="text" name="search" id="search" placeholder="Найти товар">
                        </form>
                            <input class="admin_button" type="button" value="Добавить" onclick="location.href='good_add.php'"/>
                            <input class="admin_button" type="button" value="Просмотреть БД" onclick="location.href='viewing_orders.php'"/>
                            <input class="admin_button" type="button" value="Экспортировать БД" onclick="location.href='export/export_BD.php'"/>
                            <input class="admin_button" type="button" value="Запросы"  onClick="toggleMenu('drop-downPanel-type')"/>
                            <img id="drop-downPanel-type-vector" class="sidebar-vector" src="../images/pop-up-vector.png" alt="">
                            <div id="drop-downPanel-type">
                                <ul>
                                    <form method="post">
                                    <li><input type="submit" name="request-1" value="Запрос 1"></li>
                                    <li><input type="submit" name="request-2" value="Запрос 2"></li>
                                    <li><input type="submit" name="request-3" value="Запрос 3"></li>
                                    <li><input type="submit" name="request-4" value="Запрос 4"></li>
                                    <li><input type="submit" name="request-5" value="Запрос 5"></li>
                                    <li><input type="submit" name="request-6" value="Запрос 6"></li>
                                    <li><input type="submit" name="request-7" value="Запрос 7"></li>
                                    <li><input type="submit" name="request-8" value="Запрос 8"></li>
                                    <li><input type="submit" name="request-9" value="Запрос 9"></li>
                                    <li><input type="submit" name="request-10" value="Запрос 10"></li>
                                    </form>
                                </ul>
                            </div>
                    </div>
                    <div class="products">
                        <div id="results"></div>
                        <input type="button" id="show-more" value="Показать больше"></input>
                    </div>
                </div>
            </div>
            <?php
            if(isset($_POST['good_id'])){
            $_SESSION['product_id'] = $_POST['good_id'];

            unset($_POST['good_id']);
            echo "<script> window.location.href = 'good_upd.php';</script>";
            // header('Location:good_upd.php');
            } 
            

            foreach($_POST as $key => $value) { // передаём название запроса в ссессию
                if (strpos($key, 'request-') === 0) {
                  $_SESSION['selected_request'] = $key;
                    echo "<script> window.location.href = 'requests.php';</script>";
                  break;
                }
              }

            ?>
        </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>