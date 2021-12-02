<?php
/* The user profile page  */

require_once 'check-login.php';
require_once 'connect.php';

$stmt = mysqli_stmt_init($link);
$query = 'SELECT password, email FROM users WHERE id = ?';

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $password, $email);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}

$html = file_get_contents('profile.html');
$substring = explode("<!--===account===-->", $html, 3);
echo $substring[0];
$return = str_replace("---username---", $_SESSION['name'], $substring[1]);
$return = str_replace("---password---", $password, $return);
$return = str_replace("---email---", $email, $return);
echo $return;
echo $substring[2];
mysqli_close($link);

?>

