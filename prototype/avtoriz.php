<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/avtorizz.css">
  <title>Авторизация</title>
</head>
<body>
<h1>Давай авторизируемся!</h1>
<form method="POST">
    e-mail:<input class="input" type="text" name="email"> <br>
    Пароль:<input type="password" name="pass"> <br>
   <input type="submit" name="reg" value="Войти"><br>
   <input type="submit" name="AVT" value="Авторизироватся как последний пользователь"><br>
   <input type="submit" name="DelSess" value="Удалить данные о сохранениях">
</form>
<a class="RegButton" href="reg.php">Зарегистрироваться</a><br>
<a class="RegButton" href="index.php">На главную</a>


<?php
  include('config\main.php');
  session_start();

  if(isset($_SESSION['id_user'])){ // проверяем СУЩЕСТВУЕТ ли переменная, а то выводит ошибку
    $id=$_SESSION['id_user'];
  }
  
  if(!empty($_POST['reg']))
  {
  $email = $_POST['email'];
  $pass = md5($_POST['pass']); 
  $adminurl='admin/index.php';

    if ($email != ''){
    if (($_POST['pass']) != ''){ //пофикшено 
        $result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$pass'");
        $user = $result->fetch_assoc(); // Конвертируем в массив
        if(count((array)$user) == 0){ //если пользователя нет в БД
          echo "<br>Никак не могу найти тебя $email, возможно неправильный email или пароль(((";
          echo "<br>Но ты всегда можешь зарегистрироваться!";
          exit();
          }else{ //если пользователь есть в бд

          $_SESSION['id_user'] = $user['ID']; //передаём id в сессию
          if($user['ID_status'] != 5){ //проверка на админа условие
          $mysql->close();
          header('Location: lk/Account.php'); // вот тут входим в аккаунт
         }else
         header('Location: '.$adminurl); // вот тут входим в админку
        }
      }else{echo "<br>Введи пароль";}
    }else{echo "<br>Введи e-mail";}
    }

    if(!empty($_POST['AVT'])) //входим в существующюю сессию
  {
    if(isset($id) and $id != ''){ //существует и не пустая, не знаю зачем второе условие, но лишним не будет
      $result = $mysql->query("SELECT * FROM `users` WHERE `id` = '$id' ");
      $user = $result->fetch_assoc();
      $ISAdmin[]=$user['IsAdmin'];
          if($ISAdmin[0] == 0){ //проверка на админа условие
          $mysql->close();
          header('Location: lk/Account.php'); // вот тут входим в аккаунт
         }else
         header('Location: admin/index.php'); // вот тут входим в админку
    } else {echo '<br>Никто ещё не входил сюда';}
  }
  if(!empty($_POST['DelSess']))
  {
    session_destroy();
  }

?>
</body>
</html>