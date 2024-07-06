<?php
include_once "db_con/db.php";
session_start();

$id = $_GET['id'];

$select = "SELECT * FROM `b-house_fam` WHERE id = '$id'";
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
//no records found
if(mysqli_num_rows($result) == 1){

}else{
    header('location: index.php');
}

if(isset($_POST['submit'])){
  $title = $_POST['title'];
  $message = $_POST['message'];
  $remarks = $_POST['remarks'];
  
  $update = "UPDATE `b-house_fam` SET `title`='$title', `message` = '$message', `remarks` = '$remarks' WHERE `id` = '$id'";
  mysqli_query($con, $update);
  header('location: view_record_details.php?id='. $row["id"]);
  exit;
  }
  





?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="icon" type="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>View Billing Summary</title>
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
      <ul class="right-align">
        <li>    <a href="print_pdf.php?id=<?php echo $row['id']?>" class="btn-flat right tooltipped" target="_blank" data-position="bottom" data-tooltip="Print"><i class="material-icons">print</i></a></li>

        <li>  <a href="note.php?id=<?php echo $row['id']?>"  class="btn-flat right green-text tooltipped modal-trigger" data-tooltip="Add Note" data-position="bottom"><i class="material-icons">text_snippet</i></a></li>

        <li> <a href="total_amount_due.php?id=<?php echo $row['id']?>" class="btn-flat right blue-text tooltipped" data-position="bottom" data-tooltip="Update Billing"><i class="material-icons">system_update_alt</i></a></li>
        <li class="left"><a href="index.php" class="tooltipped" data-tooltip="Back" data-position="bottom"><i class="material-icons">arrow_back</i></a></li>
      </ul>
   
       
      <!-- Modal NOte -->
<div class="modal modal-fixed-footer" id="modalNote<?php echo $row['id']?>">
  <div class="modal-content">
  <form action="" method="post">
            <div class="input-field">
                <input type="text" name="title" placeholder="Title of Message" value="<?php echo $row['title'] ?>">
                <label for="title">Title Message</label>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="textarea2" name="message" rows="50" class="materialize-textarea" data-length="120"><?php echo $row['message'] ?></textarea>
                        <label for="textarea2">Your Message</label>
                </div>
                <div class="input-field col s12">
                    <select name="remarks" id="remarks">
                        <option value=""></option>
                        <option value="Paid"<?php echo ($row['remarks'] == "Paid")? 'selected' : '';?>>Paid</option>
                        <option value="Unpaid" <?php echo ($row['remarks'] == "Unpaid")? 'selected' : '';?>>Unpaid</option>
                    </select>
                    <label for="remarks">Remarks</label>
                </div>
            </div>
           
            <br>
            <div class="red-text center">NO CONTENT</div>
  </div>
  <div class="modal-footer">
    <a href="#!" class="btn-flat red-text modal-close">close</a>
  <button type="submit" name="submit" class="btn-flat blue white-text">Submit</button>
        </form>
  </div>
</div>
    
        <br>
        
        <h5 class="center"><b>Breakdown Summary</b></h5>
       
        <span class="right"> <?php if(isset($msg)){
              foreach($msg as $msgs)
              echo 'Remarks: '.$msgs;
          }
              ?></span>
        
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
        <td><b>First Floor</b></td>
        <td><?php echo $row['1flr_pres_bill']?></td>
        <td><?php echo $row['1flr_prev_bill']?></td>
        <td><?php echo $row['cu1']?></td>
        <td><?php echo $row['grand_total_cubic']?></td>
        <td><?php echo $row['first_floor']?></td>
      </tr>
      <!-- Second Floor -->
      <tr>
      <td><b>Second Floor</b></td>
        <td><?php echo $row['2flr_pres_bill']?></td>
        <td><?php echo $row['2flr_prev_bill']?></td>
        <td><?php echo $row['cu2']?></td>
        <td><?php echo $row['grand_total_cubic']?></td>
        <td><?php echo $row['second_floor']?></td>
      </tr>
      <!-- third Floor -->
      <tr>
      <td><b>Third Floor</b></td>
        <td><?php echo $row['3flr_pres_bill']?></td>
        <td><?php echo $row['3flr_prev_bill']?></td>
        <td><?php echo $row['cu3']?></td>
        <td><?php echo $row['grand_total_cubic']?></td>
        <td><?php echo $row['third_floor']?></td>
      </tr>
      <!-- Fourth Floor -->
      <tr>
      <td><b>Fourth Floor</b></td>
        <td><?php echo $row['4flr_pres_bill']?></td>
        <td><?php echo $row['4flr_prev_bill']?></td>
        <td><?php echo $row['cu4']?></td>
        <td><?php echo $row['grand_total_cubic']?></td>
        <td><?php echo $row['fourth_floor']?></td>
      </tr>
      
      <tr class="grand_total">
      <td colspan="5"><b>Grand Total</b></td>
        <td class="red-text"><b>PHP <?php echo $row['total_amount_due']?></b></td>
       
      </tr>


    </table>
    </div>
   </div>
    <p><i><?php echo $row['title'].' '?><?php echo $row['message']?></i></p>
    
    <div class="summary">
        <h5 class="">Billing Summary:</h5>
        <li class="divider"></li>
        <ul>
            <li>Total Consumption: <b><?php echo $row['total_cubic'].' cu. m'?></b></li>
            <li>Total Amount Due: <b> <?php echo 'Php '?><?php echo $row ['total_amount_due']?></b></li>
            <li>Total Rate Per Floor: <b><?php echo 'Php '?><?php echo $row ['total_amount_due']." / ". $row['total_cubic']." cu. m"." = "?></b><?php echo '<span class="red-text">'. " Php ".$row['grand_total_cubic']." / cu. m" .'</span>'?></li>
            <li>Payment Due Date: <b><?php echo $row['payment_due_date']?></b></li>
         
        </ul>
        
    </div>
  </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/materialize.min.js"></script> 


<script>
   $(document).ready(function(){
    $('select').formSelect();
  });
</script>
<script>

  $(document).ready(function() {
    $('input#input_text, textarea#textarea2').characterCounter();
  });


        $(document).ready(function(){
    $('.tooltipped').tooltip();
  });

  $(document).ready(function(){
    $('.modal').modal();
  });

 


</script>


</body>
</html>
