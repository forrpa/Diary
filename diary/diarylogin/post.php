<?php
/* Shows a specific post */

require_once 'check-login.php';
require_once 'connect.php';

if (isset($_POST['title']) && isset($_POST['category']) && isset($_POST['content'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    $blogpostresult = mysqli_query($link, "INSERT INTO blogposts VALUES" . "('$title', '$content', NULL, NULL)");
    if (!$blogpostresult) echo "INSERT failed: " . mysqli_error($link);

    $maxresult = mysqli_query($link, "SELECT MAX(postID) FROM blogposts");
    if (!$maxresult) echo "SELECT failed: " . mysqli_error($link);

    mysqli_data_seek($maxresult, 0);
    $maxrow = mysqli_fetch_array($maxresult);
    $postID = $maxrow[0];

    $categoryresult = mysqli_query($link, "SELECT * FROM category WHERE title='$category'");
    if (!$categoryresult) echo "SELECT failed: " . mysqli_error($link);

    mysqli_data_seek($categoryresult, 0);
    $categoryrow = mysqli_fetch_array($categoryresult);
    $catID = $categoryrow[0];
    $postcategoryresult = mysqli_query($link, "INSERT INTO post_category VALUES" . "('$postID', '$catID')");
    if (!$postcategoryresult) echo "INSERT failed: " . mysqli_error($link);

}

header("Location: home.php");
mysqli_close($link);

?>
