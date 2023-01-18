<?php
require_once('config.php');

function authenticate($username, $password) {
    global $conn;

    $username_clear = htmlspecialchars($username);
    $password_clear = htmlspecialchars($password);
    $password_clear = base64_encode($password_clear);
    $query = "SELECT * FROM auth_user WHERE username='$username_clear' and password='$password_clear' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (!empty($row)) {
        $id = $row['group_id'];
        $query = "SELECT name FROM auth_group WHERE id='$id' LIMIT 1";
        $result = mysqli_query($conn, $query);
        $name = mysqli_fetch_assoc($result)['name'];
        $row['group_id'] = $name;
        return $row;
    }
}
?>