<?php
    if (isset($_SESSION['user']) && in_array($_SESSION['user']['group_id'], array("Weterynarz", "Behawiorysta", "Magazynier", "Kierownik magazynu"))) {
        header("Location: ./php/nopermission.php");
        exit;
    }
?>
<section>
    <a href="./index.php" class="btn back-btn">Powrót</a>

    <div class="flex-btn">
        <a href="./php/create-adopter.php" class="btn">Dodaj adoptującego <i class="fa fa-plus"></i></a>
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
                        <optgroup label="ID">
                            <option value="id ASC">Rosnąco</option>
                            <option value="id DESC">Malejąco</option>
                        </optgroup>
                        <optgroup label="Nazwisko">
                            <option value="surname ASC">Rosnąco</option>
                            <option value="surname DESC">Malejąco</option>
                        </optgroup>
                    </select>
                </div>

                <div class="form-field">
                        <a href="#" onclick="filterBtn()" id="filter_btn" class="btn">Filtruj</a>
                    </div>

                    <div id="filter">
                        <label for="">Typ</label>
                        <select name="type" id="type">
                            <option value="" selected hidden>-</option>
                            <?php
                                require_once('./php/filterOptions.php');
                                filterOptions("adopter", "type");
                            ?>

                        </select>
                        <input type="submit" value="Zastosuj" class="btn">
                    </div>
            </form>     
        </div>

        <div class="content-header">
            <span>Lista wszystkich adoptujących</span>
        </div>

        <table class="table">
            <?php
            require_once "./config.php";
                $order_by = '';
                if (isset($_POST['sort']) && !empty($_POST['sort'])) {
                    $order_by = ' ORDER BY ' . $_POST['sort'];
                }

                $where = array();
                if (isset($_POST['type']) && !empty($_POST['type'])) {
                    $condition = ' type="' . $_POST['type'] . '" ';
                    array_push($where, $condition);
                }

                if (isset($_POST['search']) && !empty($_POST['search'])) {
                    $condition = ' (id="' . $_POST['search'] . '" or CONCAT(name, surname) LIKE "%' . $_POST['search'] . '%")';
                    array_push($where, $condition);
                }

                $sql = "SELECT * FROM adopter";
                if (count($where) != 0) {
                    $sql .= ' WHERE';
                    foreach ($where as $value) {
                        $sql .= $value . 'and';
                    }
                    $sql = rtrim($sql, "and");
                }
                $sql .= $order_by;

                $list = '<tr>
                                <th>ID</th>
                                <th>Imię</th>
                                <th>Nazwisko</th>
                                <th>Numer dowodu</th>
                                <th>Adres</th>
                                <th>Email</th>
                                <th>Numer telefonu</th>
                                <th>Typ</th>
                                <th>Uwagi</th>
                            </tr>';

                if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $link = 'window.location="./php/read-adopter.php?id=' . $row['id'] . '";';
                            $list .= '<tr onclick=' . "$link" . '>
                                        <td>' .  $row['id'] . '</td>
                                        <td>' . $row['name'] .'</td>
                                        <td>' .  $row['surname'] . '</td>
                                        <td>' . $row['id_number'] .'</td>
                                        <td>' .  $row['address'] . '</td>
                                        <td>' . $row['email'] .'</td>
                                        <td>' . $row['phone'] .'</td>
                                        <td>' . $row['type'] .'</td>
                                        <td>' . $row['notes'] .'</td>
                                    </tr>';
                        }
                        mysqli_free_result($result);

                    } else {
                        $list .= '<tr class="alert">
                                    <td colspan="9">Brak wyników</td>
                                </tr>';
                    }
                } 

            echo $list;
            ?>
        </table>
    </article>
</section>