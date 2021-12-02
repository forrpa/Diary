<?php

/* Page to write new blog post */

require_once 'check-login.php';
require_once 'connect.php';

$html = file_get_contents('writepost.html');
$substring = explode("<!--===postcategories===-->", $html, 3);
echo $substring[0];

$result = mysqli_query($link, "SELECT title FROM category");
if (!$result) echo "SELECT failed: " . mysqli_error($link);

while ($row = mysqli_fetch_array($result)) {
    $return = str_replace("---post-category---", $row[0], $substring[1]);
    echo $return;

}
echo $substring[2];
mysqli_close($link);
