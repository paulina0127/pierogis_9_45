<?php

require_once "../config.php";

function is_exist($table, $id)
{
  global $conn;
  $query = "SELECT * FROM $table WHERE id = '$id'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      return true;
    } else {
      return false;
    }
  }
}
?>