<?php
$name = "localhost";
$server = "root";
$pass = "1003669.tsd";
$dbname = "water_bill";

$con = mysqli_connect($name, $server, $pass, $dbname);

if(!$con){
    mysqli_connect_error();
}else{
    // echo "connected!";
}
?>