<?php
    if (isset($_SESSION['user']) && in_array($_SESSION['user']['group_id'], array("Weterynarz", "Behawiorysta", "Pracownik biurowy"))) {
        header("Location: ./php/nopermission.php");
        exit;
    }
?>
<section>
    <a href="./index.php" class="btn back-btn">Powrót</a>

    <div class="flex-btn">
        <a href="./php/create-warehouse.php" class="btn">Dodaj wpis magazynowy <i class="fa fa-plus"></i></a>
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
                        <optgroup label="Data przybycia">
                            <option value="arrival_date ASC">Rosnąco</option>
                            <option value="arrival_date DESC">Malejąco</option>
                        </optgroup>
                        <optgroup label="Data ważności">
                            <option value="expiry_date ASC">Rosnąco</option>
                            <option value="expiry_date DESC">Malejąco</option>
                        </optgroup>
                        <optgroup label="Ilość">
                            <option value="quantity ASC">Rosnąco</option>
                            <option value="quantity DESC">Malejąco</option>
                        </optgroup>
                    </select>
                </div>

            <div class="form-field">
                    <a href="#" onclick="filterBtn()" id="filter_btn" class="btn">Filtruj</a>
                </div>

                <div id="filter">
                    <label for="">Produkt</label>
                    <select name="product_id" id="product_id">
                       <option value="" selected hidden>-</option>
                       <?php
                           require_once('./php/filterOptions.php');
                           filterOptions("warehouse", "product_id");
                       ?>
                    </select>
                    <label for="">Ilość</label>
                    <input type="number" name="quantity" id="quantity">
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
                if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
                    $condition = ' product_id="' . $_POST['product_id'] . '" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['quantity']) && !empty($_POST['quantity'])) {
                    $condition = ' quantity="' . $_POST['quantity'] . '" ';
                    array_push($where, $condition);
                }
                if (isset($_POST['search']) && !empty($_POST['search'])) {
                    $condition = ' id="' . $_POST['search'] . '"';
                    array_push($where, $condition);
                }

                $sql = "SELECT * FROM warehouse";
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
                            <th>Data przybycia</th>
                            <th>Data ważności</th>
                            <th>Ilość</th>
                            <th>Produkt</th>
                        </tr>';

                if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $link = 'window.location="./php/read-warehouse.php?id=' . $row['id'] . '";';
                            $list .= '<tr onclick=' . "$link" . '>
                                        <td>' .  $row['id'] . '</td>
                                        <td>' . $row['arrival_date'] .'</td>
                                        <td>' .  $row['expiry_date'] . '</td>
                                        <td>' . $row['quantity'] .'</td>
                                        <td>' .  $row['product_id'] . '</td>
                                    </tr>';
                        }
                        mysqli_free_result($result);

                    } else {
                        $list .= '<tr class="alert">
                                    <td colspan="5">Brak wyników</td>
                                </tr>';
                    }
                } 
            
            echo $list;
            ?>
        </table>
    </article>
</section>