<?php
require_once "../config.php";
session_start();
ob_start();

// Define variables and initialize with empty values
$name = $admission_date = $box_number = $gender = $birthdate = $age = $breed = $chip_number = $status = $alergies = $diseases = $description = "";
$name_err = $admission_date_err = $box_number_err = $gender_err = $age_err = $breed_err = $status_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validations:
    include "./validations/validate_dog.php";
    $chip_number = trim($_POST["chip_number"]);
    $alergies = trim($_POST["alergies"]);
    $diseases = trim($_POST["diseases"]);
    $description = trim($_POST["description"]);

    $dog_image = $_FILES['dog_image']['name'];
    $dog_image_tmp_name = $_FILES['dog_image']['tmp_name'];
    $dog_image_folder = '../images/dogs/' . $dog_image;

    // Check input errors before inserting in database
    if (empty($name_err) && empty($admission_date_err) && empty($box_number_err) && empty($gender_err) && empty($age_err) && empty($breed_err) && empty($status_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO dog (name, admission_date, box_number, gender, birthdate, age, breed, chip_number, status, alergies, diseases, picture, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssssssssss", $p_name, $p_admission_date, $p_box_number, $p_gender, $p_birthdate, $p_age, $p_breed, $p_chip_number, $p_status, $p_alergies, $p_diseases, $p_picture, $p_description);

            // Set parameters
            $p_name = $name;
            $p_admission_date = $admission_date;
            $p_box_number = $box_number;
            $p_gender = $gender;
            $p_birthdate = $birthdate;
            $p_age = $age;
            $p_breed = $breed;
            $p_chip_number = $chip_number;
            $p_status = $status;
            $p_alergies = $alergies;
            $p_diseases = $diseases;
            $p_picture = $dog_image;
            $p_description = $description;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page and upload file
                move_uploaded_file($dog_image_tmp_name, $dog_image_folder);
                $query = "SELECT * FROM dog ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($conn, $query);
                $new = mysqli_fetch_assoc($result)['id'];
                header("location: ./read-dog.php?id=" . $new);
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
            <li class="header-item">Dodaj psa</li>
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
        <a href="../index.php?id=2" class="btn back-btn">Powrót</a>

        <article class="content detail-view">
            <h3>Podaj dane psa</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <div class="form">
                    <?php include "./form_fields/dog_form.php"; ?>
                    <div class="form-field">
                        <label>Zdjęcie</label>
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="dog_image">
                    </div>
                    </div>
                    <div class="flex-btn">
                        <input type="submit" class="btn" value="Zatwierdź">
                        <a href="../index.php?id=2" class="btn">Anuluj</a>
                    </div>
            </form>
        </article>
    </section>
</body>

</html>