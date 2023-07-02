<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sass/requests.css">
    <title></title>
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
                <h1 class="admin-heading">Запрос №<span id="id_product"></span></h1>
                <div class="request-result">
                <?php
                    session_start();
                    include('..\config\main.php');

                    if (isset($_SESSION['selected_request'])) {
                      $key = str_replace("request-", "", $_SESSION['selected_request']);
                      echo "<script>document.getElementById('id_product').textContent = '$key';</script>";
                      echo "<script>document.title = 'Запрос № ' + '$key'</script>";

                        switch ($key) {
                        case '1':
                            $html = <<<HTML
                            <p class="request-page">Получить список всех продуктов определенной категории.</p>
                            <form method='post'>
                            <select name='select' id='select-request-1' onchange='getProductList_1()'>
                            HTML;
                            //
                            $query = 'SELECT * FROM product_category';
                            $result = mysqli_query($mysql, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                $html .= "<option value='".$row['ID']."'>".$row['name']."</option>";
                            }
                           
                            $html .= "</select>";
                            echo $html;
                            echo "<input type='submit'>";
                            echo "</form>";


                            if(isset($_POST['select'])){
                                $selectedId = $_POST['select'];
                            // Напишите SQL-запрос с использованием выбранного id
                            $query = "SELECT * FROM products WHERE ID_category = $selectedId";
                            
                            // Выполните запрос и получите результат
                            $result = mysqli_query($mysql, $query);

                             // Проверка наличия данных и вывод результатов
                             if (mysqli_num_rows($result) > 0) {
                                echo "<table>";
                                echo "<tr>";
                                
                                // Получение названий колонок таблицы и вывод их в заголовке
                                $fieldinfo = mysqli_fetch_fields($result);
                                foreach ($fieldinfo as $val) {
                                    echo "<th>".$val->name."</th>";
                                }
                                
                                echo "</tr>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    // Вывод значений из таблицы
                                    foreach ($row as $val) {
                                        echo "<td>".$val."</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "Наверное таких продуктов ещё нет, попробуйте их добавить! <a href='good_add.php'>ДОБАВИТЬ</a> ";
                            }
                        }
                            
                        break;
                        case '2':         
                            echo 
                            " <p class=request-page>Получить список всех заказов определенного клиента.</p>
                            <form method='post'>
                            <input type='text' name='ID_user' placeholder='Введите ID клиента'>
                            <input type='submit'>
                            <form>"; 
                            // Получение ID_user из формы ввода
                            if(isset($_POST['ID_user'])){
                                $ID_user = $_POST['ID_user'];
                                // echo  $ID_user;

                                // SQL запрос для получения всех заказов определенного клиента
                                $sql = "SELECT * FROM orders WHERE ID_user = '$ID_user'";
                                
                                // Выполнение запроса
                                $result = mysqli_query($mysql, $sql);
                                
                                // Проверка наличия данных и вывод результатов
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<table>";
                                    echo "<tr>";
                                    
                                    // Получение названий колонок таблицы и вывод их в заголовке
                                    $fieldinfo = mysqli_fetch_fields($result);
                                    foreach ($fieldinfo as $val) {
                                        echo "<th>".$val->name."</th>";
                                    }
                                    
                                    echo "</tr>";
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        // Вывод значений из таблицы
                                        foreach ($row as $val) {
                                            echo "<td>".$val."</td>";
                                        }
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "Нет доступных заказов для данного клиента";
                                }
                            }       
                        break;
                        case '3':
                           //
                           $html = <<<HTML
                          
                            <form method='post'>
                            <p class="request-page">Получить список всех поставщиков, у которых есть ингредиенты определенного типа.</p>
                            <select name='select' id='select-request-1' onchange='getProductList_1()'>
                            HTML;
                            //
                            $query = 'SELECT * FROM ingredient_type';
                            $result = mysqli_query($mysql, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                $html .= "<option value='".$row['ID']."'>".$row['name']."</option>";
                            }
                           
                            $html .= "</select>";
                            echo $html;
                            echo "<input type='submit'>";
                            echo "</form>";


                            if(isset($_POST['select'])){
                                $selectedId = $_POST['select'];
                            // Напишите SQL-запрос с использованием выбранного id
                            $query = "SELECT DISTINCT p.name
                            FROM provider p
                            JOIN `provider-ingredient` ip ON p.id = ip.ID_provider
                            JOIN ingredients i ON ip.ID_ingredient = i.id
                            JOIN ingredient_type it ON i.ID_type = it.ID
                            WHERE it.ID =  $selectedId";
                            
                            // Выполните запрос и получите результат
                            $result = mysqli_query($mysql, $query);

                             // Проверка наличия данных и вывод результатов
                             if (mysqli_num_rows($result) > 0) {
                                echo "<table>";
                                echo "<tr>";
                                
                                // Получение названий колонок таблицы и вывод их в заголовке
                                $fieldinfo = mysqli_fetch_fields($result);
                                foreach ($fieldinfo as $val) {
                                    echo "<th>".$val->name."</th>";
                                }
                                
                                echo "</tr>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    // Вывод значений из таблицы
                                    foreach ($row as $val) {
                                        echo "<td>".$val."</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "Наверное таких продуктов ещё нет, попробуйте их добавить! <a href='good_add.php'>ДОБАВИТЬ</a> ";
                            }
                        }
                           //
                        break;
                        case '4':
                            echo 
                            "<p class=request-page>Получить список всех продуктов, у которых количество на складе меньше заданного значения.</p><form method='post'>
                            <input type='number' min=0 name='ID_user' placeholder='Введите количество товара'>
                            <input type='submit'>
                            <form>"; 

                            if(isset($_POST['ID_user'])){
                                $ID_user = $_POST['ID_user'];
                                // echo  $ID_user;

                                // SQL запрос для получения всех заказов определенного клиента
                                $sql = "SELECT * FROM products WHERE stock_balance < '$ID_user'";
                                
                                // Выполнение запроса
                                $result = mysqli_query($mysql, $sql);
                                
                                // Проверка наличия данных и вывод результатов
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<table>";
                                    echo "<tr>";
                                    
                                    // Получение названий колонок таблицы и вывод их в заголовке
                                    $fieldinfo = mysqli_fetch_fields($result);
                                    foreach ($fieldinfo as $val) {
                                        echo "<th>".$val->name."</th>";
                                    }
                                    
                                    echo "</tr>";
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        // Вывод значений из таблицы
                                        foreach ($row as $val) {
                                            echo "<td>".$val."</td>";
                                        }
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "Нет товаров, у которых количество меньше заданного числа";
                                }
                            }       
                        break;
                        case '5':
                            echo 
                            "<p class=request-page>Получить список всех заказов, сделанных в определенный период времени.</p>
                            <form method='post'>
                            <input type='date' min=0 name='start' placeholder='Начало'>-<input type='date' min=0 name='end' placeholder='Конец'>
                            <input type='submit' name='ок'>
                            <form>"; 

                            if(isset($_POST['ок'])){
                                $start_date = $_POST['start'];
                                $end_date = $_POST['end'];

                                // SQL запрос для получения всех заказов определенного клиента
                                $sql = "SELECT * FROM orders WHERE created_at BETWEEN '$start_date' AND '$end_date'";
                                
                                // Выполнение запроса
                                $result = mysqli_query($mysql, $sql);
                                
                                // Проверка наличия данных и вывод результатов
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<table>";
                                    echo "<tr>";
                                    
                                    // Получение названий колонок таблицы и вывод их в заголовке
                                    $fieldinfo = mysqli_fetch_fields($result);
                                    foreach ($fieldinfo as $val) {
                                        echo "<th>".$val->name."</th>";
                                    }
                                    
                                    echo "</tr>";
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        // Вывод значений из таблицы
                                        foreach ($row as $val) {
                                            echo "<td>".$val."</td>";
                                        }
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "Нет заказов соответствующих данным критериям";
                                }
                            }       
                        break;
                        case '6':
                            //
                           $html = <<<HTML
                           <p class="request-page">Получить список всех поставщиков, предоставляющих определенный продукт.</p>
                           <form method='post'>
                           <select name='select' id='select-request-1' onchange='getProductList_1()'>
                           HTML;
                           //
                           $query = 'SELECT * FROM ingredient_type';
                           $result = mysqli_query($mysql, $query);

                           while ($row = mysqli_fetch_assoc($result)) {
                               $html .= "<option value='".$row['ID']."'>".$row['name']."</option>";
                           }
                          
                           $html .= "</select>";
                           echo $html;
                           echo "<input type='submit'>";
                           echo "</form>";


                           if(isset($_POST['select'])){
                               $selectedId = $_POST['select'];
                           // Напишите SQL-запрос с использованием выбранного id
                           $query = "SELECT DISTINCT p.name
                           FROM provider p
                           JOIN `provider-ingredient` ip ON p.id = ip.ID_provider
                           JOIN ingredients i ON ip.ID_ingredient = i.id
                           JOIN ingredient_type it ON i.ID_type = it.ID
                           WHERE it.ID =  $selectedId";
                           
                           // Выполните запрос и получите результат
                           $result = mysqli_query($mysql, $query);

                            // Проверка наличия данных и вывод результатов
                            if (mysqli_num_rows($result) > 0) {
                               echo "<table>";
                               echo "<tr>";
                               
                               // Получение названий колонок таблицы и вывод их в заголовке
                               $fieldinfo = mysqli_fetch_fields($result);
                               foreach ($fieldinfo as $val) {
                                   echo "<th>".$val->name."</th>";
                               }
                               
                               echo "</tr>";
                               while ($row = mysqli_fetch_assoc($result)) {
                                   echo "<tr>";
                                   // Вывод значений из таблицы
                                   foreach ($row as $val) {
                                       echo "<td>".$val."</td>";
                                   }
                                   echo "</tr>";
                               }
                               echo "</table>";
                           } else {
                               echo "Наверное таких продуктов ещё нет, попробуйте их добавить! <a href='good_add.php'>ДОБАВИТЬ</a> ";
                           }
                       }
                          //
                        break;
                        case '7':
                            $html = <<<HTML
                           <p class="request-page">Получить список всех заказов, у которых статус равен определенному значению.</p>
                           <form method='post'>
                           <select name='select' id='select-request-1' onchange='getProductList_1()'>
                           <option value="1">Новый</option>
                           <option value="2">Собран</option>
                           <option value="3">Получен</option>
                           </select>
                           HTML;
                           
                           echo $html;
                           echo "<input type='submit'>";
                           echo "</form>";


                           if(isset($_POST['select'])){
                               $selectedId = $_POST['select'];
                           // Напишите SQL-запрос с использованием выбранного id
                           $query = "SELECT * 
                           FROM orders 
                           WHERE 
                               ($selectedId = 1 AND created_at IS NOT NULL) 
                               OR ($selectedId = 2 AND assembly_at IS NOT NULL) 
                               OR ($selectedId = 3 AND received_at IS NOT NULL)";
                           
                           // Выполните запрос и получите результат
                           $result = mysqli_query($mysql, $query);

                            // Проверка наличия данных и вывод результатов
                            if (mysqli_num_rows($result) > 0) {
                               echo "<table>";
                               echo "<tr>";
                               
                               // Получение названий колонок таблицы и вывод их в заголовке
                               $fieldinfo = mysqli_fetch_fields($result);
                               foreach ($fieldinfo as $val) {
                                   echo "<th>".$val->name."</th>";
                               }
                               
                               echo "</tr>";
                               while ($row = mysqli_fetch_assoc($result)) {
                                   echo "<tr>";
                                   // Вывод значений из таблицы
                                   foreach ($row as $val) {
                                       echo "<td>".$val."</td>";
                                   }
                                   echo "</tr>";
                               }
                               echo "</table>";
                           } else {
                               echo "Вероятно таких заказов пока нет!";
                           }
                       }
                        break;
                        case '8':
                            echo "<p class=request-page>Получить список всех заказов с указанием имени клиента и продукта.</p>";
                             // SQL запрос для получения всех заказов определенного клиента
                             $sql = "SELECT o.ID AS `ID заказа`, o.name, p.name AS product_name
                             FROM orders o
                             JOIN ordered_products op ON o.ID = op.ID_order
                             JOIN products p ON op.ID_product = p.ID";
                                
                             // Выполнение запроса
                             $result = mysqli_query($mysql, $sql);
                             
                             // Проверка наличия данных и вывод результатов
                             if (mysqli_num_rows($result) > 0) {
                                 echo "<table>";
                                 echo "<tr>";
                                 
                                 // Получение названий колонок таблицы и вывод их в заголовке
                                 $fieldinfo = mysqli_fetch_fields($result);
                                 foreach ($fieldinfo as $val) {
                                     echo "<th>".$val->name."</th>";
                                 }
                                 
                                 echo "</tr>";
                                 while ($row = mysqli_fetch_assoc($result)) {
                                     echo "<tr>";
                                     // Вывод значений из таблицы
                                     foreach ($row as $val) {
                                         echo "<td>".$val."</td>";
                                     }
                                     echo "</tr>";
                                 }
                                 echo "</table>";
                             } else {
                                 echo "Нет заказов соответствующих данным критериям";
                             }
                        break;
                        case '9':
                            echo 
                            "<p class=request-page>Получить список суммарного количества каждого продукта, проданного за
                            определенный период времени.</p>
                            <form method='post'>
                            <input type='date' min=0 name='start' placeholder='Начало'>-<input type='date' min=0 name='end' placeholder='Конец'>
                            <input type='submit' name='ок'>
                            <form>"; 

                            if(isset($_POST['ок'])){
                                $start_date = $_POST['start'];
                                $end_date = $_POST['end'];

                                // SQL запрос для получения всех заказов определенного клиента
                                $sql = "SELECT p.name AS `Название продукта`, SUM(op.quantity) AS `Колличество продаж`
                                FROM orders o
                                JOIN ordered_products op ON o.ID = op.ID_order
                                JOIN products p ON p.ID = op.ID_product
                                WHERE o.created_at BETWEEN '$start_date' AND '$end_date'
                                GROUP BY op.ID_product, p.name";
                                
                                // Выполнение запроса
                                $result = mysqli_query($mysql, $sql);
                                
                                // Проверка наличия данных и вывод результатов
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<table>";
                                    echo "<tr>";
                                    
                                    // Получение названий колонок таблицы и вывод их в заголовке
                                    $fieldinfo = mysqli_fetch_fields($result);
                                    foreach ($fieldinfo as $val) {
                                        echo "<th>".$val->name."</th>";
                                    }
                                    
                                    echo "</tr>";
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        // Вывод значений из таблицы
                                        foreach ($row as $val) {
                                            echo "<td>".$val."</td>";
                                        }
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "Нет заказов соответствующих данным критериям";
                                }
                            }       
                            break;
                        case '10':

                            $html = <<<HTML
                            <p class=request-page>Получить список всех продуктов, у которых количество в наличии меньше
                            заданного значения и они находятся в определенной категории.</p>
                            <form method='post'>
                            <input type='number' min=0 name='stock_balance' placeholder='Введите количество товара'>
                            <select name='select' id='select-request-1' onchange='getProductList_1()'>
                            HTML;
                            //
                            $query = 'SELECT * FROM product_category';
                            $result = mysqli_query($mysql, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                $html .= "<option value='".$row['ID']."'>".$row['name']."</option>";
                            }
                           
                            $html .= "</select>";
                            echo $html;
                            echo "<input type='submit'>";
                            echo "</form>";


                            if(isset($_POST['select'])){
                                $selectedId = $_POST['select'];
                            // Напишите SQL-запрос с использованием выбранного id
                            $query = "SELECT *
                            FROM products
                            WHERE stock_balance < $_POST[stock_balance]
                            AND ID_category = $selectedId;";
                            
                            // Выполните запрос и получите результат
                            $result = mysqli_query($mysql, $query);

                             // Проверка наличия данных и вывод результатов
                             if (mysqli_num_rows($result) > 0) {
                                echo "<table>";
                                echo "<tr>";
                                
                                // Получение названий колонок таблицы и вывод их в заголовке
                                $fieldinfo = mysqli_fetch_fields($result);
                                foreach ($fieldinfo as $val) {
                                    echo "<th>".$val->name."</th>";
                                }
                                
                                echo "</tr>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    // Вывод значений из таблицы
                                    foreach ($row as $val) {
                                        echo "<td>".$val."</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "Наверное таких продуктов ещё нет, попробуйте их добавить! <a href='good_add.php'>ДОБАВИТЬ</a> ";
                            }
                        }     
                        break;
                       }
                    }
?>
                <div id="request_result"></div>
                </div>
            </div>
        </section>
</div>
</body>
</html>