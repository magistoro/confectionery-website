<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>PROTOTYPE</title>
</head>
<body>
  <h1>Список продуктов</h1>

  <div class="pushmenuu">
    <div id="nav-icon3" class="pushmenu">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
 



  <a class="RegButton" href="index.php">На главную</a>

<?php 
  include('config\main.php');
  session_start(); // итак, это начало долгого пути

  if(isset($_SESSION['id_user'])){ // если существует айди
    $id = $_SESSION['id_user']; // чисто для себя вывел айди, а также кнопки войти\рег не показываются если пользователь вошёл, а показывается его лк и корзина
    echo '<br>
    <a class="AccButton" href="lk/Account.php">Личный кабинет</a>
    <a class="BaskButton" href="lk/Basket.php">Корзина</a>
    <p class="ID">Айди клиента: ', $id, '</p>';
  } else{
    echo '<a class="RegButton" href="reg.php">Регистрация</a>
    <a class="AvtorizButton" href="avtoriz.php">Вход</a>
    <p class="Allgoods">Список всех товаров</p>';
  }

  if(isset($_POST['id_good']) && isset($_SESSION['id_user'])){ // и вот тут у нас есть айдти товара который положили в корзину, что же дальше?
    // echo $_POST['id_good'];
    $result = $mysql->query("SELECT * FROM `basket` WHERE `ID_product` = '$_POST[id_good]' and `ID_user` = '$_SESSION[id_user]' "); // проверяем есть ли такой товар у нашего пользователя
    $good = $result->fetch_assoc();
    if(count((array)$good) == 0){ // если нет создаём новую запись
      $mysql->query("INSERT INTO `basket`(`ID_user`,`ID_product`,`quantity`) VALUES ('$_SESSION[id_user]', '$_POST[id_good]', '1')") or die (mysqli_error($link));
    } 
    else{ // если есть прибавляем количеству + 1
      $good_count = $good['quantity'];
      $good_count++;
      $mysql->query("UPDATE `basket` SET `quantity` = ('$good_count') WHERE `ID_product` = '$_POST[id_good]' and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link));
    }
  } // PROFIT
  else if(!isset($_SESSION['id_user'])){
    echo "<script>alert('Чтобы положить товар в корзину необходимо зарегитрироватся')</script>";
  }
 

  $result = $mysql->query( // не выводит объекты без картинки
  "SELECT p.*, pi.image 
  FROM products p 
  LEFT JOIN `product-image` pi ON p.ID = pi.ID_product
  WHERE pi.id = (SELECT MIN(id)
  FROM `product-image`
  WHERE id_product = p.ID)

  "); // получаем всё
  echo '<div class="table">';  
  echo '<table>'; // делаем таблицу
    $column = 0; // объявляем переменную столбцов

    while($productInfo = $result->fetch_assoc()){ // цикл вывода всего
      $idd = $productInfo['ID']; // просто переменная для удобства, ОЧЕНЬ ВАЖНАЯ

      if($column != 3){ // если хотите 2 слобца просто измените цифру, ну и css немного 
        echo '<td>', 
        $productInfo['name'],'<br>','Цена: ', $productInfo['price'],
        '<br><img class="ProfilIcon" src="images/'.$productInfo['image'].'" width="100" height="100"> <br>

    <form enctype="multipart/form-data" method="post" action="left-menu/index.php">                   <!--  Форма -->
    <input type="hidden" name="good_id" value=" ',$idd,' "> </input>
    <input type="submit" value="Открыть страницу товара" </input> 
    </form>

    <form enctype="multipart/form-data" method="post"   >
    <input type="hidden" name="scroll" />            <!--  Эта переменная чтоб не скролилось -->
    <input type="hidden" name="id_good" value=" ',$idd,' " />           <!--  Эта переменная чтоб передать айди -->
    <input type="submit" name="send" value="Добавить в корзину" />      <!--  Кнопка -->
    </form>
    </td></div>';
    $column++; // да уж, и почему у меня было ощущение что это должно было быть проще...
      }else{
        $column = 1;
        echo '</table>'; // закрываем старую
        echo '<table>'; // открываем новую и выводим товар
        echo '<td>
        Название: ', $productInfo['name'],'<br>','Цена: ', $productInfo['price'],
        '<br><img class="ProfilIcon" src="images/'.$productInfo['image'].'" width="100" height="100"> <br>

    <form enctype="multipart/form-data" method="post" action="left-menu/index.php">                   
    <input type="hidden" name="good_id" value=" ',$idd,' "> </input>
    <input type="submit" value="Открыть страницу товара" </input> 
    </form>
    
    <form enctype="multipart/form-data" method="post" >
    <input type="hidden" name="scroll" />                <!--  Эта переменная чтоб не скролилось -->
    <input type="hidden" name="id_good" value=" ',$idd,' " />               <!--  Эта переменная чтоб передать айди -->
    <input type="submit" name="send" value="Добавить в корзину" " />        <!--  Кнопка -->
    </form>
    </td>';
      }
    } // вывод закончен
    echo '</div>';
?>


<nav class="sidebar">
    <div class="text d-flex p-2">
      <h4>ВАША КОРЗИНА</h4>
      <div id="nav-icon3" class="pushmenu opened">
        <span></span>
      </div>	
    </div>
    <div class="menu-main-menu-container">
      <ul id="menu-main-menu">
        
      
        <?php 

          
if(isset($_SESSION['id_user'])){ // если существует айди


if(!empty($_POST['id_goodd'])){ // удаляем товар полностью
$mysql->query("DELETE FROM `basket`  WHERE `ID_product` = '$_POST[id_goodd]' and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link));
$_POST['id_goodd'] = '';
}


if(!empty($_POST['goodAdd'])){ // прибавление товара
$result = $mysql->query("SELECT * FROM `basket` WHERE `ID_product`= '$_POST[goodAdd]' and `ID_user` = $_SESSION[id_user] ");
$good = $result->fetch_assoc();
$good['quantity'] = $good['quantity'] + 1;
$mysql->query("UPDATE `basket` SET `quantity` = ('$good[quantity]') WHERE `ID_product` = '$_POST[goodAdd]' and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link)); 

}

if(!empty($_POST['goodDell'])){ // вычитание товара
$result = $mysql->query("SELECT * FROM `basket` WHERE `ID_product`= '$_POST[goodDell]' and `ID_user` = $_SESSION[id_user] ");
$good = $result->fetch_assoc();
if($good['quantity'] > 1){
$good['quantity'] = $good['quantity'] - 1;
$mysql->query("UPDATE `basket` SET `quantity` = ('$good[quantity]') WHERE `ID_product` = '$_POST[goodDell]' and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link));

} else{
$mysql->query("DELETE FROM `basket`  WHERE `ID_product` = '$_POST[goodDell]' and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link));
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

    echo '<li  class="current-menu-itemm"><br>
    Название: ', $productInfo_2['name'],'<br>','Цена за штуку: ', $productInfo_2['price'], '<br>
    <img class="ProfilIcon" src="images/'.$productInfo_2['image'].'" width="100" height="100"> <br>

<div class="product-buttons">
<form enctype="multipart/form-data" method="post">                   <!--  Плюс -->

<input type="hidden" name="scroll" />
<input type="hidden" name="goodAdd" value=" ',$iddd,' "> </input>
<input type="submit" value="+" </input> 
</form>

', $productInfoo['quantity'],'                                <!--  Колличество-->
<form enctype="multipart/form-data" method="post">                   <!--  Минус-->

<input type="hidden" name="scroll" />
<input type="hidden" name="goodDell" value=" ',$iddd,' "> </input>
<input type="submit" value="-" </input> 
</form>

<form enctype="multipart/form-data" method="post">

<input type="hidden" name="scroll" />
<input type="hidden" name="id_goodd" value=" ',$iddd,' " />
<input type="submit" value="Удалить" /> 
</form>
', $productInfoo['quantity']*$productInfo_2['price'],'     
</div>
</li>'; // выводим
$totalCost += $productInfo_2['price'] * $productInfoo['quantity'];
} 

// echo '<br>Общая стоимость: ', $totalCost; // вывод общей стоимости

// echo '<script>document.getElementById("totalCost").innerHTML = "Общая стоимость '.$totalCost.'";</script>';

// if($loop == 0){ // ни одного товара нет
// echo '<script>document.getElementById("totalCost").innerHTML = "В вашей корзине пусто, странно";</script>';
// }
}

?>
        </li>
      </ul>
    </div>
    <div class="total-menu"> 
      <span>Итого:<br></span>
      <div id="totalCost"></div> 


      <?php 
      echo '<script>document.getElementById("totalCost").innerHTML = "Общая стоимость '.$totalCost.'";</script>';

      if($loop == 0){ // ни одного товара нет
      echo '<script>document.getElementById("totalCost").innerHTML = "В вашей корзине пусто, странно";</script>';
      }
      
      ?>
      <button>Перейти к оформлению</button>
    </div>
  </nav>    
  <div class="hidden-overley"></div>

</body>
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- скрипт -->
    <script src="skript_products.js"></script>


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
</body>
</html>