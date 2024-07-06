<?php
include_once "db_con/db.php";
session_start();
unset($_SESSION['Name']);
session_destroy();
header ('location: login.php')

?>