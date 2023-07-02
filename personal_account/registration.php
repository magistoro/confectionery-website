<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sass/registration.css">
    <title>Регистрация</title>
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
              <li class="menu-list-login"><a href="login.php" class="menu-link"><img src="../images/Login.png" alt="Logo"></a></li>
            </ul>
        </nav>
    </header>
    <?php session_start(); ?>
    <section>
        <div class="registration-main">
            <h1 class="registration-heading">Регистрация</h1>
            <p class="registration-page">*-поля обязательные для заполнения</p>
            <div class="registration-form">
                <form method="POST" id="registrationForm" onsubmit="return validateForm()">
                <div class="registration-form-flex">
                    <input type="text" name="name" placeholder="Имя *"> <br>
                    <input type="text" name="surname" placeholder="Фамилия" id="withoutverification"> <br>
                </div>
                <div class="registration-form-flex">
                    <input class="phone-input" type="phone" name="phone" placeholder="Телефон" id="withoutverification"> <br>
                    <input type="text" name="bdate" placeholder="Дата рождения" id="withoutverification" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}"><br>
                </div>
                <div class="registration-form-flex">
                    <input type="text" name="email" id="email" placeholder="Email *"> <br>
                    <input type="password" name="pass" placeholder="Пароль *"> <br>
                </div>
                <div class="registration-form-flex">
                    <input class="account-input-address" name="address" id="js-AddressField" placeholder="Адрес"> <br>
                    <div class="registration-radios">
                        М:<input type="radio" id="radio1" name="gender" value="1" checked/> 
                        <label for="radio1" class="radio"></label>
                        Ж:<input type="radio" id="radio2" name="gender" value="2" /> 
                        <label for="radio2" class="radio"></label>
                    </div>
                </div>
                <div class="registration-form-chackbox">
                    <input type="checkbox"  id="checkbox1" name="checkbox" value="value1">
                    <label for="checkbox1" class="checkbox"></label>
                <p>*Согласен с политикой обработки персональных данных</p> <br>
                </div>
                <input class="registration-basic-button" type="submit" name="reg" value="Зарегистрироваться">
                </form>
                <div class="errorMessage"></div>
                <a href="login.php"><p class="RegButton">Уже есть аккаунт</p></a><br>
                
                <?php
    include ('../config/main.php'); // тут мы подключаем файл main.php 
    
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
    $current_time = date('Y-m-d H:i'); 
   
    if(isset($_POST['checkbox'])){ 

        if ($name != ''){
            if (strlen($_POST['pass']) > 6){
                if (stristr($email, '@') && strlen($_POST['email']) > 5){
                    if($bdate < $current_time){//
                        $result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'"); // проверка на то что пользователь есть в бд
                        $user = $result->fetch_assoc(); // Конвертируем в массив
                            if(count((array)$user) == 0){ //если нет то регистрируем
                                $currentDateTime = date('Y-m-d H:i:s');



                              


                                // хешируем хеш, который состоит из логина и времени
                                $hash = md5($_POST['pass'] . time());


                                $mysql->query("INSERT INTO `users`(`name`, `surname`,`password`,`email`, `gender`, `birthday`, `phone`, `address`, `created_at`, `hash`) VALUES ('$name', '$surname', '$pass', '$email', '$gender', '$bdate', '$phone', '$address', '$currentDateTime', '$hash')") or die (mysqli_error($link));


                                $result = $mysql->query("SELECT * FROM `users` WHERE  `email` = '$email'");
                               if($user_2 = $result->fetch_assoc()){

                                  

                                $to = $email; // Адрес получателя
                                $subject = 'Подтвердите email'; // Тема письма
                                $message =  '<html>
                                <head>
                                    <title>Подтвердите Email</title>
                                    <style>
                                        /* Стилизация элементов письма */
                                        @import url("https://fonts.googleapis.com/css2?family=Baskervville&display=swap");

                                        body {
                                            font-family: Arial, sans-serif;
                                            background-color: #272624;
                                            color: #FFFFFF;
                                            padding: 20px;
                                        }
                                        .container {
                                            max-width: 600px;
                                            margin: 0 auto;
                                            padding: 20px;
                                            background-color: #272624;
                                            border-radius: 6px;
                                        }
                                        h1 {
                                            font-family: "Baskervville";
                                            color: #E8D47F;
                                            text-align: center;
                                        }
                                        p {
                                            text-align: center;
                                            color:white;
                                        }
                                        img {
                                            display: block;
                                            margin: 0 auto;
                                        }
                                        a { color: inherit; } 
                                        .button {
                                            display: inline-block;
                                            padding: 10px 20px;
                                            background-color: #E8D47F;
                                            text-decoration: none !important;
                                            border-radius: 4px;
                                            text-align: center;
                                            transition: background-color 0.3s ease;
                                            color:white;
                                        }
                                        .button:hover {
                                            background-color: #C8B86F;
                                        }
                                    </style>
                                </head>
                                <body>
                                    <div class="container">
                                        <h1>SWEET TEMPTATION</h1>
                                        <p><img src="https://i.postimg.cc/Gm9vVN6b/logo.png" alt="Логотип"></p>
                                        <p>' . $name . ', добро пожаловать в наше кондитерское сообщество!</p>
                                        <p>Чтобы подтвердить свой Email, пожалуйста, перейдите по ссылке ниже:</p>
                                        <p>
                                            <a href="http://localhost/_Practice/personal_account/confirmed.php?hash=' . $hash . '" class="button" style="color: #272624; text-decoration: none;">Подтвердить Email</a>
                                        </p>
                                        <p>Спасибо!</p>
                                    </div>
                                </body>
                                </html>'; // Текст письма
                                $headers = 'From: masking20531@gmail.com' . "\r\n";
                                $headers .= 'Reply-To: masking20531@gmail.com' . "\r\n";
                                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                                $headers .= 'X-Mailer: PHP/' . phpversion();
                                
                                // Отправка письма
                                if (mail($to, $subject, $message, $headers)) {
                                    echo 'Письмо успешно отправлено!';
                                } else {
                                    echo 'Ошибка при отправке письма.';
                                }
                        };    
                                
                                
                                

                                $_SESSION['id_user'] = $user_2['ID']; //классная строчка

                                $_SESSION['registory'] = "1"; // создаём переменню первого входа в аккаунт

                                 echo "<script>window.location.href = 'index.php';</script>";

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

            </div>
        </div>

</div>
    <script src="https://www.ahunter.ru/js/min/ahunter_suggest.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script src="js/registration.js"></script>
</body>
</html>