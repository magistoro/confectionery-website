<?php

// Подключение к базе данных
include('..\config\main.php');

if (isset($_POST['query'])) {
  $query = $_POST['query'];
  $limit = $_POST['limit'];
  $start = $_POST['start'];
   $result = $mysql->query( 
    "SELECT p.*, MIN(pi.image) AS image 
    FROM products p 
  LEFT JOIN `product-image` pi ON p.ID = pi.ID_product
  WHERE name LIKE '%" . $query . "%' or  p.ID LIKE '%" . $query . "%'
  GROUP BY p.ID 
  ORDER BY name ASC 
  LIMIT " . $start . ", " . $limit);

  


  // if ($result->num_rows > 0) {

  echo '<div class="table">';  
  echo '<table>'; // делаем таблицу
    $column = 0; // объявляем переменную столбцов

    while($row = $result->fetch_assoc()){ // цикл вывода всего
      $idd = $row['ID']; // просто переменная для удобства, ОЧЕНЬ ВАЖНАЯ

      if($column != 3){ // если хотите 2 слобца просто измените цифру, ну и css немного 
        echo '<td><div class="good-card">', 
        
        '<br><img class="GoodIcon" src="../goods/images/'.$row['image'].'"><br>',


        '<div class="good-card-page-flex">
          <p class="good-card-name">'. $row['name'].'</p>

        </div>',

   '<div class="button-flex">

    <form enctype="multipart/form-data" method="post">
      <input type="hidden" name="good_id" value=" ',$idd,' " />           <!--  Эта переменная чтоб передать айди -->
      <input class="good-card-button-basket" type="submit" name="send" value="Изменить" />      <!--  Кнопка -->
    </form>

    <form enctype="multipart/form-data" method="post" action="good.php">                   <!--  Форма -->
      <input type="hidden" name="good_id_page" value=" ',$idd,' "> </input>
      <input class="good-card-button-open" type="submit" value="Удалить" </input> 
    </form>

    </div> <!-- вот тут он закрывается-->
    

    </div></td>
    ';
    $column++;
      }else{
        $column = 1;
        echo '</table>'; // закрываем старую
        echo '<table>'; // открываем новую и выводим товар
        echo '<td><div class="good-card">',
        '<br><img class="GoodIcon" src="../goods/images/'.$row['image'].'"> <br>',

        '<div class="good-card-page-flex">
          <p class="good-card-name">'. $row['name'].'</p>
        </div>',

    '<div class="button-flex">
    
    <form enctype="multipart/form-data" method="post">
      <input type="hidden" name="good_id" value=" ',$idd,' " />               <!--  Эта переменная чтоб передать айди -->
      <input class="good-card-button-basket" type="submit" name="send" value="Изменить" />        <!--  Кнопка -->
    </form>


    <form enctype="multipart/form-data" method="post" action="good.php">                   <!--  Форма -->
      <input type="hidden" name="good_id_page" value=" ',$idd,' "> </input>
      <input class="good-card-button-open" type="submit" value="Удалить" </input> 
    </form>

    </div>

    </div></td>';
      }
    } // вывод закончен
    echo '</table></div>';
  // }
}
$mysql->close();

?>