<!-- 
<?
    include('../config/main.php');
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
    if (($_POST['pass']) != ''){ 
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
?> -->