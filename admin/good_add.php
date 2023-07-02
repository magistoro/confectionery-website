<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sass/good_add.css">
    <title>АДМИН ПАНЕЛЬ</title>
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
              <div class="exit-button"><a href="index.php">Выйти на страницу товаров</a></div>
                <h1 class="admin-heading">Новый продукт</h1>
                <form method="post" id="NewProductForm" ><br>
                    <input  class="sidebar-input" type="text" name="name" placeholder="Название" value=""><br>
                    <div class="inputs-flex">
                      <input class="sidebar-input" type="number" name="weight" placeholder="Вес (гр)" step="10" min="0"><br>
                      <input class="sidebar-input" type="number" name="price" placeholder="Цена (руб)" step="50" min="0"><br>
                      <input class="sidebar-input" type="number" name="stock_balance" placeholder="Остаток на складе (шт)" min="0"><br>
                    </div>
                    <textarea class="description-area" type="text" name="desc" placeholder="Описание"></textarea><br>
                    <textarea class="recipe-area" type="text" name="recipe" placeholder="Рецепт" id="withoutverification"></textarea>
                    <div>
                  </form>

                      <!-- Выпадающие меню -->
                      <div class="request__input-block">
                        <div>
                        <label class="input-select-label">Категория товара:</label>
                        <select name="list" id="list-1" class="request__input">
                        <?php
                        include('..\config\main.php');
                        session_start();
                        $sqll = "SELECT * FROM `product_category`";
                        $res1 = $mysql->query($sqll);
                        if ($res1->num_rows > 0) {
                        // Вывод результатов в виде опций
                        while($row = $res1->fetch_assoc()) {
                          echo" Товар 1";
                        echo "<option value='" . $row['ID'] . "'>" . $row['name'] . "</option>";
                        }
                        } else {
                        echo "0 results";
                        }
                        ?>
                        </select><br>
                      </div>
                        <!--  -->
                        <div>
                        <label class="input-select-label">Размер товара:</label>
                        <select name="list" id="list-2" class="request__input">
                        <?php
                        $sqll = "SELECT * FROM `product_size`";
                        $res1 = $mysql->query($sqll);
                        if ($res1->num_rows > 0) {
                            while($row = $res1->fetch_assoc()) {
                            echo" Товар 1";
                            echo "<option value='" . $row['ID'] . "'>" . $row['name'] . "</option>";
                            }
                          } 
                        ?>
                        </select><br>
                      </div>
                    </div>
                      <!--  -->
                      <div class="sidebar-block" onClick="toggleMenu('drop-downPanel-filling')">
                        <h1 class="sidebar-heading">Категории начинки</h1>
                        <img id="drop-downPanel-filling-vector" class="sidebar-vector" src="../images/pop-up-vector.png" alt="">
                      </div>
                    <div id="drop-downPanel-filling">
                        <ul>
                        <?php
                          $category_result = $mysql->query("SELECT * FROM filling WHERE ID NOT IN (SELECT MIN(ID) FROM filling);"); // получаем всё        
                          while($productInfo = $category_result->fetch_assoc()){ // цикл вывода всего
                            echo '<li><div class="checkbox-container"><input class="menu-checkbox" type="checkbox"  data-id=filling_'.$productInfo["ID"].' id="myCheckbox'.$productInfo["ID"].'"><label for="myCheckbox'.$productInfo["ID"].'"></label>
                            <span class="checkmark"></span></div>
                            <p class="menu-name">'.$productInfo['name'].'</p></li>';
                            } // вывод закончен
                            ?>
                        </ul>
                    </div>
                      <!--  -->

                      <input class="sidebar-input-submit"  name="OK" value="Создать" onclick="validateForm()"/> 
                      <!-- type="submit" -->
                    </div>
                    
                <?php  include('good_add_process.php');  ?>

            </div>
        </section>

       


</div>
<script src="https://www.ahunter.ru/js/min/ahunter_suggest.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
<script src="js/good_add.js"></script>
</body>
</html>