<?php

/* Page to edit a blog post */

require_once 'check-login.php';
require_once 'connect.php';

$html = file_get_contents('editpost.html');
$substring = explode("<!--===post===-->", $html, 3);
echo $substring[0];
$postID = $_POST['postID'];
$result = mysqli_query($link, "SELECT * FROM blogposts WHERE postID='$postID'");
if (!$result) echo "SELECT failed: " . mysqli_error($link);

while ($row = mysqli_fetch_array($result)) {
    $oldtitle = $row[0];
    $oldcontent = $row[1];
    $olddate = $row[2];

    $return = str_replace("---old-title---", $oldtitle, $substring[1]);
    $return = str_replace("---old-content---", $oldcontent, $return);
    $return = str_replace("---post-id---", $postID, $return);
    $return = str_replace("---old-date---", $olddate, $return);
    echo $return;
}

echo $substring[2];
mysqli_close($link);


