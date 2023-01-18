<?php
$input_name = trim($_POST["name"]);
if (empty($input_name)) {
    $name_err = "Wprowadź nazwę produktu!";
} else {
    $name = $input_name;
}

$input_manufacturer = trim($_POST["manufacturer"]);
if (empty($input_name)) {
    $manufacturer_err = "Wprowadź producenta!";
} else {
    $manufacturer = $input_manufacturer;
}

$input_quantity = trim($_POST["quantity"]);
if (empty($input_quantity)) {
    $quantity_err = "Wprowadź ilość produktu!";
} else {
    $quantity = $input_quantity;
}

$input_category = trim($_POST["category"]);
if (empty($input_category)) {
    $category_err = "Wybierz kategorię produktu!";
} else {
    $category = $input_category;
}

$input_type = trim($_POST["type"]);
if (empty($input_type)) {
    $type_err = "Wybierz typ produktu!";
} else {
    $type = $input_type;
}
?>