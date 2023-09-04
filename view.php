<?php
include_once "db_con/db.php";
$select = "SELECT * FROM `b-house_fam`";
$result = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($result);

$date = $row['date'];
$timestamp = strtotime($date);
$formattedDate = date('F j, Y', $timestamp);



if(isset($_POST['submit'])){
    $total_amount_due = $_POST['total_amount_due'];
    $total_amount_due = round($total_amount_due, 2);

if(preg_match("/^[0-9]*\.?[0-9]+$/", $total_amount_due)){
    $insert = "INSERT INTO `b-house_fam`(`total_amount_due`) VALUES ('$total_amount_due')";
    $total_amount_due = round($total_amount_due, 2);
    mysqli_query($con, $insert);
    header('location: view.php');
    exit;
}else{
  
    $err[] = "Input Amount Due";
    header('location: view.php');
    exit;

}
}

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
    <style>
        .card{
            margin-top: 40px;
        }
    </style>
    <title>View Details Billing</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
               <div class="card-content">
                <a href="#modal-payment" class="btn-flat green-text right modal-trigger"><i class="material-icons large">add</i></a>
            
                <!-- modal payment -->
  <div id="modal-payment" class="modal">
    <div class="modal-content">
    <a href="#" class="modal-close right"><i class="material-icons">close</i></a>
        <?php 
        if(isset($err)){
            foreach($err as $error){
                echo '<div class="center red-text">'.$error.'</div>';
           
            }
        }
        ?>
      <h5 class="center">Total Amount Due</h5>
    
      <form action="" method="post">
       
     <div class="input-field">
     <input type="text" name="total_amount_due" onkeypress="restrictInput(event)" placeholder="Enter Amount Due" required>
        <label for="">Total Amount Due</label>
     </div>
      
    </div>
    <div class="modal-footer">
     <button type="submit" name="submit" class="btn-flat blue white-text">Submit</button>
      </form>
    </div>
  </div><br>
                
                <h5 class="center green-text">Billing Details</h5><br>
               <table class="highlight centered">
                    <thead>
                        <tr class="black white-text">
                            <th>Date</th>
                            <th>1st Floor</th>
                            <th>2nd Floor</th>
                            <th>3rd Floor</th>
                            <th>4th Floor</th>
                            <th>Total Amount Due</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Print</th>
                            <th>Note</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $select = "SELECT * FROM `b-house_fam`";
                    $result = mysqli_query($con, $select);
                    while($row = mysqli_fetch_assoc($result)){ ?>
                        <tr  class="">
                      
                            <td><?php echo $formattedDate?></td>
                            <td><?php echo $row['first_floor']?></td>
                            <td><?php echo $row['second_floor']?></td>
                            <td><?php echo $row['third_floor']?></td>
                            <td><?php echo $row['fourth_floor']?></td>
                            <td><?php echo 'Php '.$row['total_amount_due']?></td>
                            <td><a href="total_amount_due.php?id=<?php echo $row['id'];?>" class="btn-flat"><i class="material-icons">edit</i></a>
                            <p><input type="hidden" name="id" value="<?php echo $row['id'] ?>"></p>
                        </td>
                        <td>
                            <form action="delete.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id']?>">
                                <button type="submit" name="delete" class="btn-flat" onclick="return confirm('Are you sure! want to delete with the amount due of <?php echo $row['total_amount_due']?>?')"><i class="material-icons">delete</i></button>
                            </form>

                        </td>

                            <td><a href="print_pdf.php?id=<?php echo $row['id']?>" class="btn-flat" target="_blank"><i class="material-icons">print</i></a>
                            <p><input type="hidden" name="id" value="<?php echo $row['id'] ?>"></p>
                        </td>
                        </td>

                        <td><a href="note.php?id=<?php echo $row['id']?>" class="btn-flat" target="_blank"><i class="material-icons">message</i></a>
                        <p><input type="hidden" name="id" value="<?php echo $row['id'] ?>"></p>
                        </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
               </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/materialize.min.js"></script>
<script>
      $(document).ready(function(){
    $('.modal').modal();
  });
</script>
<!-- <script>
        function restrictInput(event) {
            var charCode = event.which ? event.which : event.keyCode;
            if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
                event.preventDefault();
            }
        }
    </script> -->
    <script>
        function restrictInput(event) {
            var inputField = event.target;
            var currentValue = inputField.value;
            
            // Allow only digits and a single dot
            if (event.key === "." && currentValue.includes(".")) {
                event.preventDefault();
            } else if (!/[0-9.]/.test(event.key)) {
                event.preventDefault();
            }
        }
    </script>
</body>
</html>