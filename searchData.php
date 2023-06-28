<?php 
require_once 'connect.php';
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
        <table>
            <tr>
                <th>Название продукта</th>
                <th>Бренд</th>
                <th>Порода</th>
                <th>Вид животного</th>
                <th>Тип продукта</th>
            </tr>

            <?php
                $breed = trim(strip_tags($_POST["breedAn"]));
                $typeAnimal = trim(strip_tags($_POST["typeAn"]));
                $brend12 = trim(strip_tags($_POST["brend"]));
                $typrePro = trim(strip_tags($_POST["typePro"]));
                $string_query = "SELECT product.name_product, brend.name_brend, breedofanimal.name_breed, typeofproduct.name_top, typeofanimal.name_type 
                FROM product
                JOIN brend ON brend.id = product.id_brend
                JOIN breedofanimal ON breedofanimal.id = product.id_animal
                JOIN typeofanimal ON typeofanimal.id = breedofanimal.id_type
                JOIN typeofproduct ON typeofproduct.id = product.id_top
                WHERE name_type='$typeAnimal' AND name_breed='$breed' AND name_brend='$brend12' AND name_top='$typrePro'";
                $products = mysqli_query($connect, $string_query);
                $products = mysqli_fetch_all($products);
                foreach($products as $products) {
                    echo '
                    <tr>
                        <td>' . $products[0] . '</td>
                        <td>' . $products[1] . '</td>
                        <td>' . $products[2] . '</td>
                        <td>' . $products[4] . '</td>
                        <td>' . $products[3] . '</td>
                    </tr>
                    ';
                }
            ?>
        </table>
    </body>
</html>
