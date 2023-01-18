<?php
require_once('../config.php');

function medicine($id) {
    global $conn;
    $sql = "SELECT * FROM medicine WHERE entry_id=$id";
    $list = '';
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $query = "SELECT * FROM product WHERE id=" . $row['product_id'];
                $product_result = mysqli_query($conn, $query);
                $product = mysqli_fetch_array($product_result);

                $list .= $product['manufacturer'] . ' ' . $product['name'] . ', ' . $row['dosage']. ' ';
                if ($_SESSION['user']['group_id'] != "Pracownik biurowy") {
                    $list .= '<a href="./update-medicine.php?id=' . $row['id'] . '&entry_id=' . $id. '" class="btn-simple">Edytuj</a>';
                    $list .= '<a href="./delete-medicine.php?id=' . $row['id'] . '" class="btn-simple">Usuń</a>';
                }
                $list .= '<br />';
                }
                mysqli_free_result($result);
                mysqli_free_result($product_result);
            }
        } 
                
    echo $list;
}
?>