<?php

/* Update post after edit */

require_once 'check-login.php';
require_once 'connect.php';

$title = $_POST['newtitle'];
$content = $_POST['newcontent'];
$postID = $_POST['postID'];
$date = $_POST['date'];

$result = mysqli_query($link, "UPDATE blogposts SET title='$title', content='$content', date='$date' WHERE postID='$postID'");
if (!$result) echo "UPDATE failed: " . mysqli_error($link);

mysqli_close($link);
header("Location: home.php");


?>