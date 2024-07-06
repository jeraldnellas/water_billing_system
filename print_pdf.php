<?php
include_once "db_con/db.php";
require('pdf_gen/fpdf.php');
$identry = $_GET['id'];
$select = "SELECT * FROM `b-house_fam` WHERE id = '$identry'";
$result = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($result);
$remarks = $row['remarks'];
if($remarks == "Paid"){
  $msg[] = '<span class="green white-text btn-flat">'.$remarks.'</span>';
}elseif($remarks == "Unpaid"){
  $msg[] = '<span class="red white-text btn-flat">'.$remarks.'</span>';
}else{
  $msg[] = '<span class="btn-flat purple white-text">NO REMARKS SELECTED!</span>';
}


$pdf = new FPDF('L', 'mm', "Letter");

$pdf->AddPage();
$pdf->SetFont('Arial','B',20);
$pdf-> Ln(10).
// title
$pdf->SetX((185)/5);
$pdf->MultiCell(208, 5, 'B-HOUSE MAYNILAD WATER BILLING',0,'C', false);
$pdf -> ln(10);
$pdf->SetX((185)/5);
$pdf->SetTextColor(220,50,50);
$pdf->MultiCell(208, 5, 'Breakdown Summary',0,'C', false);
$pdf->SetTextColor(0,0,0);
$pdf-> Ln(10).
$pdf->SetX((190)/5);
$pdf->SetFont('Arial','',11);
$pdf->Cell(170, 5, 'This billing is for the month of '. $row['date_bill'].' - '.$row['to_date_bill'].' '. $row['year'],0,'0',);
$pdf->Cell(80, 5, 'Remarks: '. $remarks,0,'1', false);
$pdf-> Ln(3).
$pdf->SetX((185)/5);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(40,14,'Bldg/Floor',1,0,'C');
$pdf->Cell(33,14,'Pres. (cu. m)',1,0,'C');
$pdf->Cell(33,14,'Prev. (cu. m)',1,0,'C');
$pdf->Cell(33,14,'Cons. (cu. m)',1,0,'C');
$pdf->Cell(33,14,'Rate (PHP/cu. m)',1,0,'C');
$pdf->Cell(35,14,'Total to pay (PHP)',1,1,'C');


$pdf->SetX((185)/5);
$pdf->SetFont('Arial','',11);
    // ist
$pdf->Cell(40,10,'First Floor',1,0,'C');
$pdf->Cell(33,10,$row['1flr_pres_bill'],1,0,'C');
$pdf->Cell(33,10,$row['1flr_prev_bill'],1,0,'C');
$pdf->Cell(33,10,$row['cu1'],1,0,'C');
$pdf->Cell(33,10,$row['grand_total_cubic'],1,0,'C');
$pdf->Cell(35,10,$row['first_floor'],1,1,'C');
// 2nd
$pdf->SetX((185)/5);
$pdf->Cell(40,10,'Second Floor',1,0,'C');
$pdf->Cell(33,10,$row['2flr_pres_bill'],1,0,'C');
$pdf->Cell(33,10,$row['2flr_prev_bill'],1,0,'C');
$pdf->Cell(33,10,$row['cu2'],1,0,'C');
$pdf->Cell(33,10,$row['grand_total_cubic'],1,0,'C');
$pdf->Cell(35,10,$row['second_floor'],1,1,'C');
// 3rd
$pdf->SetX((185)/5);
$pdf->Cell(40,10,'Third Floor',1,0,'C');
$pdf->Cell(33,10,$row['3flr_pres_bill'],1,0,'C');
$pdf->Cell(33,10,$row['3flr_prev_bill'],1,0,'C');
$pdf->Cell(33,10,$row['cu3'],1,0,'C');
$pdf->Cell(33,10,$row['grand_total_cubic'],1,0,'C');
$pdf->Cell(35,10,$row['third_floor'],1,1,'C');
// 4rt
$pdf->SetX((185)/5);
$pdf->Cell(40,10,'Fourth Floor',1,0,'C');
$pdf->Cell(33,10,$row['4flr_pres_bill'],1,0,'C');
$pdf->Cell(33,10,$row['4flr_prev_bill'],1,0,'C');
$pdf->Cell(33,10,$row['cu4'],1,0,'C');
$pdf->Cell(33,10,$row['grand_total_cubic'],1,0,'C');
$pdf->Cell(35,10,$row['fourth_floor'],1,1,'C');
$pdf->SetFont('Arial','B',14);
$pdf->SetX((185)/5);
$pdf->Cell(172,10,'Grand Total',1,0,'C');
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(35,10,'Php '.$row['total_amount_due'],1,0,'C');

// note
$pdf-> Ln(10).
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','I',11);
$pdf->SetX((185)/5);
$pdf->MultiCell(190,8,$row['title'].' '.$row['message'],0,'J');

// SUMMARY
$pdf-> Ln(5).
$pdf->SetTextColor(220,50,50);


$pdf->SetFont('Arial','',12);
$pdf->SetX((185)/5);
$pdf->Cell(40,8,'Billing Summary:',0,1,'l');
$pdf->SetX((185)/5);
$pdf->Cell(205,0,'',1,1,'l');
$pdf-> Ln(3).
$pdf->SetX((185)/5);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40,7,'Total Consumption:',0,0,'l');
$pdf->Cell(40,7,$row['total_cubic'].' '.'(cu. m)',0,1,'l');


// Total Amount Due
$pdf->SetX((185)/5);
$pdf->Cell(40,7,'Total Amount Due:',0,0,'l');
$pdf->Cell(40,7, 'Php'.' '.$row['total_amount_due'],0,1,'l');

// rate/flr
$pdf->SetX((185)/5);
$pdf->Cell(40,7,'Total Rate Per Floor:',0,0,'l');
$pdf->Cell(40,7,"Php ".$row['total_amount_due']." / ".$row['total_cubic']." cu. m"." = "."Php ".$row['grand_total_cubic']." / cu. m",0,1,'l');

// Due Date
$pdf->SetX((185)/5);
$pdf->Cell(40,7,'Payment Due Date:',0,0,'l');
$pdf->Cell(40,7,$row['payment_due_date'],0,1,'l');




$pdf->Output();
?>