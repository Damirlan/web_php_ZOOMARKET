<?php 
require_once 'connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Products</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="file.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/cf41273882.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <style>
        th, td {
            padding: 10px;
        }

        th {
            background: #606060;
            color: #ffffff;
        }
        td {
            background: #b5b5b5;
        }

    </style>
    <body>
    <header class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <h1><a href="/sample/index.html">ZooMarket</a></h1>
        </div>
        <nav class="col-8">
          <ul>
            <li>
              <a href="userpage.php"><i class="fa fa-user fa-1x"></i>Кабинет покупателя</a>
            </li>
            <li>
              <a href="startsearch.html">Искать товар</a>
            </li>
            <li>
              <a href="showData.php">Список товаров</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    </header>
        <h1>Список ваших покупок</h1>
        <table>
            <tr>
                <th>Название продукта</th>
                <th>Бренд</th>
                <th>Порода</th>
                <th>Вид животного</th>
                <th>Тип продукта</th>
                <th>Оценка</th>
                <th>Действие</th>
            </tr>
            <?php
                $user_id = $_SESSION['id'];
                $string_query1 = "SELECT product.id, product.name_product, brend.name_brend, breedofanimal.name_breed, typeofproduct.name_top, typeofanimal.name_type, purchases.id
                FROM purchases
                JOIN product ON product.id = purchases.id_product
                JOIN brend ON brend.id = product.id_brend
                JOIN breedofanimal ON breedofanimal.id = product.id_animal
                JOIN typeofanimal ON typeofanimal.id = breedofanimal.id_type
                JOIN typeofproduct ON typeofproduct.id = product.id_top
                WHERE id_user='$user_id'";
                $string_query2 = "SELECT product.id, product.name_product, brend.name_brend, breedofanimal.name_breed, typeofproduct.name_top, typeofanimal.name_type, marks.mark 
                FROM marks
                JOIN purchases ON purchases.id = marks.id_purchases
                JOIN product ON product.id = purchases.id_product
                JOIN brend ON brend.id = product.id_brend
                JOIN breedofanimal ON breedofanimal.id = product.id_animal
                JOIN typeofanimal ON typeofanimal.id = breedofanimal.id_type
                JOIN typeofproduct ON typeofproduct.id = product.id_top
                WHERE id_user='$user_id'";
                $products = mysqli_query($connect, $string_query1);
                $products = mysqli_fetch_all($products);
                $marks = mysqli_query($connect, $string_query2);
                $marks = mysqli_fetch_all($marks);
                /*foreach($products as $products) {
                  foreach($marks as $marks) {
                    echo $marks[6];
                    echo '
                      <tr>
                        <td>' . $products[1] . '</td>
                        <td>' . $products[2] . '</td>
                        <td>' . $products[3] . '</td>
                        <td>' . $products[5] . '</td>
                        <td>' . $products[4] . '</td>
                        <td>' . $products[0] . '</td>
                        <td>Оценено</td>
                      </tr>
                      ';
                  }
                }*/

                

                //var_dump($products);
                //var_dump($marks);
                if(array_key_exists('button1', $_POST)) {
                  $mark1 = trim(strip_tags($_POST["mark1"]));
                  $pur1 = trim(strip_tags($_POST["button1"]));
                  $sql1 = "SELECT * FROM marks
                  WHERE id_purchases=$pur1 AND mark=$mark1";
                  $qwe = mysqli_query($connect, $sql1);
                  $qwe = mysqli_fetch_all($qwe);
                  //var_dump($qwe);
                  if(!$qwe){
                    $sql = "INSERT INTO marks (id_purchases, mark) VALUES ($pur1, $mark1)";
                    mysqli_query($connect, $sql);
                  }
                  //button1($mark1, $connect);
                }
                
                /*if(array_key_exists('button1', $_POST)) {
                  $mark1 = trim(strip_tags($_POST["mark1"]));
                  echo "This is Button1 that is selected";
                  $sql = "INSERT INTO marks (id_purchases, mark) VALUES (11, $mark1)";
                  $sql1 = "SELECT (id_purchases, mark) FROM marks
                  WHERE id_purchases=11 AND marks='$mark1'";
                  $qwe = mysqli_query($connect, $sql1);
                  var_dump($qwe);
                  if(!$qwe){
                    mysqli_query($connect, $sql);
                  }
                  
                  //button1($mark1, $connect);
                }
                else if(array_key_exists('button2', $_POST)) {
                  button2();
                }
                function button1($mark1, $connect) {
                  
                }
                function button2() {
                  echo "This is Button2 that is selected";
                }*/
                $products = mysqli_query($connect, $string_query1);
                $products = mysqli_fetch_all($products);
                
                foreach($products as $products) {
                  $markflag = false;
                  $marks = mysqli_query($connect, $string_query2);
                  $marks = mysqli_fetch_all($marks);
                  foreach($marks as $marks) {
                    //var_dump($marks);
                    
                    if($marks[0] == $products[0]){
                      //var_dump($marks);
                      $markflag = true;
                      echo '
                      <tr>
                        <td>' . $products[1] . '</td>
                        <td>' . $products[2] . '</td>
                        <td>' . $products[3] . '</td>
                        <td>' . $products[5] . '</td>
                        <td>' . $products[4] . '</td>
                        <td>' . $marks[6] . '</td>
                        <td>Оценено</td>
                      </tr>
                      ';
                    }
                  }
                  if (!$markflag) {
                    echo '
                    <form method="post">
                    <tr>
                        <td>' . $products[1] . '</td>
                        <td>' . $products[2] . '</td>
                        <td>' . $products[3] . '</td>
                        <td>' . $products[5] . '</td>
                        <td>' . $products[4] . '</td>
                        <td><select class="dropdown" name="mark1">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        </select></td>
                        <td><button type="submit" name="button1"
                        class="button" value=' . $products[6] . '>Оценить</input></td>
                    </tr>
                    </form>
                    ';
                  }
                  
                }
            ?>
            
        </table>
    </body>
</html>
