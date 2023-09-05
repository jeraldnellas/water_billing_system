<?php
include_once "db_con/db.php";
session_start();

$id = $_GET['id'];
$select = "SELECT * FROM `b-house_fam` WHERE id = '$id'";
$result = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($result);




?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>view billing summarys</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    /* min-height: 100vh; */
    margin-top: 40px;
    background-color: #f0f0f0;
  }

  .container {
    /* width: 90%; */
    /* max-width: 800px; */
    padding: 20px;
    box-sizing: border-box;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  table {
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #ccc;
  }

  th, td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: center;
  }

  th {
    background-color: #f0f0f0;
  }


</style>
</head>
<body>
  <div class="container ">
   <div class="row">
    <div class="col s12 m12 l12">
    <table class="highlight responsive-table centered">
        <a href="index.php"><i class="material-icons">arrow_back</i></a>
        <a href="total_amount_due.php?id=<?php echo $row['id']?>" class="btn-flat right blue-text tooltipped" data-position="bottom" data-tooltip="Update Billing"><i class="material-icons">system_update_alt</i></a>
        <a href="note.php?id=<?php echo $row['id']?>" class="btn-flat right green-text tooltipped" data-tooltip="Add Note" data-position="bottom"><i class="material-icons">text_snippet</i>
        <a href="print_pdf.php?id=<?php echo $row['id']?>" class="btn-flat right tooltipped" target="_blank" data-position="bottom" data-tooltip="Print"><i class="material-icons">print</i></a>
       
        <br>
        <h5 class="center">Breakdown Summary</h5>
        <p>This billing is for the month of <?php echo $row['date_bill']?> - <?php echo $row['to_date_bill']?> <?php echo $row['year']?>. </p>
      <tr>
        <th>Bldg/Floor</th>
        <th>Pres. (cu. m)</th>
        <th>Prev. (cu. m)</th>
        <th>Cons. (cu. m) </th>
        <th>Rate (PHP/cu .m)</th>
        <th>Total to pay (PHP)</th>
      </tr>
      <!-- First Floor -->
      <tr>
        <td>First Floor</td>
        <td><?php echo $row['1flr_pres_bill']?></td>
        <td><?php echo $row['1flr_prev_bill']?></td>
        <td><?php echo $row['cu1']?></td>
        <td><?php echo $row['grand_total_cubic']?></td>
        <td><?php echo $row['first_floor']?></td>
      </tr>
      <!-- Second Floor -->
      <tr>
      <td>Second Floor</td>
        <td><?php echo $row['2flr_pres_bill']?></td>
        <td><?php echo $row['2flr_prev_bill']?></td>
        <td><?php echo $row['cu2']?></td>
        <td><?php echo $row['grand_total_cubic']?></td>
        <td><?php echo $row['second_floor']?></td>
      </tr>
      <!-- third Floor -->
      <tr>
      <td>Third Floor</td>
        <td><?php echo $row['3flr_pres_bill']?></td>
        <td><?php echo $row['3flr_prev_bill']?></td>
        <td><?php echo $row['cu3']?></td>
        <td><?php echo $row['grand_total_cubic']?></td>
        <td><?php echo $row['third_floor']?></td>
      </tr>
      <!-- Fourth Floor -->
      <tr>
      <td>Fourth Floor</td>
        <td><?php echo $row['4flr_pres_bill']?></td>
        <td><?php echo $row['4flr_prev_bill']?></td>
        <td><?php echo $row['cu4']?></td>
        <td><?php echo $row['grand_total_cubic']?></td>
        <td><?php echo $row['fourth_floor']?></td>
      </tr>
      
      <tr class="grand_total">
      <td colspan="5">Grand Total</td>
        <td>PHP <?php echo $row['total_amount_due']?></td>
       
      </tr>


    </table>
    </div>
   </div>
    <p><i><?php echo $row['title'].' '?><?php echo $row['message']?></i></p>
    <div class="summary">
        <h5>Billing Summary</h5>
        <li class="divider"></li>
        <ul>
            <li>Total Consumption: <b><?php echo $row['total_cubic'].' cu. m'?></b></li>
            <li>Total Amount Due: <b> <?php echo 'Php '?><?php echo $row ['total_amount_due']?></b></li>
            <li>Total Rate Per Floor: <b><?php echo 'Php '?><?php echo $row ['total_amount_due']." / ". $row['total_cubic']." cu. m"." = "?></b><?php echo '<span class="red-text">'. " Php ".$row['grand_total_cubic']." / cu. m" .'</span>'?></li>
            <li>Payment Due Date: <b><?php echo $row['payment_due_date']?></b></li>
            <li>Remarks: <span class="green-text"><?php echo $row['remarks']?></span></li>
        </ul>
    </div>
  </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/materialize.min.js"></script> 
<script>
        $(document).ready(function(){
    $('.tooltipped').tooltip();
  });
</script>
</body>
</html>
