<?php
require_once "../config.php";
// require_once "./functions.php";
session_start();
ob_start();

// Define variables and initialize with empty values

$name = $admission_date = $box_number = $gender = $birthdate = $age = $breed = $chip_number = $status = $alergies = $diseases = $description = "";
$name_err = $admission_date_err = $box_number_err = $gender_err = $age_err = $breed_err = $status_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    include "./validations/validate_dog.php";
    $chip_number = trim($_POST["chip_number"]);
    $alergies = trim($_POST["alergies"]);
    $diseases = trim($_POST["diseases"]);
    $description = trim($_POST["description"]);

    $dog_image = $_FILES['dog_image']['name'];
    $dog_image_tmp_name = $_FILES['dog_image']['tmp_name'];
    $dog_image_folder = '../images/dogs/' . $dog_image;

    $old_image = $_POST['old_image'];

    if ($dog_image != "") {
        $update_filename = $dog_image;
    } else {
        $update_filename = $old_image;
    }

    // Check input errors before inserting in database
    if (
        empty($name_err) && empty($admission_date_err) && empty($box_number_err) && empty($gender_err) && empty($age_err) && empty($breed_err) && empty($status_err)
    ) {
        $sql = "UPDATE dog SET name='$name', admission_date='$admission_date', box_number='$box_number', 
    gender='$gender', birthdate='$birthdate', age='$age', breed='$breed', chip_number='$chip_number', 
    status='$status', alergies='$alergies', diseases='$diseases', picture='$update_filename', description='$description' WHERE id='$id' LIMIT 1";
        if ($conn->query($sql)) {
            if ($dog_image != "") {
                move_uploaded_file($dog_image_tmp_name, $dog_image_folder);
                if (file_exists('../images/dogs/' . $old_image)) {
                    unlink('../images/dogs/' . $old_image);
                }
            }
            header("location: ./read-dog.php?id=" . $id);
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
        $sql = "SELECT * FROM dog WHERE id = ? LIMIT 1";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    // Retrieve individual field value
                    $name = $row["name"];
                    $admission_date = $row["admission_date"];
                    $box_number = $row["box_number"];
                    $gender = $row["gender"];
                    $birthdate = $row["birthdate"];
                    $age = $row["age"];
                    $breed = $row["breed"];
                    $chip_number = $row["chip_number"];
                    $status = $row["status"];
                    $alergies = $row['alergies'];
                    $diseases = $row['diseases'];
                    $picture = $row["picture"];
                    $description = $row['description'];

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
            <li class="header-item">Edycja profilu psa</li>
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
    if (isset($_SESSION['user']) && in_array($_SESSION['user']['group_id'], array("Behawiorysta", "Magazynier", "Kierownik magazynu"))) {
        header("Location: ./nopermission.php");
        exit;
    }
	?>
    <section>
        <a href="../index.php?id=2" class="btn back-btn">Powrót</a>

        <article class="content detail-view">
            <h3>Nr ewidencyjny: <?php echo $id; ?></h3>
            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post"
                enctype="multipart/form-data">
                <div class="form">
                <?php include "./form_fields/dog_form.php"; ?>
                    <div class="form-field">
                        <label>Zmień zdjęcie</label>
                        <input type="hidden" name="old_image" value="<?php echo $row['picture']; ?>">
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="dog_image">
                        </div>
                        <?php
                        if (!($picture == "") && !($picture == null)) { ?>
                            <div class="form-field">
                                <label>Aktualne zdjęcie</label>
                                <img src="../images/dogs/<?php echo $picture; ?>" style="height: 150px; width: auto">
                            </div>
                            <?php
                        }
                        ?>
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