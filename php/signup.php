<?php
session_start();
include_once "config.php";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
// Проверка введённых данных
if (!empty($fname) && !empty($email) && !empty($lname) && !empty($password)) {
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Проверка email на правильность
    // если он правильный, то ищем схожесть в базе данных
    $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
    if (mysqli_num_rows($sql) > 0) {
      // true
      echo "Данная почта занята - $email";
    } else {
      // false - далее проверяем загрузил ли юзер фото
      if (isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name']; // берём название фото
        $img_type = $_FILES['image']['type']; // берём тип фото
        $tmp_name = $_FILES['image']['tmp_name']; // название для сохранения файла в нашей бд
        $img_explode = explode('.', $img_name); // обрезаем имя и оставляем тип файла
        $img_ext = end($img_explode); // здесь берём тип файла изображения
        $extensions = ['png', 'jpg', 'jpeg']; // задаём условие для подходящего изображения
        if (in_array($img_ext, $extensions) === true) { // српавнием загруженную картинку с нашми условием
          $time = time(); // вернёт настоящее время
          $new_img_name = $time . $img_name;
          if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) { // если есть картинка - переместить в нашу директорию 
            $status = "В сети"; // когда юзер зарегался - ему присваивается статус в сети)
            $random_id = rand(time(), 1000000); // делаем рандомный id для юзера
            // Добавляем пользователя в базу данных !!!
            $sql2 = mysqli_query(
              $conn,
              "INSERT INTO users (unique_id,fname,lname,email,password,img,status)
             VALUES ('{$random_id}', '{$fname}', '{$lname}','{$email}','{$password}','{$new_img_name}','{$status}')"
            );
            if ($sql2) {
              // если данные внесены, запрос успешен
              $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
              if (mysqli_num_rows($sql3) > 0) {
                $row = mysqli_fetch_assoc($sql3);
                $_SESSION['unique_id'] = $row['unique_id']; // используя эту сессию - мы используем unique_id пользователя в других файлах
                echo 'success';
              }
            } else {
              echo "Что-то пошло не так (регистрация пользователя).";
            }
          }
        } else {
          echo "Фотография должна быть одним из этих типов - jpg,jpeg,png";
        }
      } else {
        // false
        echo "Пожалуйста, загрузите фотографию";
      }
    }
  } else {
    echo "Не корректно введено - $email !";
  }
} else {
  echo "Все значения обязательны!";
}
