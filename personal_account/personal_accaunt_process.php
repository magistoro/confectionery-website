<?php


if(isset($_SESSION['id_user'])){ // если существует айди
    $id = $_SESSION['id_user'];
  }else{
     header('Location: login.php');
  }

$result = $mysql->query("SELECT * FROM `users` WHERE `id` = '$id'"); // проверка на то что пользователь есть в бд
$user = $result->fetch_assoc(); // Конвертируем в массив
  if($user["ID_status"] == 5){
    header("Location: ../admin");
  }
    $name = $user['name'];
    $surname = $user['surname'];
    $gender = $user['gender'];
    $bdate = $user['birthday'];
    $phone = $user['phone'];
    $pass = md5($user['password']); 
    $email = $user['email'];
    $address = $user['address'];
    $status = $user['ID_status'];
    $hash = $user['hash'];



    if(isset($_POST["UPD"])){ // если была нажата кнопка обновления
      $name = $_POST['name'];
      $surname = $_POST['surname'];
      $gender = $_POST['gender'];
      $bdate = $_POST['bdate'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];

      $mysql->query("UPDATE users SET name = '$name', surname = '$surname', gender = '$gender', birthday = '$bdate', phone = '$phone', address = '$address' WHERE id = '$id'") or die(mysqli_error($link));
    }
    ?>
                                