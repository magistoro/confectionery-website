<?php
  $path='../goods/images/'; // это всё для фоток
  $randomNaz=mt_rand(0, 1000000);
  $types=array('image/gif','image/png','image/jpeg');
  $size = 1024000;

  //проверка на админа
  $id=$_SESSION['id_user'];
  $result = $mysql->query("SELECT * FROM `users` WHERE `id` = '$id'"); // получаем данные пользователя
  $user = $result->fetch_assoc(); // Конвертируем в массив

  // проверка на админа
  if($user['ID_status'] != 5){ 
    $mysql->close();
    header('Location: ../index.php'); // тут выкидываем негодяя
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

    $query = "INSERT INTO products (name, weight, price, stock_balance, description, recipe, ID_size, ID_category)
              VALUES ('$name', '$weight', '$price', '$stock_balance', '$description', '$recipe', '$ID_size', '$ID_category')";
    if(!$result = $mysql->query($query)){
        unset($_SESSION['category']);
        die('Ошибка при добавлении товара: ' . $mysql->error);
    }

    // Получение ID добавленного товара
        $productID = $mysql->insert_id;
        $_SESSION['product_id'] = $productID;

    // Добавление записей в таблицу "product-filling"
    if($_SESSION['dataIds'] != ""){
        if(isset($_SESSION['dataIds'])){ // Начинки
        $dataIds = $_SESSION['dataIds'];
            $idsArray = explode('_', $dataIds);
        foreach($idsArray as $id){
            $query = "INSERT INTO `product-filling` (ID_product, ID_filling)
                      VALUES ('$productID', '$id')";
            if(!$result = $mysql->query($query)){
                unset($_SESSION['category']);
                die('Ошибка при добавлении начинки: ' . $mysql->error);
            }
        }
    }
        unset($_SESSION['category']);
    }else{
            $query = "INSERT INTO `product-filling` (ID_product, ID_filling)
            VALUES ('$productID', '1')";
            if(!$result = $mysql->query($query)){
            die('Ошибка при добавлении начинки: ' . $mysql->error);
        }
    unset($_SESSION['category']);
    }
    } 
?>