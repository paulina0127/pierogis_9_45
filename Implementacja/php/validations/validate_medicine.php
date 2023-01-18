<?php
$input_product_id = trim($_POST["product_id"]);
if (empty($input_product_id)) {
  $product_id_err = "Wybierz środek leczniczy!";
} else {
  $product_id = $input_product_id;
}

$input_dosage = trim($_POST["dosage"]);
if (empty($input_dosage)) {
  $dosage_err = "Wprowadź dawkę!";
} else {
  $dosage = $input_dosage;
}
?>