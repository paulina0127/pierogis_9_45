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
        <li class="header-item">Podgląd profilu psa</li>
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
    if (isset($_SESSION['user']) && in_array($_SESSION['user']['group_id'], array("Magazynier", "Kierownik magazynu"))) {
        header("Location: ./nopermission.php");
        exit;
    }
	?>
  <section>
    <a href="../index.php?id=2" class="btn back-btn">Powrót</a>

      <article class="content detail-view">
            <?php
            require_once "../config.php";
            $id = $_GET['id'];
            if ($id) {
                $sql = "SELECT * FROM dog WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                 ?>
                 <h3>Nr ewidencyjny: <?php echo $row["id"]; ?></h3>
                <div id="dog-profile">
                 <div class="form">
                 <div class="form-field">
                    <h4>Imię:</h4>
                    <p><?php echo $row["name"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Data przyjęcia:</h4>
                    <p><?php echo $row["admission_date"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Numer boksu:</h4>
                    <p><?php echo $row["box_number"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Płeć:</h4>
                    <p><?php echo $row["gender"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Data urodzenia:</h4>
                    <p><?php echo $row["birthdate"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Wiek:</h4>
                    <p><?php echo $row["age"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Rasa:</h4>
                    <p><?php echo $row["breed"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Numer chipa:</h4>
                    <p><?php echo $row["chip_number"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Status:</h4>
                    <p><?php echo $row["status"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Alergie:</h4>
                    <p><?php echo $row["alergies"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Choroby:</h4>
                    <p><?php echo $row["diseases"]; ?></p>
                 </div>
                 <div class="form-field">
                    <h4>Opis:</h4>
                    <p><?php echo $row["description"]; ?></p>
                 </div>
                 </div>
                    <?php 
                    if(!($row["picture"] == "") && !($row["picture"] == null)){?>
                    <img src="../images/dogs/<?php echo $row['picture']; ?>">
                    <?php
                    }  else {
                     echo "<p>Brak zdjęcia</p>";
                  }?>
               </div>
                <div class="flex-btn-even">
                    <div class="flex-btn">
                     <?php
                     if ($_SESSION['user']['group_id'] != "Behawiorysta") {
                            echo '<a href="./update-dog.php?id=' . $row['id'] .  '" class="btn" title="Edytuj">Edytuj</a>';
                        }
                    if ($_SESSION['user']['group_id'] != "Weterynarz" && $_SESSION['user']['group_id'] != "Behawiorysta") {
                            echo '<a href="./delete-dog.php?id=' . $row['id'] . '" class="btn btn-danger" title="Usuń">Usuń</a>';
                        }
                     ?>
                    </div>

                 <a href="./healthcard.php?id=<?php echo $row['id']; ?>" class="btn" title="Książeczka zdrowia">Książeczka zdrowia</a>
                </div>
                 <?php
                }
            }
            else{
                echo "<h4>Nie znaleziono psa</h4>";
            }
            ?>
    </div>
</body>
</html>