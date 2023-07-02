 <?php 

// Подключение к базе данных
include('..\config\main.php');

  if(isset($_SESSION['id_user'])){ // если существует айди
    $id = $_SESSION['id_user']; // чисто для себя вывел айди
  }

  
// получаем id категории, которую выбрали в checkbox

  $sql=""; // начальная часть условия

  if (isset($_POST['inputMin']) and isset($_POST['inputMax'])){
    $inputMin = $_POST['inputMin'];
    $inputMax = $_POST['inputMax'];

     if (!isset($_POST['request'])) {
    $sql .= " WHERE  p.price >= $inputMin AND p.price <= $inputMax  ";
  }   
  }

if (isset($_POST['request'])){

  $request = $_POST['request']; // получаем переменную

  parse_str(str_replace('-', '&', $request), $vars);
  extract($vars);

   $uniqueCategories = array();
   foreach ($vars as $key => $value) {
     $category = explode("_", $key)[0];
     $category = "ID_" . $category;
     if (!in_array($category, $uniqueCategories)) {
       $uniqueCategories[] = $category;
     }
   }


   $whereClauses = array();
   foreach ($uniqueCategories as $category) {
     $values = array();
     foreach ($vars as $key => $value) {
       $keyCategory = explode("_", $key)[0];
       $keyCategory = "ID_" . $keyCategory;
       if ($category === $keyCategory) {
         $value = explode('_', $key);
         $values[] = "'$value[1]'";
       }
     }
     $valueCount = count($values);
     if ($valueCount === 1) {
       $whereClauses[] = $category . " = " . $values[0];
     } else if ($valueCount > 1) {
       $whereClauses[] = "(" . implode(" OR ", array_map(function($value) use ($category) {
         return $category . " = " . $value;
       }, $values)) . ")";
     }
   }
   
   $sql = "";
   if (count($whereClauses) > 0) {
     $sql .= " WHERE ";
     if (count($whereClauses) === 1) {
       $sql .= $whereClauses[0];
     } else {
       $sql .= "(" . implode(" AND ", $whereClauses) . ")";
     }
   }
   
   // Замените все вхождения "category" на "ID_category" и все вхождения "size" на "ID_size"
   $sql = str_replace("ID_filling", "pf.`ID_filling`", $sql);

   $sql .= " AND price >= $inputMin AND price <= $inputMax";

  //  echo "<br><br>".$sql;
}



//  формируем запрос в базу данных для получения товаров выбранной категории 
 // работающий код

  if (isset($_POST['limit'])) {
    $limit = $_POST['limit'];
    $start = $_POST['start'];
  

  $result = $mysql->query( // не выводит объекты без картинки
  "SELECT p.*, MIN(pi.image) AS image 
  FROM products p 
  LEFT JOIN `product-image` pi ON p.ID = pi.ID_product
  INNER JOIN `product-filling` pf ON pf.ID_product = p.ID 
  
  ".$sql."

  GROUP BY p.ID 
  ORDER BY name ASC 
  LIMIT " . $start . ", " . $limit); // получаем всё


  $totalRows = mysqli_num_rows($mysql->query( // не выводит объекты без картинки
    "SELECT p.*, MIN(pi.image) AS image 
    FROM products p 
    LEFT JOIN `product-image` pi ON p.ID = pi.ID_product
    INNER JOIN `product-filling` pf ON pf.ID_product = p.ID 
    
    ".$sql."
  
    GROUP BY p.ID 
    ORDER BY name ASC"));
  
  // Получаем нужное склонение в зависимости от количества строк
  $ending = '';
  if ($totalRows % 10 == 1 && $totalRows % 100 != 11) {
    $ending = ' товар';
  } elseif ($totalRows % 10 >= 2 && $totalRows % 10 <= 4 && ($totalRows % 100 < 10 || $totalRows % 100 >= 20)) {
    $ending = ' товара';
  } else {
    $ending = ' товаров';
  }
  $message = $totalRows . $ending;
  echo "<script>document.getElementById('num_rows').textContent = '" . $message . "';</script>";
  
// эта строчка: WHERE name LIKE '%" . $query . "%' or  p.ID LIKE '%" . $query . "%'


  echo '<div class="table">';  
  echo '<table>'; // делаем таблицу
    $column = 0; // объявляем переменную столбцов

    while($productInfo = $result->fetch_assoc()){ // цикл вывода всего
      
      $idd = $productInfo['ID']; // просто переменная для удобства, ОЧЕНЬ ВАЖНАЯ

      if($column != 3){ // если хотите 2 слобца просто измените цифру, ну и css немного 
        echo '<td><div class="good-card">', 
        
        '<br><img class="GoodIcon" src="images/'.$productInfo['image'].'"><br>',


        '<div class="good-card-page-flex">
          <p class="good-card-name">'. $productInfo['name'].'</p>',

          '<p class="good-card-price">₽'. $productInfo['price'].'</p>
        </div>',

        // следующий див нужно убрать
   '<div class="button-flex">

    <form enctype="multipart/form-data" method="post">
      <input type="hidden" name="scroll" />            <!--  Эта переменная чтоб не скролилось -->
      <input type="hidden" name="good_id" value=" ',$idd,' " />           <!--  Эта переменная чтоб передать айди -->
      <input class="good-card-button-basket" type="submit" name="send" value="В корзину" />      <!--  Кнопка -->
    </form>

    <form enctype="multipart/form-data" method="post" action="good.php">                   <!--  Форма -->
      <input type="hidden" name="good_id_page" value=" ',$idd,' "> </input>
      <input class="good-card-button-open" type="submit" value="Открыть товар" </input> 
    </form>

    </div> <!-- вот тут он закрывается-->
    

    </div></td>
    ';
    $column++; // да уж, и почему у меня было ощущение что это должно было быть проще...
      }else{
        $column = 1;
        echo '</table>'; // закрываем старую
        echo '<table>'; // открываем новую и выводим товар
        echo '<td><div class="good-card">',
        '<br><img class="GoodIcon" src="images/'.$productInfo['image'].'"> <br>',

        '<div class="good-card-page-flex">
          <p class="good-card-name">'. $productInfo['name'].'</p>',

          '<p class="good-card-price">₽'. $productInfo['price'].'</p>
        </div>',

 // следующий див нужно убрать
    '<div class="button-flex">
    
    <form enctype="multipart/form-data" method="post" >
      <input type="hidden" name="scroll" />                <!--  Эта переменная чтоб не скролилось -->
      <input type="hidden" name="good_id" value=" ',$idd,' " />               <!--  Эта переменная чтоб передать айди -->
      <input class="good-card-button-basket" type="submit" name="send" value="В корзину" " />        <!--  Кнопка -->
    </form>


    <form enctype="multipart/form-data" method="post" action="good.php">                   <!--  Форма -->
      <input type="hidden" name="good_id_page" value=" ',$idd,' "> </input>
      <input class="good-card-button-open" type="submit" value="Открыть товар" </input> 
    </form>

    </div>

    </div></td>';
      }
    } // вывод закончен
    echo '</table></div>';

  }
  $mysql->close();
?>

