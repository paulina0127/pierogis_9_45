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
    <script src="../js/index.js"></script>
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
        <li class="header-item">Książeczka zdrowia Nr: <?php echo $_GET['id']?></li>
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
    <a href="./read-dog.php?id=<?php echo $_GET['id'];?>" class="btn back-btn">Powrót</a>

    <div class="flex-btn">
        <?php if ($_SESSION['user']['group_id'] != "Pracownik biurowy") {
                echo '<a href="./create-healthcard.php?id=' . $_GET['id'] . '" class="btn">Zarejestruj nową czynność <i class="fa fa-plus"></i></a>';
            }
        ?>
    </div>

    <article class="content">
        <div class="content-header search">
            <form action="" method="post" class="search">
                <div class="form-field">
                    <input type="text" name="search" id="search" placeholder="Wyszukaj" />
                </div>
                <button type="submit" class="search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

                <div class="form-field">
                    <select onchange="this.form.submit()" name="sort" id="sort_id" class="btn">
                        <option value="" selected disabled hidden>Sortuj</option>
                        <optgroup label="Nr">
                            <option value="id ASC">Rosnąco</option>
                            <option value="id DESC">Malejąco</option>
                        </optgroup>
                        <optgroup label="Data">
                            <option value="date ASC">Rosnąco</option>
                            <option value="date DESC">Malejąco</option>
                        </optgroup>
                    </select>
                </div>

                <div class="form-field">
                    <a href="#" onclick="filterBtn()" id="filter_btn" class="btn">Filtruj</a>
                </div>

                <div id="filter">
                    <label for="">Kategoria</label>
                    <select name="category" id="category">
                        <option value="" selected hidden>-</option>
                        <?php
                            require_once('../config.php');
                            global $conn;

                            $query = "SELECT DISTINCT(category) FROM healthcard";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value="' . $row['category'] . '">' . $row['category'] . '</option>';
                            
                            }
                        ?>
                    </select>
                    <label for="">Typ</label>
                    <select name="type" id="type">
                        <option value="" selected hidden>-</option>
                        <?php
                            $query = "SELECT DISTINCT(type) FROM healthcard";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value="' . $row['type'] . '">' . $row['type'] . '</option>';
                            
                            }
                        ?>
                    </select>
                    <input type="submit" value="Zastosuj" class="btn">
                    </div>
            </form>
        </div>

        <div class="content-header">
            <span>Lista wszystkich wpisów</span>
        </div>

        <table class="table">
            <?php
            require_once "../config.php";
                $order_by = '';
                if (isset($_POST['sort']) && !empty($_POST['sort'])) {
                    $order_by = ' ORDER BY ' . $_POST['sort'];
                }
                
                $where = array();
                $id = $_GET['id'];
                if (isset($_POST['category']) && !empty($_POST['category'])) {
                    $condition = ' category="' . $_POST['category'] . '" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['type']) && !empty($_POST['type'])) {
                    $condition = ' type="' . $_POST['type'] . '" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['search']) && !empty($_POST['search'])) {
                    $condition = ' (id="' . $_POST['search'] . '" or action LIKE "%' . $_POST['search'] . '%")';
                    array_push($where, $condition);
                }

                $sql = "SELECT * FROM healthcard WHERE dog_id=$id";
                if (count($where) != 0) {
                    $sql .= ' and';
                    foreach ($where as $value) {
                        $sql .= $value . 'and';
                    }
                    $sql = rtrim($sql, "and");
                }
                $sql .= $order_by;

                $list = '<tr>
                            <th>Nr</th>
                            <th>Czynność</th>
                            <th>Kategoria</th>
                            <th>Typ</th>
                            <th>Data</th>
                            <th>Uwagi</th>
                        </tr>';

                if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $link = 'window.location="./read-healthcard.php?id=' . $row['id'] . '";';
                            $list .= '<tr onclick=' . "$link" . '>
                                        <td>' .  $row['id'] . '</td>
                                        <td>' . $row['action'] .'</td>
                                        <td>' .  $row['category'] . '</td>
                                        <td>' . $row['type'] .'</td>
                                        <td>' .  $row['date'] . '</td>
                                        <td>' . $row['notes'] .'</td>
                                    </tr>';
                        }
                        mysqli_free_result($result);

                    } else {
                        $list .= '<tr class="alert">
                                    <td colspan="6">Brak wyników</td>
                                </tr>';
                    }
                } 
            
            echo $list;
            ?>
        </table>
    </article>
</section>
</body>
</html>