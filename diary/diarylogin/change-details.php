<?php
/* If user changes username, password or email */

require_once 'check-login.php';
require_once 'connect.php';

$id = $_SESSION['id'];

if (isset($_POST['usernameHidden']) && isset($_POST['username'])) {
    $username = $_POST['username'];
    $result = mysqli_query($link, "UPDATE users SET username='$username' WHERE id='$id'");
    if (!$result) {
        echo "UPDATE failed: " . mysqli_error($link);
    } else {
        $_SESSION['name'] = $username;
    }
} else if (isset($_POST['passwordHidden']) && isset($_POST['password'])) {
    $password = $_POST['password'];
    $result = mysqli_query($link, "UPDATE users SET password='$password' WHERE id='$id'");
    if (!$result) {
        echo "UPDATE failed: " . mysqli_error($link);
    }
} else if (isset($_POST['emailHidden']) && isset($_POST['email'])) {
    $email = $_POST['email'];
    $result = mysqli_query($link, "UPDATE users SET email='$email' WHERE id='$id'");
    if (!$result) {
        echo "UPDATE failed: " . mysqli_error($link);
    }
}

mysqli_close($link);
header("Location: profile.php");


?>