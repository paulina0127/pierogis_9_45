<?php
    if (isset($_SESSION['user']) && in_array($_SESSION['user']['group_id'], array("Weterynarz", "Behawiorysta", "Pracownik biurowy"))) {
        header("Location: ./php/nopermission.php");
        exit;
    }
?>
<section>
    <a href="./index.php" class="btn back-btn">Powrót</a>

    <div class="flex-btn">
        <?php
            if ($_SESSION['user']['group_id'] != "Magazynier") {
                echo '<a href="./php/create-product.php" class="btn">Dodaj produkt <i class="fa fa-plus"></i></a>';
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
                        <optgroup label="Id">
                            <option value="id ASC">Rosnąco</option>
                            <option value="id DESC">Malejąco</option>
                        </optgroup>
                    </select>
                </div>

                <div class="form-field">
                    <a href="#" onclick="filterBtn()" id="filter_btn" class="btn">Filtruj</a>
                </div>

                <div id="filter">
                        <label for="">Producent</label>
                        <select name="manufacturer" id="manufacturer">
                            <option value="" selected hidden>-</option>
                            <?php
                                require_once('./php/filterOptions.php');
                                filterOptions("product", "manufacturer");
                            ?>

                        </select>
                        <label for="">Kategoria</label>
                        <select name="category" id="category">
                            <option value="" selected hidden>-</option>
                            <?php
                                filterOptions("product", "category");
                            ?>

                        </select>
                        <label for="">Typ</label>
                        <select name="type" id="type">
                            <option value="" selected hidden>-</option>
                           <?php
                                filterOptions("product", "type");
                            ?>
                        </select>
                        <input type="submit" value="Zastosuj" class="btn">
                </div>
            </form>
        </div>

        <div class="content-header">
            <span>Lista wszystkich produktów</span>
        </div>

        <table class="table">
            <?php
            require_once "./config.php";
                $order_by = '';
                if (isset($_POST['sort']) && !empty($_POST['sort'])) {
                    $order_by = ' ORDER BY ' . $_POST['sort'];
                }
                
                $where = array();
                if (isset($_POST['category']) && !empty($_PO['category'])) {
                    $condition = ' category="' . $_POST['category'] . '" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['type']) && !empty($_POST['type'])) {
                    $condition = ' type="' . $_POST['type'] . '" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['manufacturer']) && !empty($_PO['manufacturer'])) {
                    $condition = ' manufacturer="' . $_POST['manufacturer'] . '" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['search']) && !empty($_POST['search'])) {
                    $condition = ' (id="' . $_POST['search'] . '" or CONCAT(name, manufacturer) LIKE "%' . $_POST['search'] . '%")';
                    array_push($where, $condition);
                }

            
                $sql = "SELECT * FROM product";
                if (count($where) != 0) {
                    $sql .= ' WHERE';
                    foreach ($where as $value) {
                        $sql .= $value . 'and';
                    }
                    $sql = rtrim($sql, "and");
                }
                $sql .= $order_by;

                $list = '<tr>
                                <th>Id</th>
                                <th>Nazwa</th>
                                <th>Producent</th>
                                <th>Ilość</th>
                                <th>Kategoria</th>
                                <th>Typ</th>
                            </tr>';

                if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $link = 'window.location="./php/read-product.php?id=' . $row['id'] . '";';
                            $list .= '<tr onclick=' . "$link" . '>
                                        <td>' .  $row['id'] . '</td>
                                        <td>' . $row['name'] .'</td>
                                        <td>' .  $row['manufacturer'] . '</td>
                                        <td>' . $row['quantity'] .'</td>
                                        <td>' .  $row['category'] . '</td>
                                        <td>' . $row['type'] .'</td>
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