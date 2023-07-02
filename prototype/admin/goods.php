<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/avtorizz.css">
  <title>Товар</title>
</head>
<body>
<h1>Карточка товара!</h1>

<a class="RegButton" href="..\index.php">Просто кнопка на главную</a><br>
<div>
<div class="left-menu">

<?php 


?>
</div>




<?php
  include('..\config\main.php');

  session_start();

  if(isset($_POST['good_id']) || isset($_SESSION['id'])){ // если существует 'id'
    if(isset($_SESSION['id'])){
      $id = $_SESSION['id'];
    } 
    if(isset($_POST['good_id'])){
      $id = $_POST['good_id'];
      $_SESSION['id'] =  $id;
    }
    echo 'Идентификатор товара: ',$id;
  } else {
    echo 'Тут ничего нет. *Звуки сверчков*';
  }

  if(isset($_POST['id_good']) && isset($_SESSION['id_user'])){ // и вот тут у нас есть айдти товара который положили в корзину, что же дальше?
    // echo $_POST['id_good'];
    $result = $mysql->query("SELECT * FROM `basket` WHERE `goods_id` = '$_POST[id_good]' and `user_id` = '$_SESSION[id_user]' "); // проверяем есть ли такой товар у нашего пользователя
    $good = $result->fetch_assoc();
    if(count((array)$good) == 0){ // если нет создаём новую запись
      $mysql->query("INSERT INTO `basket`(`user_id`,`goods_id`,`count`) VALUES ('$_SESSION[id_user]', '$_POST[id_good]', '1')") or die (mysqli_error($link));
    } 
    else{ // если есть прибавляем количеству + 1
      $good_count = $good['count'];
      $good_count++;
      $mysql->query("UPDATE `basket` SET `count` = ('$good_count') WHERE `goods_id` = '$_POST[id_good]' and `user_id` = $_SESSION[id_user]") or die (mysqli_error($link));
    }
  }

  $result = $mysql->query("SELECT p.*, pi.image 
  FROM products p 
  LEFT JOIN `product-image` pi ON p.ID = pi.ID_product
  WHERE pi.id = (SELECT MIN(id)
  FROM `product-image`
  WHERE id_product = p.ID)"); // получаем всё
  $productInfo = $result->fetch_assoc();

  echo  
        '<br><img class="ProfilIcon" src="../images/'.$productInfo['image'].'" width="300" height="300"> <br>
        Наименование: ',$productInfo['name'],'<br>','Цена: ', $productInfo['price'],'<br> Описание: ', $productInfo['description'],
        
        '<form enctype="multipart/form-data" method="post"   >
    <input type="hidden" name="scroll" />            <!--  Эта переменная чтоб не скролилось -->
    <input type="hidden" name="id_good" value=" ',$id,' " />           <!--  Эта переменная чтоб передать айди -->
    <input type="submit" name="send" value="Добавить в корзину" />      <!--  Кнопка -->
    </form>';
  
  
?>
</div>
</body>
</html>