<?php
/* Home page which prints out the latest blog posts */

require_once 'check-login.php';
require_once 'connect.php';

$html = file_get_contents("home.html");
$substring = explode("<!--===entries===-->", $html, 3);
echo $substring[0];

if (isset($_POST['delete']) && isset($_POST['postID'])) {
    $postID = $_POST['postID'];
    $deleteResult = mysqli_query($link, "DELETE FROM blogposts WHERE postID='$postID'");
    if (!$deleteResult) echo "DELETE failed: " . mysqli_error($link);
}

$blogpostsresult = mysqli_query($link, "SELECT * FROM blogposts ORDER BY date desc limit 15");
if (!$blogpostsresult) echo "SELECT failed: " . mysqli_error($link);

if (mysqli_num_rows($blogpostsresult) > 0) {

    while ($blogpostsrow = mysqli_fetch_array($blogpostsresult)) {
        $return = str_replace("---date---", $blogpostsrow[2], $substring[1]);
        $return = str_replace("---title---", $blogpostsrow[0], $return);
        $return = str_replace("---content---", $blogpostsrow[1], $return);

        $postcategoryresult = mysqli_query($link, "SELECT catID FROM post_category WHERE postID=$blogpostsrow[3]");
        if (!$postcategoryresult) echo "SELECT failed: " . mysqli_error($link);

        while ($postcategoryrow = mysqli_fetch_array($postcategoryresult)) {
            $catID = $postcategoryrow[0];
            $categoryresult = mysqli_query($link, "SELECT title FROM category WHERE catID=$catID");
            if (!$categoryresult) echo "SELECT failed: " . mysqli_error($link);
            $categoryrow = mysqli_fetch_array($categoryresult);
            $category = $categoryrow[0];
            $return = str_replace("---entry-catID---", $catID, $return);
            $return = str_replace("---entry-category---", $category, $return);
        }
        $return = str_replace("---postID---", $blogpostsrow[3], $return);
        echo $return;
    }
} else {
    header('Location: empty.html');
}
echo $substring[2];

mysqli_close($link);


?>
