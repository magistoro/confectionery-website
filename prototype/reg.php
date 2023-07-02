<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registration.css">
    <title>Document</title>
</head>
<body>
<h1>Давай зарегистрируемся!</h1>
<form method="POST">
    Имя:*<input type="text" name="name"> <br>
    Фамилия:<input type="text" name="surname"> <br>
    Пол: М:<input type="radio" name="gender" value="1" checked/> Ж:<input type="radio" name="gender" value="2"/><br> 
    Дата рождения:<input type="date" name="bdate"> <br>
    Телефон: <input type="phone" name="phone"> <br>
    Адрес: <input type="text" name="address" id="js-AddressField"> <br>
    Email:*<input type="text" name="email"> <br>
    Пароль:*<input type="password" name="pass"> <br>
    <input type="checkbox" name="checkbox" value="value1">*Согласен с политикой обработки персональных данных <br>
    <input type="submit" name="reg" value="Зарегистрироваться">
</form>
<p>*-поля обязательные для заполнения</p>
<a class="RegButton" href="avtoriz.php">Войти</a><br>
<a class="RegButton"  href="index.php">На главную</a>


<?php
    include ('config/main.php'); // тут мы подключаем файл main.php 
    session_start();

    if(!empty($_POST['reg'])) // тут проверяем нажата ли кнопка Регистрации
    {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $bdate = $_POST['bdate'];
    $phone = $_POST['phone'];
    $pass = md5($_POST['pass']); 
    $email = $_POST['email'];
    $address = $_POST['address'];
    $current_time = date('H:i:s'); 
   
    if(isset($_POST['checkbox'])){ 

        if ($name != ''){
            if (strlen($_POST['pass']) > 6){
                if (stristr($email, '@') && strlen($_POST['email']) > 5){
                    if($bdate < $current_time){//
                        $result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'"); // проверка на то что пользователь есть в бд
                        $user = $result->fetch_assoc(); // Конвертируем в массив
                            if(count((array)$user) == 0){ //если нет то регистрируем
                                $mysql->query("INSERT INTO `users`(`name`, `surname`,`password`,`email`, `gender`, `birthday`, `phone`, `address`) VALUES ('$name', '$surname', '$pass', '$email', '$gender', '$bdate', '$phone', '$address')") or die (mysqli_error($link));


                                //подтверждение почты
                                
                                // $hash = md5($name .$email . time());
        
                                // // Переменная $headers нужна для Email заголовка
                                // $headers  = "MIME-Version: 1.0\r\n";
                                // $headers .= "Content-type: text/html; charset=utf-8\r\n";
                                // $headers .= "To: <$email>\r\n";
                                // $headers .= "From: <mail@example.com>\r\n";
                                // // Сообщение для Email
                                // $message = '
                                //         <html>
                                //         <head>
                                //         <title>Подтвердите Email</title>
                                //         </head>
                                //         <body>
                                //         <p>Что бы подтвердить Email, перейдите по <a href="http://example.com/confirmed.php?hash=' . $hash . '">ссылка</a></p>
                                //         </body>
                                //         </html>
                                //         ';

                                //         mail('masking20531@gmail.com', 'My Subject', $message);

                                //          if (mail($email, "Подтвердите Email на сайте", $message, $headers)) {
                                //              // Если да, то выводит сообщение
                                //              echo 'Подтвердите на почте';
                                //          }
                                    
                                    



                                $result = $mysql->query("SELECT * FROM `users` WHERE  `email` = '$email'");
                                $user = $result->fetch_assoc();                    
                                $_SESSION['id_user'] = $user['ID']; //классная строчка
                                header('Location: lk/Account.php'); // вот тут входим в аккаунт
                            } else{
                                echo '<br>Мне жаль, но этот email уже занят, шоколад растаял'; //если есть, то увы
                            }
                        }else{
                            echo '<br>Извините, мы не можем обслуживать людей из будущего!';
                        }
                    } else{
                        echo '<br>Что-то это не похоже на email, может ты забыл знак @? Важный инградиент!';
                        } 
                }else{
                    echo('<br>Нормальный пароль - это пароль минимум из шести символов, как в шоколаде: какао-бобы, масло, сахар, молоко, ванилин, лецитин');
                }
          } else{
                echo('<br>Пользователь без имени - это как шоколад без упаковки. Это все ещё вкусный шоколад, но теряет свою индивидуальность!');
            }
        }else{
            echo('<br>Без обработки персональных данных не сработает');
        }
    }
     
    
?>

</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://www.ahunter.ru/js/min/ahunter_suggest.js"></script>
    <script src="js/registration.js"></script>
</html>