<?php
include_once "../db_con/db.php";
session_start();

// $select = "SELECT * FROM `b-house_fam` ORDER BY `id` DESC";
// $result = mysqli_query($con, $select);
// $row  = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/materialize.css">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col s12">
            <h5 class="center">Fourth Floor Payment History</h5>
           <table class="container centered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Billing Amount</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $select = "SELECT * FROM `b-house_fam` ORDER BY `id` DESC";
                $result = mysqli_query($con, $select);
                while ($row  = mysqli_fetch_assoc($result)) {?>
                <tr>
                    <td><?php echo $row['payment_due_date']?></td>
                    <td><?php echo $row['4flr_pres_bill']?></td>
                    <td><?php echo $row['remarks']?></td>
                </tr>
                <?php }?>
            </tbody>
           </table>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/materialize.min.js"></script>
</body>
</html>