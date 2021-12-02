<?php
/* Shows blog posts from a certain category */

require_once 'check-login.php';
require_once 'connect.php';

$html = file_get_contents("categories.html");
$substring = explode("<!--===entries===-->", $html, 3);
echo $substring[0];
$catID = $_GET['catID'];

$result = mysqli_query($link, "SELECT * FROM post_category WHERE catID='$catID' GROUP BY postID desc");
if (!$result) echo "SELECT failed: " . mysqli_error($link);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {

        $postID = $row[0];
        $blogpostsresult = mysqli_query($link, "SELECT * FROM blogposts WHERE postID='$postID'");
        if (!$blogpostsresult) echo "SELECT failed: " . mysqli_error($link);

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
    }
} else {
    header('location: empty.html');
}

echo $substring[2];
mysqli_close($link);


?>
