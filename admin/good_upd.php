<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sass/good_upd.css">
    <title>АДМИН ПАНЕЛЬ</title>
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

        <div class="main-block">
        
        <?php  include('good_upd_process.php');  ?>

            <div class="exit-button"><a href="index.php">Выйти на страницу товаров</a><span class="exit-button-span"> / </span><a href="good_add_image.php">На страницу изображений</a></div>
            <h1 class="admin-heading">Редактирование продукта №<span id="id_product"></span></h1>
            <form method="post" id="NewProductForm" ><br>
                <input  class="sidebar-input" type="text" name="name" placeholder="Название" value="<?php echo $name ?>"><br>
                <div class="inputs-flex">
                  <input class="sidebar-input" type="number" name="weight" placeholder="Вес (гр)" step="10" min="0" value="<?php echo $weight ?>"><br>
                  <input class="sidebar-input" type="number" name="price" placeholder="Цена (руб)" step="50" min="0" value="<?php echo $price ?>"><br>
                  <input class="sidebar-input" type="number" name="stock_balance" placeholder="Остаток на складе (шт)" min="0" value="<?php echo $balance ?>"><br>
                </div>
                <textarea class="description-area" type="text" name="desc" placeholder="Описание" id="textarea"><?php echo $description ?></textarea><br>
                <textarea class="recipe-area" type="text" name="recipe" placeholder="Рецепт" id="withoutverification"><?php echo $recipe ?></textarea>
                    <div>
            </form>
                    <!-- Выпадающие меню -->
                    <div class="request__input-block">
                        <div>
                        <label class="input-select-label">Категория товара:</label>
                        <select name="list" id="list-1" class="request__input">
                        
                        <?php
                        $sqll = "SELECT * FROM `product_category`";
                        $res1 = $mysql->query($sqll);
                        if ($res1->num_rows > 0) {
                        // Вывод результатов в виде опций
                        while($row = $res1->fetch_assoc()) {
                            if ($row['ID'] == $product['ID_category']) {
                                echo "<option value='" . $row['ID'] . "'selected>" . $row['name'] . "</option>";
                            } else{
                                echo "<option value='" . $row['ID'] . "'>" . $row['name'] . "</option>";
                            }
                        }
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
                                if ($row['ID'] == $product['ID_size']) {
                                    echo "<option value='" . $row['ID'] . "'selected>" . $row['name'] . "</option>";
                                }else{
                                    echo "<option value='" . $row['ID'] . "'>" . $row['name'] . "</option>";
                                }
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
                            $result = $mysql->query("SELECT * FROM `product-filling` WHERE ID_filling = '".$productInfo["ID"]."' AND ID_product = '".$id_product."'");
                            $isChecked = $result->num_rows > 0 ? 'checked' : '';
                            
                            echo '<li>
                                    <div class="checkbox-container">
                                        <input class="menu-checkbox" type="checkbox" data-id="filling_'.$productInfo["ID"].'" id="myCheckbox'.$productInfo["ID"].'" '.$isChecked.'>
                                        <label for="myCheckbox'.$productInfo["ID"].'"></label>
                                        <span class="checkmark"></span>
                                    </div>
                                    <p class="menu-name">'.$productInfo['name'].'</p>
                                  </li>';
                        }

                        echo "<script>document.getElementById('id_product').textContent = '$id_product';</script>";

                        //   while($productInfo = $category_result->fetch_assoc()){ // цикл вывода всего
                        //     echo '<li><div class="checkbox-container"><input class="menu-checkbox" type="checkbox"  data-id=filling_'.$productInfo["ID"].' id="myCheckbox'.$productInfo["ID"].'"><label for="myCheckbox'.$productInfo["ID"].'"></label>
                        //     <span class="checkmark"></span></div>
                        //     <p class="menu-name">'.$productInfo['name'].'</p></li>';
                        //     } // вывод закончен
                            ?>
                        </ul>
                    </div>
                      <!--  -->
                    <input class="sidebar-input-submit"  name="OK" value="Обновить" onclick="validateForm()"/> 

                    
        </div>
</div>
    <script src="https://www.ahunter.ru/js/min/ahunter_suggest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
    <script src="js/good_upd.js"></script>
    
</body>
</html>