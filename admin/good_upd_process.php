<?php
    include('..\config\main.php');
    session_start();

  //проверка на админа
  $id=$_SESSION['id_user'];
  $result = $mysql->query("SELECT * FROM `users` WHERE `id` = '$id'"); // получаем данные пользователя
  $user = $result->fetch_assoc(); // Конвертируем в массив

  // проверка на админа
  if($user['ID_status'] != 5){ 
    $mysql->close();
    header('Location: ../index.php'); // тут выкидываем негодяя
 }

 if (isset($_SESSION['product_id'])){
    $id_product = $_SESSION['product_id'];
    $result = $mysql->query("SELECT * FROM `products` WHERE `id` = '$id_product'"); // Получаем о товаре
    $product = $result->fetch_assoc(); // Конвертируем в массив

    $name = $product['name'];
    $weight = $product['weight'];
    $price = $product['price'];
    $balance = $product['stock_balance'];
    $description = $product['description'];
    $recipe = $product['recipe'];
 }

 
if(isset($_POST['category'])){ // получаем переменные
    // Основные
    $_SESSION['category'] = $_POST['category'];
    $_SESSION['size'] = $_POST['size'];
    $_SESSION['inputName'] = $_POST['inputName'];
    $_SESSION['inputPrice'] = $_POST['inputPrice'];
    $_SESSION['inputWeight'] = $_POST['inputWeight'];
    $_SESSION['balance'] = $_POST['balance'];
    $_SESSION['textareaDesc'] = $_POST['textareaDesc'];
    $_SESSION['textareaRecipe'] = $_POST['textareaRecipe'];

    $_SESSION['dataIds'] = $_POST['dataIds'];
    
}

  $result = $mysql->query("SELECT * FROM `products`"); // получаем данные из бд
  $user = $result->fetch_assoc();

  if (isset($_SESSION['category'])){
    // Создание товара в таблице "products"
    $name = $_SESSION['inputName'];
    $weight = $_SESSION['inputWeight'];
    $price = $_SESSION['inputPrice'];
    $stock_balance = $_SESSION['balance'];
    $description = $_SESSION['textareaDesc'];
    $recipe = $_SESSION['textareaRecipe'];
    $ID_size = $_SESSION['size'];
    $ID_category = $_SESSION['category'];

    $query = "UPDATE products SET name = '$name', weight = '$weight', price = '$price', stock_balance = '$stock_balance', description = '$description', recipe = '$recipe', ID_size = '$ID_size',  ID_category = '$ID_category' 
    WHERE ID = $id_product";
    if(!$result = $mysql->query($query)){
        unset($_SESSION['category']);
        die('Ошибка при добавлении товара: ' . $mysql->error);
    }


    // Добавление записей в таблицу "product-filling"


// Удаление старых записей
$query = "DELETE FROM `product-filling` WHERE ID_product = '$id_product'";
if(!$result = $mysql->query($query)){
    die('Ошибка при удалении начинок: ' . $mysql->error);
}

// Добавление новых записей
if($_SESSION['dataIds'] != "") {
    if(isset($_SESSION['dataIds'])){ // Начинки
        $dataIds = $_SESSION['dataIds'];
        $idsArray = explode('_', $dataIds);
        foreach($idsArray as $id){
            $query = "INSERT INTO `product-filling` (ID_product, ID_filling)
                      VALUES ('$id_product', '$id')";
            if(!$result = $mysql->query($query)){
                unset($_SESSION['category']);
                die('Ошибка при добавлении начинки: ' . $mysql->error);
            }
        }
    }
}
else {
    $query = "INSERT INTO `product-filling` (ID_product, ID_filling)
              VALUES ('$id_product', '1')";
    if(!$result = $mysql->query($query)){
        die('Ошибка при добавлении начинки: ' . $mysql->error);
    }
}

unset($_SESSION['category']);
















    // if($_SESSION['dataIds'] != ""){
    //     if(isset($_SESSION['dataIds'])){ // Начинки
    //     $dataIds = $_SESSION['dataIds'];
    //         $idsArray = explode('_', $dataIds);
    //     foreach($idsArray as $id){
    //         $query = "INSERT INTO `product-filling` (ID_product, ID_filling)
    //                   VALUES ('$productID', '$id')";
    //         if(!$result = $mysql->query($query)){
    //             unset($_SESSION['category']);
    //             die('Ошибка при добавлении начинки: ' . $mysql->error);
    //         }
    //     }
    // }
    //     unset($_SESSION['category']);
    // }else{
    //         $query = "INSERT INTO `product-filling` (ID_product, ID_filling)
    //         VALUES ('$productID', '1')";
    //         if(!$result = $mysql->query($query)){
    //         die('Ошибка при добавлении начинки: ' . $mysql->error);
    //     }
    // unset($_SESSION['category']);
    // }


} 
                        ?>