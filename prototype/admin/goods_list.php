<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/good_list.css">
  <title>Админка</title>
</head>
<body>
<h1>Список всех товаров</h1>
<a class="EXButton" href="..\index.php">Выйти</a><br>
<a class="ADDButton" href="goods_add.php">Добавить товар</a><br><br>

<?php
  include('..\config\main.php');
  session_start();

  if(!empty($_POST['id_deleter'])){ // если существует 
    $id_del = $_POST['id_deleter'];
    header("Refresh:0");
  }

  $id=$_SESSION['id_user']; // айди пользователя

  //проверка на админа
  $result = $mysql->query("SELECT * FROM `users` WHERE `id` = '$id'"); // получаем данные пользователя
  $user = $result->fetch_assoc(); // Конвертируем в массив
   // проверка на админа
  if($user['ID_status'] != 5){ 
    $mysql->close();
    header('Location: ../index.php'); // тут выкидываем негодяя
 }

    $result = $mysql->query("SELECT p.*, pi.image 
    FROM products p 
    LEFT JOIN `product-image` pi ON p.ID = pi.ID_product;"); // получаем всё
  
    echo '<table >'; // делаем таблицу
    $column = 0; // объявляем переменную столбцов

    while($productInfo = $result->fetch_assoc()){ // цикл вывода всего
      if($column != 2){ // если хотите 3 слобца просто измените цифру, ну и css .... 
        $idd = $productInfo['ID']; // просто переменная для удобства
        echo '<td>
        Название: ', $productInfo['name'],'<br>','Цена: ', $productInfo['price'],
        '<br><img class="ProfilIcon" src="../images/'.$productInfo['image'].'" width="100" height="100"> <br>
    <form enctype="multipart/form-data" method="post" action="goods_upd.php">                   <!--  Кнопки изменить\удалить-->
    <input type="hidden" name="id_director" value=" ',$idd,' "> </input>
    <input type="submit" value="Изменить" </input> 
    </form>
    <form enctype="multipart/form-data" method="post" action="goods_list.php">
    <input type="hidden" name="id_deleter" value=" ',$idd,' " />
    <input type="submit" value="Удалить" /> 
    </form>
    </td>';
    $column++;
      }else{
        $column = 1;
        echo '</table>'; // закрываем старую
        echo '<table>'; // открываем новую и добавляем товар
        echo '<td>
        Название: ', $productInfo['name'],'<br>','Цена: ', $productInfo['price'],
        '<br><img class="ProfilIcon" src="../images/'.$productInfo['image'].'" width="100" height="100"> <br>
    <form enctype="multipart/form-data" method="post" action="goods_upd.php">                   <!--  Кнопки изменить\удалить-->
    <input type="hidden" name="id_director" value=" ',$idd,' "> </input>
    <input type="submit" value="Изменить" </input> 
    </form>
    <form enctype="multipart/form-data" method="post" action="goods_list.php">
    <input type="hidden" name="id_deleter" value=" ',$idd,' " />
    <input type="submit" value="Удалить" /> 
    </form>
    </td>';
      }
    } // вывод закончен
    
    if(isset($id_del) && $id_del !=''){ // удаление
       $mysql->query("DELETE FROM `products` WHERE `ID` = '$id_del'");
       $id_del = ''; // после удаления удаляем айди удаления
    }
?>
</body>
</html>