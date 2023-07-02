<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/accountstyle.css">
  <title>Document</title>
</head>
<body>
<header>
<h1>Это твой личный кабинет</h1>

<?php
  include('..\config\main.php'); 
  session_start();

  $id=$_SESSION['id_user'];

  $result = $mysql->query("SELECT * FROM `users` WHERE  `id` = '$id'"); // получаем данные из бд
  $user = $result->fetch_assoc(); 


  $current_time = date('H:i:s'); // получаем текущее время в формате ЧЧ:мм:сс и приветствуем пользователя

if ($current_time >= '06:00:00' && $current_time < '12:00:00') {
    echo 'Доброе утро ',  $user['name'];
} elseif ($current_time >= '12:00:00' && $current_time < '18:00:00') {
    echo 'Добрый день ',  $user['name'];
} elseif ($current_time >= '18:00:00' && $current_time < '23:59:59') {
    echo 'Добрый вечер ',  $user['name'];
} else {
    echo 'Доброй ночи ',  $user['name'];
}
?>
  <form method="POST">
    <br>Фамилия:<input type="text" name="surname" value="<?php echo $user['surname']?>" disabled> <br>
    Пол: М:<input type="radio" name="gender" value="1" <?php if($user['gender'] == 1) {  echo 'checked disabled'; }?> disabled/> Ж:<input type="radio" name="gender" value="2" <?php if($user['gender'] == 2){  echo 'checked ';}?> disabled/><br> 
    Дата рождения:<input type="date" name="bdate"  value="<?php echo $user['birthday']?>"disabled> <br>
    Телефон: <input type="phone" name="phone"  value="<?php echo $user['phone']?>"disabled> <br> 
    Адрес: <input type="text" name="address" id="js-AddressField"  value="<?php echo $user['address']?>" disabled> <br>
    Email:*<input type="text" name="email"  value="<?php echo $user['email']?>" disabled> <br>
    <a class=" " href="ChangeData.php">Изменить данные</a><br>
    <input type="submit" name="izmpass" value="Изменить пароль"  /> <br>
  </form>

<?php

  if(!empty($_POST['izmpass']) ) {// меняем пароль
    echo '<br>
  <form enctype="multipart/form-data" method="post"><br>
  Старый пароль:<input type="password" name="lastpass"> <br>
  Новый пароль:<input type="password" name="newpass"> <br>
  <input type="submit" name="Selpass" value="Принять" /> 
  </form>';
  }

  if(!empty($_POST['Selpass'])){ //изменение пароля
    $lastpass = md5($_POST['lastpass']);
    $newpass = md5($_POST['newpass']);
    
    if($lastpass == ($user['password'])){ 
      $mysql->query("UPDATE `users` SET `password` = ('$newpass') WHERE `users`.`id` = '$id'") or die (mysqli_error($link));
      echo 'что-то произошло<br>';
    } else{echo 'старый и новый пароль не совпадают<br>';
  }
}
?>

<a class="RegButton" href="..\avtoriz.php">Выйти</a>
</header>
</body>
</html>