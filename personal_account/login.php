<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sass/login.css">
    <title>ВХОД</title>
</head>
<body>
<div class="container">
    <header class="header">
        <nav class="menu">
            <ul class="wrapper">
              <li class="menu-list-logo"><a href="../index.php" class="menu-link"><img src="../images/logo.png" alt="Logo"></a></li>
              <li class="menu-list"><a href="../common/stocks.html" class="menu-link">Акции</a></li>
              <li class="menu-list"><a href="../goods/catalog.php" class="menu-link">Ассортимент</a></li>
              <li class="menu-list"><a href="../common/individual_order.html" class="menu-link">Индивидуальный заказ</a></li>
              <li class="menu-list"><a href="../common/feedback.html" class="menu-link">Сотрудничество</a></li>
              <li class="menu-list"><a href="../common/contacts.html" class="menu-link">Контакты</a></li>

              <li class="menu-list-accaunt"><a href="../personal_account/index.php" class="menu-link"><img src="../images/Account.png" alt="Logo"></a></li>
              <li class="menu-list-slash">/</li>
              <li class="menu-list-login"><a href="#" class="menu-link"><img src="../images/Login.png" alt="Logo"></a></li>
            </ul>
        </nav>
    </header>

    <section>
        <div class="login-main">
            <h1 class="login-heading">Авторизация</h1>
            <div class="login-form">
                <form method="POST" id="loginForm" onsubmit="return validateForm()">
                    <input type="text" name="email" placeholder="Email"> <br>
                    <input type="password" name="pass" placeholder="Пароль"> <br>
                    <input  class="login-basic-button" type="submit" name="reg" value="Войти"><br>
                </form>
                <a href="registration.php"><p class="RegButton">Регистрация</p></a><br>
            </div>
<?php
  include('../config/main.php');
  session_start();

if(isset($_SESSION['id_user'])){ // проверяем СУЩЕСТВУЕТ ли переменная, а то выводит ошибку
  $id=$_SESSION['id_user'];
}
// echo $_SESSION['id_user'];
if(!empty($_POST['reg']))
{
$email = $_POST['email'];
$pass = md5($_POST['pass']); 
$adminurl='../admin/index.php';

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
        header('Location: index.php'); // вот тут входим в аккаунт
       }else
       header('Location: '.$adminurl); // вот тут входим в админку
      }
    }else{echo "<br>Введите пароль";}
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
        </div>
    </section>

    <!-- <footer class="footer">
        <div class="footer-block-1">
          <img src="images/logo.png" alt="">
          <a class="footer-list" href="#">Список продуктов</a>
          <a class="footer-list" href="#">Вакансии</a>
          <a class="footer-list" href="common/feedback.html">Служба поддержки</a>
          <a class="footer-list" href="common/individual_order.html">Индивидуальный заказ</a>
        </div>
        <div class="footer-block-2">
          <a href="#"><p class="footer-page">Юридическая информация и конфиденциальность</p></a>
        
            <a href="#"><p class="footer-page">Обновления сетевых компонентов</p></a>
            <a href="#"><p class="footer-page">Пользовательское соглашение</p></a>
        
          <a href="#"><p class="footer-page">НОВЫЕ правила соблюдения конфиденциальности информации и идентификации пользователя</p></a><br>
          <span class="footer-page">© 2023 Magic Vision Company</span>
        </div>
      </footer> -->
</div>
</body>
<script src="js/login.js"></script>
</html>