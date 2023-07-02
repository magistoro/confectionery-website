<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/baskett.css">
  <title>Корзина</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<h1>Это твоя корзина</h1>
<a class="EXButton" href="..\index.php">Выйти</a><br>

<div id="errorMessage" class="errorMessage"></div>

<input type="submit" name="reg" value="Оформить заказ">
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


<?php
  include('..\config\main.php'); 
  session_start();
  if(isset($_SESSION['id_user'])){
    $id=$_SESSION['id_user'];
  }else{
    header('Location: ../index.php');
  }
 
  

  if(!empty($_POST['id_good'])){ // удаляем товар полностью
    $mysql->query("DELETE FROM `basket`  WHERE `ID_product` = '$_POST[id_good]' and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link));
    $_POST['id_good'] = '';
    }
    

 if(!empty($_POST['goodAdd'])){ // прибавление товара
  $result = $mysql->query("SELECT * FROM `basket` WHERE `ID_product`= '$_POST[goodAdd]' and `ID_user` = $_SESSION[id_user] ");
  $good = $result->fetch_assoc();
  $good['quantity'] = $good['quantity'] + 1;
  $mysql->query("UPDATE `basket` SET `quantity` = ('$good[quantity]') WHERE `ID_product` = '$_POST[goodAdd]' and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link)); 
 
 }
// проблема: после перезагрузки кнопка не сбрасывается, а продолжает оставатся нажатой

 if(!empty($_POST['goodDell'])){ // вычитание товара
  $result = $mysql->query("SELECT * FROM `basket` WHERE `ID_product`= '$_POST[goodDell]' and `ID_user` = $_SESSION[id_user] ");
  $good = $result->fetch_assoc();
  if($good['quantity'] > 1){
  $good['quantity'] = $good['quantity'] - 1;
  $mysql->query("UPDATE `basket` SET `quantity` = ('$good[quantity]') WHERE `ID_product` = '$_POST[goodDell]' and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link));
 // sleep(2);
  
  } else{
    $mysql->query("DELETE FROM `basket`  WHERE `ID_product` = '$_POST[goodDell]' and `ID_user` = $_SESSION[id_user]") or die (mysqli_error($link));
  }
 }

 

  $result = $mysql->query("SELECT * FROM `users` WHERE  `id` = '$id'"); // получаем данные из бд
  $user = $result->fetch_assoc(); 

  echo 'Привет  ', $user['name']; // выводим логин

  $result = $mysql->query("SELECT * FROM `basket` WHERE `ID_user`= $id");

  $loop = 0; // переменная чтобы понять есть ли в корзине товар
  $totalCost = 0; // общая стоимость
  
  while($productInfo = $result->fetch_assoc()){ 
    $loop = 1; // хотя бы один товар есть
    $idd = $productInfo['ID_product']; // просто переменная для удобства

    $result_2 = $mysql->query(" SELECT p.*, pi.image 
    FROM products p 
    LEFT JOIN `product-image` pi ON p.ID = pi.ID_product
    WHERE p.ID= $idd"); // ищем результат из таблицы товаров

   

    $productInfo_2 = $result_2->fetch_assoc();

        echo '<td><br>
        Название: ', $productInfo_2['name'],'<br>','Цена: ', $productInfo_2['price'], '<br>
        <img class="ProfilIcon" src="../images/'.$productInfo_2['image'].'" width="100" height="100"> <br>

    <form enctype="multipart/form-data" method="post">                   <!--  Плюс -->

    <input type="hidden" name="scroll" />
    <input type="hidden" name="goodAdd" value=" ',$idd,' "> </input>
    <input type="submit" value="+" </input> 
    </form>

    ', $productInfo['quantity'],'

    <form enctype="multipart/form-data" method="post">                   <!--  Минус-->

    <input type="hidden" name="scroll" />
    <input type="hidden" name="goodDell" value=" ',$idd,' "> </input>
    <input type="submit" value="-" </input> 
    </form>

    <form enctype="multipart/form-data" method="post">

    <input type="hidden" name="scroll" />
    <input type="hidden" name="id_good" value=" ',$idd,' " />
    <input type="submit" value="Удалить" /> 
    </form>
    </td>'; // выводим
    $totalCost += $productInfo_2['price'] * $productInfo['quantity'];
  } 
 
  // echo '<br>Общая стоимость: ', $totalCost; // вывод общей стоимости

  echo '<script>document.getElementById("errorMessage").innerHTML = "Общая стоимость '.$totalCost.'";</script>';

  if($loop == 0){ // ни одного товара нет
    echo '<br>В вашей корзине пусто, странно';
  }
?>

</body>
</html>