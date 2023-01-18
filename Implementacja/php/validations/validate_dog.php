<?php
// Validations:
$input_name = trim($_POST["name"]);
if (empty($input_name)) {
    $name_err = "Wprowadź imię psa!";
} else {
    $name = $input_name;
}

$input_admission_date = trim($_POST["admission_date"]);
if (empty($input_admission_date)) {
    $admission_date_err = "Wprowadź datę przyjęcia psa!";
} else {
    $admission_date = $input_admission_date;
}

$input_box_number = trim($_POST["box_number"]);
if (empty($input_box_number)) {
    $box_number_err = "Wprowadź numer boksu!";
} elseif (!((is_int($input_box_number) || ctype_digit($input_box_number)) && (int) $input_box_number > 0)) {
    $box_number_err = "Numer boksu musi być dodatnią liczbą całkowitą!";
} else {
    $box_number = $input_box_number;
}

$input_gender = trim($_POST["gender"]);
if (empty($input_gender)) {
    $gender_err = "Wybierz płeć!";
} else {
    $gender = $input_gender;
}

$input_birthdate = trim($_POST["birthdate"]);
if (empty($_POST["birthdate"])) {
    $birthdate = NULL;
} else {
    $birthdate = $input_birthdate;
}

$input_age = trim($_POST["age"]);
if (empty($input_age)) {
    $age_err = "Wprowadź wiek psa!";
} else {
    $age = $input_age;
}

$input_breed = trim($_POST["breed"]);
if (empty($input_breed)) {
    $breed_err = "Wprowadź rasę psa!";
} else {
    $breed = $input_breed;
}

$input_status = trim($_POST["status"]);
if (empty($input_status)) {
    $status_err = "Wybierz status!";
} else {
    $status = $input_status;
}
?>