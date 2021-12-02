<?php
/* User authentication that is called after user loggs in */

session_start();
require_once 'connect.php';

if (!isset($_POST['username'], $_POST['password'])) {
    exit('Please fill both the username and password fields!');
}

$stmt = mysqli_stmt_init($link);
$query = 'SELECT id, password FROM users WHERE username = ?';

if (mysqli_stmt_prepare($stmt, $query)) {
    $username = strip_tags($_POST['username']);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {

        mysqli_stmt_bind_result($stmt, $id, $password);
        mysqli_stmt_fetch($stmt);

        if ($_POST['password'] === $password) {
            echo "success";
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $username;
            $_SESSION['id'] = $id;
        } else {
            echo 'Incorrect password!';
        }
    } else {
        echo 'Incorrect username!';
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($link);
?>