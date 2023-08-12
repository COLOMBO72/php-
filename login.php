<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header("location: users.php");
}
?>
<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="form login">
      <header>Nelson Chat</header>
      <form action="#">
        <div class="error-txt">Произошла ошибка, ---</div>
        <div class="field input">
          <label>Email</label>
          <input type="email" name="email" placeholder="aaa@aaa.aa">
        </div>
        <div class="field input">
          <label>Пароль</label>
          <input type="password" name="password" placeholder="••••••">
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" value="Продолжить">
        </div>
      </form>
      <div class="link">Нет аккаунта? <a href="index.php">Создать аккаунт</a></div>
    </section>
  </div>
  <script src="scripts/inputPassword.js"></script>
  <script src="scripts/login.js"></script>
</body>

</html>