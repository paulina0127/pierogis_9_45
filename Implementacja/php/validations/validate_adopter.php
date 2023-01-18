<?php
$input_name = trim($_POST["name"]);
if (empty($input_name)) {
    $name_err = "Wprowadź imię adoptującego!";
} else {
    $name = $input_name;
}

$input_surname = trim($_POST["surname"]);
if (empty($input_surname)) {
    $surname_err = "Wprowadź nazwisko adoptującego!";
} else {
    $surname = $input_surname;
}

$input_id_number = trim($_POST["id_number"]);
if (empty($input_id_number)) {
  $id_number_err = "Wprowadź numer dokumentu tożsamości!";
} else {
  $id_number = $input_id_number;
}

$input_address = trim($_POST["address"]);
if (empty($input_address)) {
  $address_err = "Wprowadź adres adoptującego!";
} else {
  $address = $input_address;
}

$input_email = trim($_POST["email"]);
if (empty($input_email)) {
  $email_err = "Wprowadź email adoptującego!";
} else {
  $email = $input_email;
}

$input_phone = trim($_POST["phone"]);
if (empty($input_phone)) {
    $phone_err = "Wprowadź numer telefonu adoptującego!";
} else {
    $phone = $input_phone;
}

$input_type = trim($_POST["type"]);
if (empty($input_type)) {
  $type_err = "Wybierz typ adoptującego!";
} else {
  $type = $input_type;
}
?>