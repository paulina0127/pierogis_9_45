<section>
  <h1>
    Schronisko <br />
    Bezpieczna Przystań
  </h1>
  <i class="fa-solid fa-paw"></i>
  <form action="" method="post" class="login-form">
    <div class="form-field">
      <i class="fa-solid fa-user"></i>
      <input type="text" name="username" id="username" placeholder="Login" />
    </div>
    <div class="form-field">
      <i class="fa-solid fa-lock"></i>
      <input
        type="password"
        name="password"
        id="password"
        placeholder="Hasło"
      />
    </div>
    <input type="submit" name="login" value="Zaloguj" class="btn" />
  </form>
  <?php
    if(isset($_POST['login'])) {
      if ($user = authenticate($_POST['username'], $_POST['password'])) {
        $_SESSION['user'] = $user;
        header("Location: ./index.php");
        exit;
      }
      else {
        echo 'Podano nieprawidłowe dane logowania.';
      }
    }
  ?>
</section>


