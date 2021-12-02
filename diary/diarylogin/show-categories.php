<?php
/* Prints the categories in the header */

require_once 'check-login.php';
require_once 'connect.php';

$html = file_get_contents("home.html");
$substring = explode("<!--===categories===-->", $html, 3);

$result = mysqli_query($link, "SELECT * FROM category");
if (!$result) echo "SELECT failed: " . mysqli_error($link);
while ($row = mysqli_fetch_array($result)) {
    $return = str_replace("---cat-id---", $row[0], $substring[1]);
    $return = str_replace("---category---", $row[1], $return);
    echo $return;
}

mysqli_close($link);

?>
