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
            <li class="header-item">Podgląd wpisu w książeczce zdrowia</li>
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
        <?php
        require_once "../config.php";
        $id = $_GET['id'];
        if ($id) {
            $sql = "SELECT * FROM healthcard WHERE id = $id";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
        ?>
        <a href="./healthcard.php?id=<?php echo $row["dog_id"]; ?>" class="btn back-btn">Powrót</a>
        <article class="content detail-view">
                    <h3>Nr wpisu: <?php echo $row["id"]; ?></h3>
                    <div class="form">
                        <div class="form-field">
                            <h4>Czynność:</h4>
                            <p>
                                <?php echo $row["action"]; ?>
                            </p>
                        </div>
                        <div class="form-field">
                            <h4>Kategoria:</h4>
                            <p><?php echo $row["category"]; ?></p>
                        </div>
                        <div class="form-field">
                            <h4>Typ:</h4>
                            <p>
                                <?php echo $row["type"]; ?>
                            </p>
                        </div>
                        <div class="form-field">
                            <h4>Data:</h4>
                            <p>
                                <?php echo $row["date"]; ?>
                            </p>
                        </div>
                        <div class="form-field">
                            <h4>Uwagi:</h4>
                            <p>
                                <?php echo $row["notes"]; ?>
                            </p>
                        </div>
                        <div class="form-field">
                            <h4>Środki lecznicze:</h4>
                            <p>
                                <?php
                                    require_once('./medicine.php');
                                    medicine($_GET['id']);
                                ?>
                            </p>
                        </div>
                </div>

                <div class="flex-btn-even">
                    <div class="flex-btn">
                        <?php
                        if ($_SESSION['user']['group_id'] != "Pracownik biurowy") {
                            echo '<a href="./update-healthcard.php?id=' . $row['id'] . '" class="btn" title="Edytuj">Edytuj</a>';
                            echo '<a href="./delete-healthcard.php?id=' . $row['id'] . '" class="btn btn-danger" title="Usuń">Usuń</a>';
                        }
                        ?>
                    </div>
                    <?php
                        if ($_SESSION['user']['group_id'] != "Pracownik biurowy") {
                            echo '<a href="./create-medicine.php?id=' . $row['id'] . '" class="btn" title="Dodaj środek leczniczy">Dodaj środek leczniczy</a>';
                        }
                        ?>
                </div>
                <?php
                }
            } else {
                echo "<h4>Nie znaleziono wpisu</h4>";
            }
            ?>
            </div>
</body>

</html>