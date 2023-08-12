<?php
session_start();
include_once "config.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
if (!empty($email) && !empty($password)) {
  // Проверяем мыло и пароль в базе данных
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
  if (mysqli_num_rows($sql) > 0) {
    // Если пользователь найден
    $row = mysqli_fetch_assoc($sql);
    $status = "В сети";
    $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
    if ($sql2) {
      $_SESSION['unique_id'] = $row['unique_id']; // используя эту сессию - мы используем unique_id пользователя в других файлах
      echo 'success';
    }
  } else {
    echo "Почта или пароль неправильно введены!";
  }
} else {
  echo "Все поля должны быть заполнены!";
}
