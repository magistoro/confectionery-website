<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sass/good_add_image.css">
    <title>АДМИН ПАНЕЛЬ</title>
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
                  <li class="menu-list-login"><a href="../personal_account/login.php" class="menu-link"><img src="../images/Login.png" alt="Logo"></a></li>
                </ul>
            </nav>
        </header>
        <section>
            <div class="main-block">
              <div class="exit-button"><a href="index.php">Выйти на страницу товаров</a> / <a href="good_upd.php">На страницу редактирования</a></div>
                <h1 class="admin-heading">Добавить изображения продукту №<span id="heding"></span></h1>
                <form method="post" id="NewProductForm" enctype="multipart/form-data"><br>
                    <label for="input-file" class="custom-file-upload">
                    <i class="fa fa-cloud-upload"></i> Добавить фото продукта
                    </label>
                      <input class="sidebar-input" name="images[]" type="file" id="input-file" multiple/><br>
                      <input class="sidebar-input-submit" type="submit" value="Добавить"/> 
                </form>
                <div class="error-message" id="error"></div>

                <?php 
                include('../config/main.php');
                session_start();
                $id_product = $_SESSION['product_id'];
                echo "<script>document.getElementById('heding').textContent = '" . $id_product . "';</script>";

                 // Путь для сохранения загруженных файлов
                 $path = '../goods/images/';
                // Функция для генерации случайного имени файла
                function generateFileName($extension) {
                  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                  $randomString = '';
                  for ($i = 0; $i < 6; $i++) {
                    $randomString .= $characters[rand(0, strlen($characters) - 1)];
                  }
                  return $randomString . '.' . $extension;
                }
                
                // Обработка отправленной формы
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  // Проверяем, были ли переданы файлы
                  if (isset($_FILES['images'])) {
                    // Проходим по каждому файлу
                    foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                      // Получаем имя и расширение файла
                      $fileName = $_FILES['images']['name'][$key];
                      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                
                      // Проверяем тип файла
                      if ($fileExtension === 'png' || $fileExtension === 'jpeg' || $fileExtension === 'jpg') {
                        // Генерируем новое имя файла
                        $newFileName = generateFileName($fileExtension);
                
                        // Перемещаем файл в заданную папку
                        move_uploaded_file($tmpName, $path . $newFileName);
                
                        // Добавляем информацию о файле в базу данных
                        $mysql->query("INSERT INTO `product-image` (`ID_product`, `image`) VALUES ('$id_product', '$newFileName')") or die (mysqli_error($link));
                        echo "<script>document.getElementById('error').textContent = 'Успешно';</script>";
                      } else {
                        echo "<script>document.getElementById('error').textContent = 'Допустимы только файлы типа PNG или JPEG';</script>";
                      }
                    }
                    header("Location: good_add_image.php");
                    exit();
                  }
                  
                }
                ?>


                <div class="slider">

                <?php 
                $result = $mysql->query("SELECT * FROM `product-image` WHERE ID_product = $id_product") or die (mysqli_error($link));
                while($productInfo = $result->fetch_assoc()){ // цикл вывода всего
                  $idd = $productInfo['ID']; 
                    echo '<img class="slide" src="../goods/images/'.$productInfo['image'].'">';
                }
                if(isset($_POST['selectedImages'])){
                  $_SESSION['selectedImages'] = $_POST['selectedImages'];

                }

                // unset($_SESSION['selectedImages']);
                if(isset($_SESSION['selectedImages'])){
                  $selectedImages = $_SESSION['selectedImages'];
                    $i = 0;           
                    $path_to_folder = "../goods/images/";
                    while ($i < count($selectedImages)) {
                      $element = $selectedImages[$i];
                      
                      $query = "DELETE FROM `product-image` WHERE image = '$element'";
                      $mysql->query($query);

                       // Удаляем картинку товара из папки
                      if(file_exists($path_to_folder . $element)){
                        unlink($path_to_folder . $element);
                      }
                      $i++; // увеличить счетчик на 1
                  }
                  unset($_SESSION['selectedImages']);
                }
                ?>
                 
                </div>
                <div id="deletebutton-container"></div>

            </div>
        </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
<script src="js/good_add_image.js"></script>
</body>
</html>