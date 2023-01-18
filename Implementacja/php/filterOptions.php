<?php
    require_once('./config.php');
    function filterOptions($table, $column) {
        global $conn;

        $query = "SELECT DISTINCT(" . $column . ") FROM " . $table;
        $result = mysqli_query($conn, $query);
        $options = '';

        while ($row = mysqli_fetch_array($result)) {
            $options .= '<option value="' . $row[$column] . '">' . $row[$column] . '</option>';

        }
        echo $options;
    }
?>