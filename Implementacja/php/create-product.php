<?php
require_once "../config.php";
session_start();
ob_start();

// Define variables and initialize with empty values

$id = $name = $manufacturer = $quantity = $category = $type = "";
$name_err = $manufacturer_err = $quantity_err = $category_err = $type_err = "";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validations:
    include "./validations/validate_product.php";

    // Check input errors before inserting in database
    if (empty($name_err) && empty($manufacturer_err) && empty($quantity_err) && empty($category_err) && empty($type_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO product (name, manufacturer, quantity, category, type) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssss", $p_name, $p_manufacturer, $p_quantity, $p_category, $p_type);

            // Set parameters
            $p_name = $name;
            $p_manufacturer = $manufacturer;
            $p_quantity = $quantity;
            $p_category = $category;
            $p_type = $type;


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                $query = "SELECT * FROM product ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($conn, $query);
                $new = mysqli_fetch_assoc($result)['id'];
                header("location: ./read-product.php?id=" . $new);
                exit();
            } else {
                echo "Oops! Coś poszło nie tak, spróbuj ponownie.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Close connection
    mysqli_close($conn);
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
            <li class="header-item">Dodaj produkt</li>
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
    if (isset($_SESSION['user']) && in_array($_SESSION['user']['group_id'], array("Weterynarz", "Behawiorysta", "Magazynier", "Pracownik biurowy"))) {
        header("Location: ./nopermission.php");
        exit;
    }
	?>
    <section>
        <a href="../index.php?id=5" class="btn back-btn">Powrót</a>

        <article class="content detail-view">
            <h3>Podaj dane produktu</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form">
                <?php include "./form_fields/product_form.php"; ?>
                </div>
                <div class="flex-btn">
                    <input type="submit" class="btn" value="Zatwierdź">
                    <a href="javascript: history.go(-1)" class="btn">Anuluj</a>
                </div>
            </form>
        </article>
    </section>
</body>

</html>