<?
session_start();
if (isset($_SESSION['unique_id'])){
  header("location: users.php");
}
?>
<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Nelson Chat</header>
      <form action="#" enctype="multipart/form-data">
        <div class="error-txt">Произошла ошибка, ---</div>
        <div class="name-details">
          <div class="field input">
            <label>Имя</label>
            <input type="text" name="fname" placeholder="Иван" required>
          </div>
          <div class="field input">
            <label>Фамилия</label>
            <input type="text" name="lname" placeholder="Иванов" required>
          </div>
        </div>
        <div class="field input">
          <label>Email</label>
          <input type="email" name="email" placeholder="aaa@aaa.aa" required>
        </div>
        <div class="field input">
          <label>Пароль</label>
          <input type="password" name="password" placeholder="******" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Выберите изображение</label>
          <input type="file" name="image" required>
        </div>
        <div class="field button">
          <input type="submit" value="Продолжить">
        </div>
      </form>
      <div class="link">Уже зарегистрированы? <a href="login.php">Войти</a></div>
    </section>
  </div>

  <script src="scripts/inputPassword.js"></script>
  <script src="scripts/signup.js"></script>

</body>

</html>