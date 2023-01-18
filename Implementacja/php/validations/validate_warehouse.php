<?php
$input_date1 = trim($_POST["date1"]);
if (empty($input_date1)) {
  $date1_err = "Wprowadź datę przybycia produktu!";
} else {
  $date1 = $input_date1;
}

$input_date2 = trim($_POST["date2"]);
if (empty($input_date2)) {
  $date2_err = "Wprowadź datę ważności produktu!";
} else {
  $date2 = $input_date2;
}

$input_product_id = trim($_POST["product_id"]);
if (empty($input_product_id)) {
  $product_id_err = "Wprowadź id produktu!";
} elseif(!((is_int($input_product_id) || ctype_digit($input_product_id)) && (int)$input_product_id > 0)) {
  $product_id_err = "Id produktu musi być dodatnią liczbą całkowitą!";
} elseif(!(is_exist("product", $input_product_id))) {
  $product_id_err = 'W bazie nie istnieje produkt o id ' . $input_product_id;
} else {
  $product_id = $input_product_id;
}

$input_quantity = trim($_POST["quantity"]);
if (empty($input_quantity)) {
  $quantity_err = "Wprowadź ilość produktu!";
} elseif(!((is_int($input_quantity) || ctype_digit($input_quantity)) && (int)$input_quantity > 0)) {
  $quantity_err = "Ilość musi być dodatnią liczbą całkowitą!";
} else {
  $quantity = $input_quantity;
}
?>