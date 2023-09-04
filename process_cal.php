<?php
include_once "db_con/db.php";

$identry = $_GET['id'];
$select = "SELECT * FROM `b-house_fam` WHERE id = '$identry'";
$result = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($result);


$total_amount_due = $_POST['total_amount_due'];
$total_amount_due = round($total_amount_due, 2);

$f_pres = $_POST['1flr_pres_bill'];
$f_prev = $_POST['1flr_prev_bill'];
$s_pres = $_POST['2flr_pres_bill'];
$s_prev = $_POST['2flr_prev_bill'];
$t_pres = $_POST['3flr_pres_bill'];
$t_prev = $_POST['3flr_prev_bill'];
$frt_pres = $_POST['4flr_pres_bill'];
$frt_prev = $_POST['4flr_prev_bill'];

    // compute cu/m
    $cu1 = $f_pres - $f_prev;
    $cu2 = $s_pres - $s_prev;
    $cu3 = $t_pres - $t_prev;
    $cu4 = $frt_pres - $frt_prev;

    // total cu/m
    $total_cu = $cu1 + $cu2 + $cu3 + $cu4;

    $total_cubic = $total_amount_due / $total_cu;
    
    $f_floor_total_calculated = $total_price * $cu1;
    $s_floor_total_calculated = $total_price * $cu2;
    $t_floor_total_calculated = $total_price * $cu3;
    $frt_floor_total_calculated = $total_price * $cu4;


?>