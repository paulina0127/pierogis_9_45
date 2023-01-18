<section>
  <div class="banner">
    <h1>Witaj</h1>
    <h2>
      <?php
        if (isset($_SESSION['user'])) {
          echo $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'];
        }
      ?>
    </h2>
    <i class="fa-solid fa-paw"></i>
  </div>

  <div class="main-screen-btn">
    <?php
      if ($_SESSION['user']['group_id'] == "Administrator" || $_SESSION['user']['group_id'] == "Pracownik biurowy" || $_SESSION['user']['group_id'] == "Weterynarz" || $_SESSION['user']['group_id'] == "Behawiorysta") {
        echo '<a href="./index.php?id=2" class="btn">Psy</a>';
      }
      if ($_SESSION['user']['group_id'] == "Administrator" || $_SESSION['user']['group_id'] == "Pracownik biurowy") {
        echo '<a href="./index.php?id=3" class="btn">Adoptujący</a>
              <a href="./index.php?id=4" class="btn">Adopcje</a>';
      }
      if ($_SESSION['user']['group_id'] == "Administrator" || $_SESSION['user']['group_id'] == "Kierownik magazynu" || $_SESSION['user']['group_id'] == "Magazynier") {
        echo '<a href="./index.php?id=5" class="btn">Katalog produktów</a>
              <a href="./index.php?id=6" class="btn">Magazyn</a>';
      }
    ?>
  </div>
</section>
