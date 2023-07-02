<!DOCTYPE html>
<html>
<head>
 <title>Confectionery Products</title>
 <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <a href="../products.php">Выйти к продуктам</a> <br>

  <?php 
  include('..\config\main.php');
  session_start();
 if(isset($_SESSION['id_user'])){
  echo $_SESSION['id_user'], '<br>';
 } 

  
  if(isset($_POST['good_id']) || isset($_SESSION['id'])){ // если существует 'id'
    if(isset($_SESSION['id'])){

      $id_good = $_SESSION['id'];
    } 
    if(isset($_POST['good_id'])){
      $id_good = $_POST['good_id'];

      $_SESSION['id'] =  $id_good;
    }
    echo 'Идентификатор товара: ', $id_good;
  } else {
    echo 'Тут ничего нет. *Звуки сверчков*';
  }
  
  ?>

  <div class="product">
    <div class="slider">


    <?php 
    if(isset($id_good)){
      $sql = "SELECT * FROM `product-image` WHERE ID_product = $id_good";
    $result = $mysql->query($sql);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
      echo "<div class='slide'><img id='image' src='../images/" . $row['image'] . "' data-id='" . $row['ID'] . "'></div>";
      }
    }
    }
    
    ?> 
  </div>

    <div class="main-image">
      <img class="main-img" src="" alt="" id="main-img">
    </div>

  </div>


 <div class="overlay"></div>
  <div class="popup">
        <img src="" class="popup-img">
    </div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <script type="text/javascript" src="script.js"></script>
</body>
</html>

