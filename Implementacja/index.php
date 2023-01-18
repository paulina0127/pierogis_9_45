<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Schronisko "Bezpieczna Przystań"</title>
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/icons/css/all.css" />
    <script src="./js/index.js"></script>
</head>

<body>
    <header>
        <ul class="header">
            <?php
                session_start();
                ob_start();
                error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
                require_once('authenticate.php');

                if (isset($_SESSION['user'])) {
                    $header = '<li class="header-item"><b>Zalogowano jako:</b> ';
                    $header .= $_SESSION['user']['group_id'] . ' ' . $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] . '</li>';

                    $header .= '<li class="header-item">';
                    if ($_GET['id'] == null || $_GET['id'] == 1) {
                        $header .= 'Ekran główny';
                    } elseif($_GET['id'] == 2) {
                        $header .= 'Psy';
                    } elseif($_GET['id'] == 3) {
                        $header .= 'Adoptujący';
                    } elseif($_GET['id'] == 4) {
                        $header .= 'Adopcje';
                    } elseif($_GET['id'] == 5) {
                        $header .= 'Katalog produktów';
                    } elseif($_GET['id'] == 6) {
                        $header .= 'Magazyn';
                    }
                    $header .= '</li><li class="header-item"><form method="POST"><input type="submit" name="logout" class="btn" value="Wyloguj" />
                      </form></li>';
                    }
                else {
                        $header = '<li class="header-item">Ekran logowania</li>';
                    }
                
                echo $header;

                if (isset($_POST['logout'])) {
                    session_unset();
                    header("Location: ./index.php");
                    exit;
                }

            ?>
        </ul>
    </header>

    <?php
        if (isset($_SESSION['user'])) { 
            if ($_GET['id'] == null || $_GET['id'] == 1) {
                include('./php/main.php');
            } elseif($_GET['id'] == 2) {
                include('./php/dogs.php');
            } elseif($_GET['id'] == 3) {
                include('./php/adopters.php');
            } elseif($_GET['id'] == 4) {
                include('./php/adoptions.php');
            } elseif($_GET['id'] == 5) {
                include('./php/products.php');
            } elseif($_GET['id'] == 6) {
                include('./php/warehouse.php');
            }
        }
        else {
            include('./php/login.php');
        }
        
    ?>
</body>
</html>