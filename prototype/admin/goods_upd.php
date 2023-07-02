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
<h1>Изменение товара</h1>

<?php
  include('..\config\main.php');
  session_start();
  
  //проверка на админа
  $id=$_SESSION['id_user'];
  $result = $mysql->query("SELECT * FROM `users` WHERE `id` = '$id'"); // получаем данные пользователя
  $user = $result->fetch_assoc(); // Конвертируем в массив
   // проверка на админа
  if($user['ID_status'] != 5){ 
    $mysql->close();
    header('Location: ../index.php'); // тут выкидываем негодяя
 }

  if(isset($_POST['id_director'])){ // если существует $_POST['id_director']
    $id = $_POST['id_director'];
    $_SESSION['id_good'] = $id;
  }
  $id_good = $_SESSION['id_good']; // теперь в ссесии
  echo 'Номер товара: ',$id_good, '<br>';

  $path='../images/'; // это всё для фоток
  $randomNaz=mt_rand(0, 1000000);
  $types=array('image/gif','image/png','image/jpeg');
  $size = 1024000;


  $result = $mysql->query("SELECT * FROM `products` WHERE  `id` = '$id_good'"); // получаем данные из бд
  $goods = $result->fetch_assoc();


   
  if (!empty($_POST['OK'])){
    $name = $_POST['Nazvanie'];
    $price = $_POST['pricee']; 
    $desc = $_POST['desc']; // переменные


    if ($name != ''){
      if ($price != ''){
        if ($desc != ''){
    
          if(($goods['img']) == ''){ //если картинки нет в БД то
            
            if(!empty($_FILES['picture'])){ // проверка на загрузку картинки 
              
              if(!in_array($_FILES['picture']['type'], $types)) //
              die('<br>Запрещённый тип файла. <a href="goods_upd.php">Попробовать другой файл?</a>');
              if($_FILES['picture']['size'] > $size)
              die('<br>Слишком большой размер файла.<a href="goods_upd.php">Попробовать другой файл?</a>');

            if(copy($_FILES['picture']['tmp_name'], $path.(str_replace('.','',$_FILES['picture']['name']).$randomNaz.str_replace('/','.',$_FILES['picture']['type']))))
            {
              $loginname=str_replace('.','',$_FILES['picture']['name']).$randomNaz.str_replace('/','.',$_FILES['picture']['type']);
              $mysql->query("UPDATE `goods` SET `img` = ('$loginname') WHERE `goods`.`id` = '$id_good'") or die (mysqli_error($link));
              header("Refresh:0"); // перезагружаем
            }
            else echo 'Что-то пошло не так';
          } else echo 'загрузите картинку'; // проверка на загрузку не пройдена

          } else { //если картинка есть то
            if(!empty($_FILES['picture']['name'])){ // если пользователь хочет новую   / вот тут !!!
            $picture[]=$goods['img'];
            unlink($path.$picture[0]); // удаляем старую 
            if(copy($_FILES['picture']['tmp_name'], $path.(str_replace('.','',$_FILES['picture']['name']).$randomNaz.str_replace('/','.',$_FILES['picture']['type']))))
            { //загружаем новую
              $loginname=str_replace('.','',$_FILES['picture']['name']).$randomNaz.str_replace('/','.',$_FILES['picture']['type']);
              $mysql->query("UPDATE `goods` SET `img` = ('$loginname') WHERE `goods`.`id` = '$id_good'") or die (mysqli_error($link));
            }
          }
        }
        
    $mysql->query("UPDATE `goods` SET `name` = ('$name'),  `description` = ('$desc'), `price` = ('$price') WHERE `goods`.`id` = '$id_good'") or die (mysqli_error($link)); // магические действия
    echo 'Изменение удачно';
    

      } else{echo 'Введите описание';}
     } else{echo 'Введите стоимость';} 
    }else{echo 'Введите Название';}
  } 
?>

<form enctype="multipart/form-data" method="post"><br>
  Название: <input type="text" name="Nazvanie" value="<?=$goods['name']?>"> <br>
  Цена: <input type="number" name="pricee" value="<?=$goods['price']?>"> <br>
  Описание: <textarea class="description" type="text" name="desc"> <?=$goods['description']?></textarea> <br>
  Картинка: <input name="picture"type="file" /><br>
  <input type="submit" name="OK" value="Принять" /> 
</form>


<a class="RegButton" href="goods_list.php">Выйти на страницу товаров</a>
<a class="RegButton" href="../avtoriz.php">Выйти на страницу авторизации</a>
<a class="RegButton" href="..\reg.php">Просто кнопка на регистрацию</a>
</body>
</html>