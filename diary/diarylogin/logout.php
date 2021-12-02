<?php
/* User logges out from database */

session_start();
session_destroy();
header('Location: index.html');
?>