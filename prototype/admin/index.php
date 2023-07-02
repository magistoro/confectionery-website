<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/avtoriz.css">
  <title>Админка</title>
</head>
<body>
<h1>Добро пожаловать в панель администратора!</h1>
<form method="POST">
    <input type="submit" name="Add" value="Добавить">
    <input type="submit" name="Read" value="Просмотреть">
    <a href="export-bd.php">Экспорт БД</a>
</form>
<a class="RegButton" href="..\index.php">Выход</a>



<?php
  include('..\config\main.php');
  session_start();
  $id=$_SESSION['id_user'];

  //проверка на админа
  $result = $mysql->query("SELECT * FROM `users` WHERE `id` = '$id'"); // получаем данные пользователя
  $user = $result->fetch_assoc(); // Конвертируем в массив
   // проверка на админа
  if($user['ID_status'] != 5){ 
    $mysql->close();
    header('Location: ../index.php'); // тут выкидываем негодяя
 }
 

  if(!empty($_POST['Add'])) // вход на страницу добавления
  {header('Location: goods_add.php');}

  if(!empty($_POST['Read'])) // вход на страницу всего
  {header('Location: goods_list.php');}
 
 // session_destroy();
?>
</body>
</html>