<?php
include('..\config\main.php');

// Проверка есть ли хеш
if ($_GET['hash']) {
    $hash = $_GET['hash'];
    // Получаем id и подтверждено ли Email
    if ($result = mysqli_query($mysql, "SELECT `id`, `ID_status` FROM `users` WHERE `hash`='" . $hash . "'")) {
        while( $row = mysqli_fetch_assoc($result) ) { 
            // Проверяет получаем ли id и Email подтверждён ли 
            if ($row['ID_status'] == 1) {
                // Если всё верно, то делаем подтверждение
                mysqli_query($mysql, "UPDATE `users` SET `ID_status` = 2 WHERE `id`=". $row['id'] );
                echo "Email подтверждён, страница закроется через 5 секунд";
                echo "<script>
                setTimeout(function() {
                    window.close()
                }, 5000);
              </script>";
            } else {
                echo "Что то пошло не так";
            }
        } 
    } else {
        echo "Что то пошло не так";
    }
} else {
    echo "Что то пошло не так";
}