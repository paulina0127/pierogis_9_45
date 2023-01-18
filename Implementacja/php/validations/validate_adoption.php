<?php
$input_date = trim($_POST["date"]);
if (empty($input_date)) {
  $date_err = "Wprowadź datę!";
} else {
  $date = $input_date;
}

$input_status = trim($_POST["status"]);
if (empty($input_status)) {
    $status_err = "Wybierz status!";
} else {
    $status = $input_status;
}

$input_dog_id = trim($_POST["dog_id"]);
if (empty($input_dog_id)) {
  $dog_id_err = "Wprowadź nr ewidencyjny psa!";
} elseif(!((is_int($input_dog_id) || ctype_digit($input_dog_id)) && (int)$input_dog_id > 0)) {
  $dog_id_err = "Nr ewidencyjny psa musi być dodatnią liczbą całkowitą!";
} elseif(!(is_exist("dog", $input_dog_id))) {
  $dog_id_err = 'W bazie nie istnieje pies o nr ewidencyjnym ' . $input_dog_id;
} else {
  $dog_id = $input_dog_id;
}

$input_adopter_id = trim($_POST["adopter_id"]);
if (empty($input_adopter_id)) {
  $adopter_id_err = "Wprowadź id adoptującego!";
} elseif(!((is_int($input_adopter_id) || ctype_digit($input_adopter_id)) && (int)$input_adopter_id > 0)) {
  $adopter_id_err = "Id adoptującego musi być dodatnią liczbą całkowitą!";
} elseif(!(is_exist("adopter", $input_adopter_id))) {
  $adopter_id_err = 'W bazie nie istnieje adoptujący o id ' . $input_adopter_id;
} else {
  $adopter_id = $input_adopter_id;
}

$input_type = trim($_POST["type"]);
if (empty($input_type)) {
    $type_err = "Wybierz typ adopcji!";
} else {
    $type = $input_type;
}
?>