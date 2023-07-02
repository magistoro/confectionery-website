<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/good_upd.css">
  <title>Админка</title>
</head>
<body>
<h1>Добавление товара</h1>






<?php
  include('..\config\main.php');
  session_start();

  $path='../images/'; // это всё для фоток
  $randomNaz=mt_rand(0, 1000000);
  $types=array('image/gif','image/png','image/jpeg');
  $size = 1024000;

  //проверка на админа
  $id=$_SESSION['id_user'];
  $result = $mysql->query("SELECT * FROM `users` WHERE `id` = '$id'"); // получаем данные пользователя
  $user = $result->fetch_assoc(); // Конвертируем в массив
  //проверка на админа закончена

  // проверка на админа
  if($user['ID_status'] != 5){ 
    $mysql->close();
    header('Location: ../index.php'); // тут выкидываем негодяя
 }


  $result = $mysql->query("SELECT * FROM `products`"); // получаем данные из бд
  $user = $result->fetch_assoc();

 
  if (!empty($_POST['OK'])){
    $name = $_POST['Nazvanie'];
    $price = $_POST['pricee']; 
    $desc = $_POST['desc']; // переменные не пустые

    if ($name != ''){
      if ($price != ''){
        if ($desc != ''){

          if(!empty($_FILES['picture'])){
            if(!in_array($_FILES['picture']['type'], $types)) //для фоток
            die('<br>Запрещённый тип файла. <a href="goods_upd.php">Попробовать другой файл?</a>');
            if($_FILES['picture']['size'] > $size)
            die('<br>Слишком большой размер файла.<a href="goods_upd.php">Попробовать другой файл?</a>');
    
            if(($user['img']) != ''){ //если картинки нет в БД, а её нет, это ж добавление нового
              if(copy($_FILES['picture']['tmp_name'], $path.(str_replace('.','',$_FILES['picture']['name']).$randomNaz.str_replace('/','.',$_FILES['picture']['type']))))
              {
                $loginname=str_replace('.','',$_FILES['picture']['name']).$randomNaz.str_replace('/','.',$_FILES['picture']['type']);
                $mysql->query("INSERT INTO `goods`  (`name`,`description`, `price`, `img`) VALUES ('$name','$desc','$price', '$loginname')")  or die (mysqli_error($link)); // магические действия    
              }
            }
    echo '<br>Товар успешно добален, поздравляю!!!';

        } else {echo 'Загрузите фото';}
      } else{echo 'Введите описание';}
     } else{echo 'Введите стоимость';} 
    }else{echo 'Введите Название';}
  } 
?>

<form enctype="multipart/form-data" method="post"><br>
  Название: <input type="text" name="Nazvanie" value=""> <br>
  Цена: <input type="number" name="pricee" value=""> <br>
  Описание: <textarea class="description" type="text" name="desc"></textarea> <br>
  Картинка: <input name="picture"type="file" /><br>
  <input type="submit" name="OK" value="Принять" /> 
</form>


<a class="RegButton" href="goods_list.php">Выйти на страницу товаров</a>
<a class="RegButton" href="../avtoriz.php">Выйти на странуцу авторизации</a>
<a class="RegButton" href="..\reg.php">Выйти на страницу регистрацию</a><br>
<a class="RegButton" href="..\index.php">Выйти на главную</a>
</body>
</html>