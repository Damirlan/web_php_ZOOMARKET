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
    <form class="row justify-content-md-center" name="input" method="post" action="confirmBuy.php">
        
            <?php
            session_start();
            require_once 'connect.php';
            //$pur = $_POST['ch'];
            //if(empty($pur)) 
            if (!isset($_POST['ch'])) 
            {
              echo("Вы не выбрали ни одного товара.");
            } 
            else
            {
              $pur = $_POST['ch'];
              $N = count($pur);
              $string_query = "SELECT product.id, product.name_product, brend.name_brend, breedofanimal.name_breed, typeofproduct.name_top, typeofanimal.name_type 
                    FROM product
                    JOIN brend ON brend.id = product.id_brend
                    JOIN breedofanimal ON breedofanimal.id = product.id_animal
                    JOIN typeofanimal ON typeofanimal.id = breedofanimal.id_type
                    JOIN typeofproduct ON typeofproduct.id = product.id_top";
                    $products = mysqli_query($connect, $string_query);
                    $products = mysqli_fetch_all($products);
                    ?>
                    <table>
                      <tr>
                        <th>Название продукта</th>
                        <th>Бренд</th>
                        <th>Порода</th>
                        <th>Вид животного</th>
                        <th>Тип продукта</th>
                      </tr>
                    <form class="row justify-content-md-center" name="input" method="post" action="confirmBuy.php">
                    <?php
                    foreach($products as $products) {
                      for($i=0; $i < $N; $i++){
                        if($products[0] == $pur[$i]) {
                          echo '
                                <tr>
                                    <td>' . $products[1] . '</td>
                                    <td>' . $products[2] . '</td>
                                    <td>' . $products[3] . '</td>
                                    <td>' . $products[5] . '</td>
                                    <td>' . $products[4] . '</td>
                                </tr>
                                ';
                          echo '<input type="text" name="ch[] id="ch-' . $products[0] . '" value=' . $products[0] . ' />';
                        }
                      }
                    }
                    ?>
                    </table>
                    <?php
                    //echo '<input type="hidden" name="verify1" id="verify1" value=' . $_POST['ch'] . '><br>';
                    ?>
                    <input type="hidden" name="verify2" id="verify2" value="123"><br>
                    <button type="submit" class="btn btn-primary">Подтвердите покупку</button>
                    </form>
                    <?php
            }
?>
            
        
        
    </body>
</html>
