<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "qwerty";
$currentuser = "";
//$login1 = trim(strip_tags($_POST["username"]));
//$password1 = trim(strip_tags($_POST["pwd"]));
// Создаем соединение
$connect = mysqli_connect($servername, $username, $password, $db_name);
//echo $login1;
//echo $password1;
if(!$connect){
    die('Error connect to database!');
}
?>