<?php
/* Adds a new category */

require_once 'check-login.php';
require_once 'connect.php';

if (isset($_POST['newcategory'])) {
    $newcategory = $_POST['newcategory'];
    $result = mysqli_query($link, "INSERT INTO category VALUES" . "(NULL, '$newcategory')");
    if (!$result) echo "INSERT failed: " . mysqli_error($link);
}

mysqli_close($link);
header("Location: writepost.php");

?>