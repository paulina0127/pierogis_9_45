<?php

if (isset($_POST["id"]) && !empty($_POST["id"])) {
  require_once "../config.php";
  $sql = "DELETE FROM medicine WHERE id = ? LIMIT 1";

  if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    $param_id = trim($_POST["id"]);

    $id = $_POST['id'];
    $query = "SELECT * FROM medicine WHERE id=$id LIMIT 1";
    $result = mysqli_query($conn, $query);
    $entry_id = mysqli_fetch_assoc($result)['entry_id'];

    if (mysqli_stmt_execute($stmt)) {
      // Records deleted successfully. Redirect to landing page
      header("location: ../php/read-healthcard.php?id=" . $entry_id);
      exit();
    } else {
      echo "Oops! Coś poszło nie tak, spróbuj ponownie.";
    }
  }
  // Close statement
  mysqli_stmt_close($stmt);
  // Close connection
  mysqli_close($conn);
} else {
  // Check existence of id parameter
  if (empty(trim($_GET["id"]))) {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
  }
}

include("./delete-page.php");

?>
