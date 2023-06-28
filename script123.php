<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "qwerty";
// Создаем соединение
$conn = new mysqli($servername, $username, $password, $db_name);
// Проверяем соединение
if ($conn->connect_error) {
    die("Ошибка соединения: " . $conn->connect_error);
}
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
$res = mysqli_query($conn, $string_query);
print('Вот список товаров: ');

for ($row_no = 0; $row_no <= $res->num_rows - 1; $row_no++) {
    $res->data_seek($row_no);
    $row = $res->fetch_assoc();
    print('<br>');
    print($row['name_product'] . '   ' . $row['name_brend'] . '   ' . $row['name_top'] . '   ' . $row['name_breed'] . '   ' . $row['name_type'] . '   ');
}
?>