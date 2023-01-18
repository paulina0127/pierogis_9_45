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
        <li class="header-item"><b>Zalogowano jako:</b>
         <?php
            session_start();
            ob_start();
            if (isset($_SESSION['user'])) {
               echo $_SESSION['user']['group_id'] . ' ' . $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'];
            } else {
               header("Location: ../index.php");
               exit;
            }
        ?>
        </li>
        <li class="header-item">Podgląd wpisu adopcyjnego</li>
        <li class="header-item"><form method="POST"><input type="submit" name="logout" class="btn" value="Wyloguj" /></form></li>
        <?php
         if (isset($_POST['logout'])) {
            session_unset();
            header("Location: ../index.php");
            exit;
         }
        ?>
      </ul>
    </header>

    <?php
    if (isset($_SESSION['user']) && in_array($_SESSION['user']['group_id'], array("Weterynarz", "Behawiorysta", "Magazynier", "Kierownik magazynu"))) {
        header("Location: ./nopermission.php");
        exit;
    }
	?>
  <section>
    <a href="../index.php?id=4" class="btn back-btn">Powrót</a>

      <article class="content detail-view">
            <?php
            require_once "../config.php";
            $id = $_GET['id'];
            if ($id) {
                $sql = "SELECT * FROM adoption WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                 ?>
                 <h3>Nr wpisu: <?php echo $row["id"]; ?></h3>
                <div class="form">
                 <div class="form-field">
                    <h4>Data:</h4>
                    <p><?php echo $row["date"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Status:</h4>
                    <p><?php echo $row["status"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Nr ewidencyjny psa:</h4>
                    <p><?php echo $row["dog_id"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Typ:</h4>
                    <p><?php echo $row["type"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Id adoptującego:</h4>
                    <p><?php echo $row["adopter_id"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Uwagi:</h4>
                    <p><?php echo $row["notes"]; ?></p>
                 </div>
                 </div>
                
                 <div class="flex-btn-even">
                <div class="flex-btn">
                <a href="./update-adoption.php?id=<?php echo $row['id']; ?>" class="btn" title="Edytuj">Edytuj</a>
                <a href="./delete-adoption.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" title="Usuń">Usuń</a>
                </div>
                <div class="flex-btn">
                <a href="./read-dog.php?id=<?php echo $row['dog_id']; ?>" class="btn" title="Edytuj">Podgląd psa</a>
                <a href="./read-adopter.php?id=<?php echo $row['adopter_id']; ?>" class="btn" title="Usuń">Podgląd adoptujacego</a>
                </div>
                </div>
                 <?php
                }
            }
            else{
                echo "<h4>Nie znaleziono wpisu</h4>";
            }
            ?>
    </div>
</body>
</html>