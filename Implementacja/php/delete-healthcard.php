<?php

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    require_once "../config.php";
    $id = $_POST["id"];
    $sql1 = "SELECT * FROM healthcard WHERE id = $id LIMIT 1";
    $query_run = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($query_run) == 1) {
            $row = mysqli_fetch_array($query_run);
            $book_id = $row['dog_id'];
        } else {
            echo "Oops! Coś poszło nie tak, spróbuj ponownie.";
        }

    $sql2 = "DELETE FROM healthcard WHERE id = ? LIMIT 1";

    if ($stmt = mysqli_prepare($conn, $sql2)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_POST["id"]);
        if (mysqli_stmt_execute($stmt)) {
            // Records deleted successfully. Redirect to landing page
            header("location: ./healthcard.php?id=".$book_id);
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