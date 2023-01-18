<?php
    if (isset($_SESSION['user']) && in_array($_SESSION['user']['group_id'], array("Magazynier", "Kierownik magazynu"))) {
        header("Location: ./php/nopermission.php");
        exit;
    }
?>
<section>
    <a href="./index.php" class="btn back-btn">Powrót</a>

    <div class="flex-btn">
        <?php
            if ($_SESSION['user']['group_id'] != "Weterynarz" && $_SESSION['user']['group_id'] != "Behawiorysta") {
                    echo '<a href="./php/create-dog.php" class="btn">Dodaj psa <i class="fa fa-plus"></i></a>';
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
                        <optgroup label="Data przyjęcia">
                            <option value="admission_date ASC">Rosnąco</option>
                            <option value="admission_date DESC">Malejąco</option>
                        </optgroup>
                    </select>
                </div>

                <div class="form-field">
                    <a href="#" onclick="filterBtn()" id="filter_btn" class="btn">Filtruj</a>
                </div>
                
                <div id="filter">
                    <label for="">Płeć</label>
                    <select name="gender" id="gender">
                        <option value="" selected hidden>-</option>
                        <?php
                            require_once('./php/filterOptions.php');
                            filterOptions("dog", "gender");
                        ?>
                    </select>
                    <label for="">Rasa</label>
                    <select name="breed" id="breed">
                        <option value="" selected hidden>-</option>
                        <?php
                            filterOptions("dog", "breed");
                        ?>
                    </select>
                    <label for="">Status</label>
                    <select name="status" id="status">
                        <option value="" selected hidden>-</option>
                        <?php
                            filterOptions("dog", "status");
                        ?>
                    </select>
                    <input type="submit" value="Zastosuj" class="btn">
                </div>
            </form>
        </div>

        <div class="content-header">
            <span>Lista wszystkich psów</span>
        </div>

        <table class="table">
            <?php
                require_once "./config.php";

                $order_by = '';
                if (isset($_POST['sort']) && !empty($_POST['sort'])) {
                    $order_by = ' ORDER BY ' . $_POST['sort'];
                }

                $where = array();
                if (isset($_POST['gender']) && !empty($_POST['gender'])) {
                    $condition = ' gender="' . $_POST['gender'] . '" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['breed']) && !empty($_POST['breed'])) {
                    $condition = ' breed="' . $_POST['breed'] . '" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['status']) && !empty($_POST['status'])) {
                    $condition = ' status="' . $_POST['status'] . '" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['search']) && !empty($_POST['search'])) {
                    $condition = ' (id="' . $_POST['search'] . '" or name="' . $_POST['search'] . '")';
                    array_push($where, $condition);
                }

                $sql = "SELECT * FROM dog";
                if (count($where) != 0) {
                    $sql .= ' WHERE';
                    foreach ($where as $value) {
                        $sql .= $value . 'and';
                    }
                    $sql = rtrim($sql, "and");
                }
                $sql .= $order_by;

                $list = '<tr>
                                    <th>Nr</th>
                                    <th>Imię</th>
                                    <th>Data przyjęcia</th>
                                    <th>Numer boksu</th>
                                    <th>Płeć</th>
                                    <th>Data urodzenia</th>
                                    <th>Wiek</th>
                                    <th>Rasa</th>
                                    <th>Numer czipa</th>
                                    <th>Status</th>
                                </tr>';

                if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {                        
                        while ($row = mysqli_fetch_array($result)) {
                            $link = 'window.location="./php/read-dog.php?id=' . $row['id'] . '";';
                            $list .= '<tr onclick=' . "$link" . '>
                                        <td>' .  $row['id'] . '</td>
                                        <td>' . $row['name'] .'</td>
                                        <td>' . $row['admission_date'] .'</td>
                                        <td>' .  $row['box_number'] . '</td>
                                        <td>' .  $row['gender'] . '</td>
                                        <td>' . $row['birthdate'] .'</td>
                                        <td>' .  $row['age'] . '</td>
                                        <td>' .  $row['breed'] . '</td>
                                        <td>' . $row['chip_number'] .'</td>
                                        <td>' . $row['status'] .'</td>
                                    </tr>';
                        }
                        mysqli_free_result($result);

                    } else {
                        $list .= '<tr class="alert">
                                    <td colspan="10">Brak wyników</td>
                                </tr>';
                    }
                } 
            
            echo $list;
            ?>
        </table>
    </article>
</section>