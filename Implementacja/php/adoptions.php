<?php
    if (isset($_SESSION['user']) && in_array($_SESSION['user']['group_id'], array("Weterynarz", "Behawiorysta", "Magazynier", "Kierownik magazynu"))) {
        header("Location: ./php/nopermission.php");
        exit;
    }
?>
<section>
    <a href="./index.php" class="btn back-btn">Powrót</a>

    <div class="flex-btn">
        <a href="./php/create-adoption.php" class="btn">Dodaj wpis adopcyjny <i class="fa fa-plus"></i></a>
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
                    <label for="type">Typ</label>
                    <select name="type" id="type">
                        <option value="" selected hidden>-</option>
                        <?php
                            require_once('./php/filterOptions.php');
                            filterOptions("adoption", "type");
                        ?>
                    </select>
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="" selected hidden>-</option>
                        <?php
                            filterOptions("adoption", "status");
                        ?>
                    </select>
                    <label for="dog_id">Pies</label>
                    <select name="dog_id" id="dog_id">
                        <option value="" selected hidden>-</option>
                        <?php
                            filterOptions("adoption", "dog_id");
                        ?>
                    </select>
                    <label for="adopter_id">Adoptujący</label>
                    <select name="adopter_id" id="adopter_id">
                        <option value="" selected hidden>-</option>
                        <?php
                            filterOptions("adoption", "adopter_id");
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
            require_once "./config.php";
                $order_by = '';
                if (isset($_POST['sort']) && !empty($_POST['sort'])) {
                    $order_by = ' ORDER BY ' . $_POST['sort'];
                }

                $where = array();
                if (isset($_POST['type']) && !empty($_POST['type'])) {
                    $condition .= ' type="' . $_POST['type'] . '" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['status']) && !empty($_POST['status'])) {
                    $condition = ' status="' . $_POST['status'] . '" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['dog_id']) && !empty($_POST['dog_id'])) {
                    $condition = ' dog_id="' . $_POST['dog_id'] . '" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['adopter_id']) && !empty($_POS['adopter_id'])) {
                    $condition = ' adopter_id="' . $_POST['adopter_id'] .'" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['search']) && !empty($_POST['search'])) {
                    $condition = ' id="' . $_POST['search'] . '"';
                    array_push($where, $condition);
                }

                $sql = "SELECT * FROM adoption";
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
                                <th>Data</th>
                                <th>Status</th>
                                <th>Typ</th>
                                <th>Pies</th>
                                <th>Adoptujący</th>
                                <th>Uwagi</th>
                            </tr>';

                if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $link = 'window.location="./php/read-adoption.php?id=' . $row['id'] . '";';
                            $list .= '<tr onclick=' . "$link" . '>
                                        <td>' .  $row['id'] . '</td>
                                        <td>' . $row['date'] .'</td>
                                        <td>' .  $row['status'] . '</td>
                                        <td>' . $row['type'] .'</td>
                                        <td>' .  $row['dog_id'] . '</td>
                                        <td>' . $row['adopter_id'] .'</td>
                                        <td>' . $row['notes'] .'</td>
                                    </tr>';
                        }
                        mysqli_free_result($result);

                    } else {
                        $list .= '<tr class="alert">
                                    <td colspan="7">Brak wyników</td>
                                </tr>';
                    }
                } 

            echo $list;
            ?>
        </table>
    </article>
</section>