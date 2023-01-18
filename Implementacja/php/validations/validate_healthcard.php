<?php
$input_action = trim($_POST["action"]);
if (empty($input_action)) {
  $action_err = "Wprowadź czynność!";
} else {
  $action = $input_action;
}

$input_category = trim($_POST["category"]);
if (empty($input_category)) {
  $category_err = "Wybierz kategorię czynności!";
} else {
  $category = $input_category;
}

$input_type = trim($_POST["type"]);
if (empty($input_type)) {
  $type_err = "Wybierz typ czynności!";
} else {
  $type = $input_type;
}

$input_date = trim($_POST["date"]);
if (empty($input_date)) {
  $date_err = "Wprowadź datę!";
} else {
  $date = $input_date;
}
?>