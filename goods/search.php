<?php
include('../config/main.php');


if(!empty($_POST["referal"])){ //Принимаем данные

    $referal = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["referal"]))));
    $db_referal = $mysql -> query("SELECT * from products WHERE name LIKE '%$referal%' or name LIKE '%$referal%' ") //or баббабб  LIKE '%$referal%'
    
    or die('Ошибка №'.__LINE__.'<br>Обратитесь к администратору сайта пожалуйста, сообщив номер ошибки.');

    while ($row = $db_referal -> fetch_array()) {
        echo "\n<li>" .$row["name"].    
        '<span class="search-span">'.$row["ID"]."</span>".

        "</li> "; 
    }
}

?>