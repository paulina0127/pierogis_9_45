<?php
require_once "../config.php";
require_once "./functions.php";
session_start();
ob_start();

// Define variables and initialize with empty values

$product_id = $date1 = $date2 = $quantity = "";
$product_id_err = $date1_err = $date2_err = $quantity_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    // Validations:
    include "./validations/validate_warehouse.php";

    // Check input errors before inserting in database
    if (empty($product_id_err) && empty($date1_err) && empty($date2_err) && empty($quantity_err)) {
        $sql = "UPDATE warehouse SET arrival_date='$date1', expiry_date='$date2', quantity ='$quantity', product_id = '$product_id' WHERE id='$id' LIMIT 1";
        if ($conn->query($sql) === TRUE) {
            header("location: ./read-warehouse.php?id=" . $id);
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
        $sql = "SELECT * FROM warehouse WHERE id = ? LIMIT 1";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $product_id = $row["product_id"];
                    $date1 = $row['arrival_date'];
                    $date2 = $row['expiry_date'];
                    $quantity = $row["quantity"];
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
            <li class="header-item">Edycja wpisu magazynowego</li>
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
    if (isset($_SESSION['user']) && in_array($_SESSION['user']['group_id'], array("Weterynarz", "Behawiorysta", "Pracownik biurowy"))) {
        header("Location: ./nopermission.php");
        exit;
    }
	?>
    <section>
        <a href="../index.php?id=6" class="btn back-btn">Powrót</a>

        <article class="content detail-view">
            <h3>Nr wpisu: <?php echo $id; ?></h3>
            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                <div class="form">
                    <?php include "./form_fields/warehouse_form.php"; ?>
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