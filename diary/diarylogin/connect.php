<?php

/* Connects to a database on Stockholm University */

$hn = 'atlas.dsv.su.se';
$db = 'db_20467064';
$un = 'usr_20467064';
$pw = '467064';

$link = mysqli_connect($hn, $un, $pw, $db);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>