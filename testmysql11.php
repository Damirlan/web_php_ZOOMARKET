<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Webpage description goes here" />
  <title>ZooMagazin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="file.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/cf41273882.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
</head>

<body>
  
<?php
session_start();
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
//...............вход.........................
if (trim(strtolower($_POST['verify1'])) == 'input'){
  
  $login1 = trim(strip_tags($_POST["username"]));
  $password1 = trim(strip_tags($_POST["pwd"]));
  $id1 = 0;
  $res = mysqli_query($conn, "SELECT * FROM users");
  $Auten = FALSE;
  for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
      $res->data_seek($row_no);
      $row = $res->fetch_assoc();

      if( ($row['login'] == $login1) && ($row['password'] == $password1) ) {
        $id1 = $row['id'];
        $Auten = TRUE;
      }
  }
  if($Auten)  {
    ?>
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
    <?php
    echo 'Вы вошли.';
    $_SESSION['id'] = $id1;
    $_SESSION['login'] = $login1;
    $_SESSION['pass'] = $password1;
  } else{
    echo 'Попробуте повторить попытку ввода';
  }
  $conn->close();
  // ................регистрация........................
} elseif (trim(strtolower($_POST['verify1'])) == 'reg') {
  $login2 = trim(strip_tags($_POST["username"]));
  $password2 = trim(strip_tags($_POST["pwd1"]));
  $res = mysqli_query($conn, "SELECT * FROM users");
  $row_cnt = $res->num_rows;
  $Auten2 = TRUE;
  for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
      $res->data_seek($row_no);
      $row = $res->fetch_assoc();
      if(($row['login'] == $login2)) {
        $Auten2 = FALSE;
      }
  }

  if ($login2 && $password2 && $Auten2) {
    ?>
    <header class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <h1><a href="/sample/index.html">ZooMarket</a></h1>
                </div>
                <nav class="col-8">
                  <ul>
                      <li>
                        <a href="changedata.html">Изменить пароль</a>
                      </li>
                      <li>
                        <a href="input.html">Вход</a>
                      </li>
                      <li>
                        <a href="registration.html">Регистрация</a>
                      </li>
                  </ul>
              </nav>
            </div>
        </div>
    </header>
    <?php
    $sql = "INSERT INTO users (login, password) VALUES ('$login2', '$password2')";
    mysqli_query($conn, $sql);
    echo 'Вы зарегистрированы.' . '<br>';
  }
  
  $res = mysqli_query($conn, "SELECT * FROM users");
  // Закрыть подключение
  $conn->close();
  //........................изменение данных......................
} elseif (trim(strtolower($_POST['verify1'])) == 'change') {
  $login3 = trim(strip_tags($_POST["username"]));
  $password3 = trim(strip_tags($_POST["pwd2"]));
  $password4 = trim(strip_tags($_POST["pwd3"]));

  if ($login3 && $password3 && $password4 && $password3 == $password4) {
    ?>
    <header class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <h1><a href="/sample/index.html">ZooMarket</a></h1>
                </div>
                <nav class="col-8">
                  <ul>
                      <li>
                        <a href="changedata.html">Изменить пароль</a>
                      </li>
                      <li>
                        <a href="input.html">Вход</a>
                      </li>
                      <li>
                        <a href="registration.html">Регистрация</a>
                      </li>
                  </ul>
              </nav>
            </div>
        </div>
    </header>
    <?php
    $sql = "UPDATE users
    SET password = '$password3'
    WHERE login = '$login3'";
    mysqli_query($conn, $sql);

  }
  $conn->close();
}

?>
<div class="container">
</div>

<script>
</script>

</body>
</html>