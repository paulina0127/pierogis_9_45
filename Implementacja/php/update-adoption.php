<?php
require_once "../config.php";
require_once "./functions.php";
session_start();
ob_start();

// Define variables and initialize with empty values

$date = $status = $dog_id = $adopter_id = $type = $notes = "";
$date_err = $status_err = $dog_id_err = $adopter_id_err = $type_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
  $id = $_POST["id"];
  $notes = trim($_POST["notes"]);
  // Validations:
  include "./validations/validate_adoption.php";

  // Check input errors before inserting in database
  if (empty($date_err) && empty($status_err) && empty($type_err) && empty($dog_id_err) && empty($adopter_id_err)) {
    $sql = "UPDATE adoption SET date='$date', status='$status', type='$type', notes='$notes', 
    dog_id='$dog_id', adopter_id='$adopter_id' WHERE id='$id' LIMIT 1";
    if ($conn->query($sql)) {
      header("location: ./read-adoption.php?id=" . $id);
      exit();
    } else {
      echo "Oops! Coś poszło nie tak, spróbuj ponownie.";
    }
  }
  // Close connection
  mysqli_close($conn);
} else {
  // Check existence of id parameter before processing further
  if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);

    // Prepare a select statement
    $sql = "SELECT * FROM adoption WHERE id = ? LIMIT 1";
    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "i", $param_id);
      $param_id = $id;

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

          // Retrieve individual field value
          $id = $row["id"];
          $date = $row["date"]; 
          $status = $row["status"];
          $type = $row["type"];
          $notes = $row["notes"];
          $dog_id = $row["dog_id"];
          $adopter_id = $row["adopter_id"];

        } else {
          // URL doesn't contain valid id. Redirect to error page
          header("location: error.php");
          exit();
        }
      } else {
        echo "Oops! Coś poszło nie tak, spróbuj ponownie.";
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  } else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
  }
}
?>

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
            ob_start();
            if (isset($_SESSION['user'])) {
               echo $_SESSION['user']['group_id'] . ' ' . $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'];
            } else {
               header("Location: ../index.php");
               exit;
            }
        ?>
        </li>
      <li class="header-item">Edycja wpisu adopcyjnego</li>
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
    <a href="../index.php?id=3" class="btn back-btn">Powrót</a>

    <article class="content detail-view">
      <h3>Nr wpisu: <?php echo $id; ?></h3>
      <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
        <div class="form">
        <?php include "./form_fields/adoption_form.php" ?>
        </div>
        <div class="flex-btn">
          <input type="hidden" name="id" value="<?php echo $id; ?>" />
          <input type="submit" class="btn" value="Zatwierdź">
          <a href="javascript: history.go(-1)" class="btn">Anuluj</a>
        </div>
      </form>
    </article>
  </section>
</body>

</html>