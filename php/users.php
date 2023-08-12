<?
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id}"); // забираем пользователей из БД
$output = ""; // константа вывода данных
if (mysqli_num_rows($sql) == 1) {
  $output .= "Пользователей в сети не найдено";
} elseif (mysqli_num_rows($sql) > 0) {
  include "data.php";
}
echo $output;
