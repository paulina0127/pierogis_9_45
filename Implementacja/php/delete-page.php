<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Schronisko "Bezpieczna przystań"</title>
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/icons/css/all.css" />
  </head>

  <body>
    <header>
      <ul class="header">
        <li class="header-item"><b>Zalogowano jako:</b> <?php
          session_start();
          echo $_SESSION['user']['group_id'] . ' ' . $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'];
        ?></li>
        <li class="header-item"><form method="POST"><input type="submit" name="logout" class="btn" value="Wyloguj" /></form></li>
      </ul>
    </header>

  <section>
    <article class="content detail-view alert">
      <div class="alert">
          <h2>Usuń rekord</h2>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
              <p>Jesteś pewny, że chcesz usunąć ten rekord?</p>
      </div>
      <div class="flex-btn">
        <input type="submit" value="Tak, chcę" class="btn btn-danger">
        <a href="javascript:window.history.back();" class="btn">Nie chcę</a>
      </div>
      </form>
    </article>
  </section>
</body>
</html>