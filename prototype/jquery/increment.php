<?php
if(isset($_POST['number'])){
    echo "<script>alert('Чтобы положить товар в корзину необходимо зарегитрироватся')</script>";
  $number = $_POST['number'];
  $result = $number * 3;
  echo "Это результат: ".$result;
}
?>