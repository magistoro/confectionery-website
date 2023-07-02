<?php 
include('..\config\main.php');


// Меню +- для страницы товара
if(isset($_POST['good_id_page'])){
  $_SESSION['good_id'] = $_POST['good_id_page'];
 
}
if(isset($_POST['countOfCard'])){
  $_SESSION['countOfCard'] = 1;
  $_SESSION['countOfCard'] = $_POST['countOfCard'];
} 
//

 //Принимаем данные с поиска 
if(isset($_POST['referal'])){
  $_SESSION['good_id'] = $_POST['referal'];
  header('Location: good.php');
}


if(isset($_POST['good_id']) && isset($_SESSION['id_user'])){ // Прибавление товара по выдвижному меню
    $result = $mysql->query("SELECT * FROM `basket` WHERE `ID_product` = '$_POST[good_id]' and `ID_user` = '$_SESSION[id_user]' "); // проверяем есть ли такой товар у нашего пользователя
    $good = $result->fetch_assoc();
    if(count((array)$good) == 0){ // если нет создаём новую запись
      $mysql->query("INSERT INTO `basket`(`ID_user`,`ID_product`,`quantity`) VALUES ('$_SESSION[id_user]', '$_POST[good_id]', 1)") or die (mysqli_error($link));
    } 
    else{ // если есть прибавляем количеству 
      $good_count = $good['quantity'] + 1;
      $mysql->query("UPDATE `basket` SET `quantity` = ('$good_count') WHERE `ID_product` = '$_POST[good_id]' and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link));
    }
  } // PROFIT
  else if(!isset($_SESSION['id_user'])){
    echo "<script>alert('Чтобы положить товар в корзину необходимо зарегитрироватся')</script>";
  }




  //
  if(isset($_POST['good_id_page_card']) && isset($_SESSION['id_user'])){ // Прибавление товара по основной кнопке на странице товара
    $result = $mysql->query("SELECT * FROM `basket` WHERE `ID_product` = $_POST[good_id_page_card] and `ID_user` = '$_SESSION[id_user]' "); // проверяем есть ли такой товар у нашего пользователя
    $good = $result->fetch_assoc();
    if(count((array)$good) == 0){ // если нет создаём новую запись
      $mysql->query("INSERT INTO `basket`(`ID_user`,`ID_product`,`quantity`) VALUES ('$_SESSION[id_user]', $_POST[good_id_page_card], $_SESSION[countOfCard])") or die (mysqli_error($link));
    } 
    else{ // если есть прибавляем количеству 
      $good_count = $good['quantity'] + 1 * $_SESSION['countOfCard'];
      $mysql->query("UPDATE `basket` SET `quantity` = ('$good_count') WHERE `ID_product` = $_POST[good_id_page_card] and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link));
    }
  }
  else if(!isset($_SESSION['id_user'])){
    echo "<script>alert('Чтобы положить товар в корзину необходимо зарегитрироватся')</script>";
  }
  //


if(isset($_SESSION['id_user'])){ // если существует айди
    $id = $_SESSION['id_user'];



    if(!empty($_POST['id_goodd'])){ // удаляем товар полностью
        $mysql->query("DELETE FROM `basket`  WHERE `ID_product` = '$_POST[id_goodd]' and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link));
        $_POST['id_goodd'] = '';
        }
        
        
        
    if(!empty($_POST['goodDell'])){ // вычитание товара
        $result = $mysql->query("SELECT * FROM `basket` WHERE `ID_product`= '$_POST[goodDell]' and `ID_user` = $_SESSION[id_user] ");
        $good = $result->fetch_assoc();

        if(isset($good['quantity'])){
             if($good['quantity'] > 1){
        $good['quantity'] = $good['quantity'] - 1;
        $mysql->query("UPDATE `basket` SET `quantity` = ('$good[quantity]') WHERE `ID_product` = '$_POST[goodDell]' and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link));
        
        } else{
            $mysql->query("DELETE FROM `basket`  WHERE `ID_product` = '$_POST[goodDell]' and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link));
        }
        }    
    }




//////////////////////////////////////////////////////////////////////


$result = $mysql->query("SELECT * FROM `basket` WHERE `ID_user`= $id");

$loop = 0; // переменная чтобы понять есть ли в корзине товар
$totalCost = 0; // общая стоимость

while($productInfoo = $result->fetch_assoc()){ 
$loop = 1; // хотя бы один товар есть
$iddd = $productInfoo['ID_product']; // просто переменная для удобства

$result_2 = $mysql->query(" SELECT p.*, pi.image 
FROM products p 
LEFT JOIN `product-image` pi ON p.ID = pi.ID_product
WHERE p.ID= $iddd"); // ищем результат из таблицы товаров


$productInfo_2 = $result_2->fetch_assoc();

    echo '
    <div class="left-menu-block">
        <li  class="current-menu-item"><br>

        <img class="left-menu-good-img" src="images/'.$productInfo_2['image'].'" width="100" height="100"> <br>

        <div>

        <p class="left-menu-name">'. $productInfo_2['name'].'</p>',

        '<p class="left-menu-weight">'. $productInfo_2['weight'].' гр. (1 шт)</p>','
            
            

                <div class="left-menu-buttons">
                    <div class="left-menu-buttons-border">
                    <form enctype="multipart/form-data" method="post">                   <!--  Минус-->
                        <input type="hidden" name="scroll" />
                        <input type="hidden" name="goodDell" value=" ',$iddd,' "> </input>

                        <input type="hidden" name="scroll" />                <!--  Эта переменная чтоб не скролилось -->

                        <input class="left-menu-input" type="submit" value="-" /> 
                    </form>

                        <p class="left-menu-price-one">'.  $productInfoo['quantity'].'</p>                            <!--  Колличество-->
                    
                    <form enctype="multipart/form-data" method="post">                   <!--  Плюс -->
                        <input type="hidden" name="scroll" />
                        <input type="hidden" name="good_id" value=" ',$iddd,' "> </input>

                        <input type="hidden" name="scroll" />                <!--  Эта переменная чтоб не скролилось -->
                        
                        <input class="left-menu-input" type="submit" value="+" </input> 
                    </form>
                    </div>
                    
                    <form enctype="multipart/form-data" method="post">
                        <input type="hidden" name="scroll" />
                        <input type="hidden" name="id_goodd" value=" ',$iddd,' " />

                        <input type="hidden" name="scroll" />                <!--  Эта переменная чтоб не скролилось -->

                        <input class="left-menu-input-card" type="submit" value="    "><img  class="left-menu-input-card-img" src="../images/left-menu-basket.png"></input> 
                    </form>
                </div>
                <p class="left-menu-price-all">'.  $productInfoo['quantity']*$productInfo_2['price'].'</p>
        </div>
         </li>
    </div>'; // выводим
    $totalCost += $productInfo_2['price'] * $productInfoo['quantity'];
} 



}



?>