<?php
include_once "db_con/db.php";
session_start();
$name = $_SESSION['Name'];
if(!isset($name)){
    header('location: login.php');
}

// page number
if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
$page_no = $_GET['page_no'];
}else{
    $page_no = 1;
}

// total rows
$total_records_per_page = 5;
// get offset
$offset = ($page_no - 1 ) * $total_records_per_page;
// previous & next
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
// get total count
$result_count = mysqli_query($con, "SELECT COUNT(*) as total_records FROM `b-house_fam`")
or die(mysqli_error($con));
$records  =  mysqli_fetch_array($result_count);
$total_record =     $records['total_records'];
$total_no_of_pages = ceil($total_record / $total_records_per_page);


$select = "SELECT * FROM `b-house_fam` LIMIT $offset, $total_records_per_page   ";
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
    header('location: index.php');
    exit;
}else{
  
    $err[] = "Input Amount Due";
    header('location: index.php');
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
    <title>billing records</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
               <div class="card-content">
                <a href="logout.php" class="tooltipped" data-tooltip="Logout" data-position="bottom"><i class="material-icons">logout</i></a>
                <a href="#modal-payment" class="btn-flat green-text right modal-trigger tooltipped" data-position="bottom" data-tooltip="Add Billing"><i class="material-icons large">add</i></a>
            
                <!-- modal payment -->
  <div id="modal-payment" class="modal">
    <div class="modal-content">
    <a href="#" class="modal-close right tooltipped" data-position="right" data-tooltip="close"><i class="material-icons red-text">close</i></a>
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
                
                <h5 class="center green-text">Maynilad Water Billing Record</h5><br>
               <table class="highlight responsive-table centered">
                    <thead>
                        <tr class="black white-text">
                            <th>Date</th>
                            
                            <th>Total Amount Due</th>
                            <th>Total Consumption</th>
                            <th>Cons./Flr.</th>
                            <th>View Details</th>
                            <th>Delete</th>
                            <th>Note</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                   
                    <?php 
                    
                    $select = "SELECT * FROM `b-house_fam` LIMIT $offset, $total_records_per_page   ";
                    $result = mysqli_query($con, $select);
               
                    while($row = mysqli_fetch_array($result)){ ?>
                 
                        <tr  class="">
                         
                            <td><?php echo $formattedDate?></td>
                            <td><?php echo 'Php '.$row['total_amount_due']?></td>
                            <td><?php echo $row['total_cubic']?></td>
                            <td><?php echo $row['grand_total_cubic']?></td>
                            <td><a href="view_record_details.php?id=<?php echo $row['id'];?>" class="btn-flat blue-text" target="_blank"><i class="material-icons">visibility</i></a>
                            <p><input type="hidden" name="id" value="<?php echo $row['id'] ?>"></p>
                        </td>
                        <td>
                            <form action="delete.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id']?>">
                                <button type="submit" name="delete" class="btn-flat red-text" onclick="return confirm('Are you sure! want to delete with the amount due of <?php echo $row['total_amount_due']?>?')"><i class="material-icons">delete</i></button>
                            </form>

                        </td>

                        </td>

                        <td><a href="note.php?id=<?php echo $row['id']?>" class="btn-flat"><i class="material-icons">message</i></a>
                        <p><input type="hidden" name="id" value="<?php echo $row['id'] ?>"></p>
                        </td>
                        </tr>
                      
                        <?php } mysqli_close($con)?>

                        <!-- pagination -->
                        
                    </tbody>
                </table>
                <ul class="pagination">
                    <li class="">
                        <?php if ($page_no <= 1): ?>
                            <a disabled><i class="material-icons">chevron_left</i></a>
                        <?php else: ?>
                            <a href="?page_no=<?= $previous_page ?>"><i class="material-icons">chevron_left</i></a>
                        <?php endif; ?>
                    </li>
                    
                    <?php for ($counter = 1; $counter <= $total_no_of_pages; $counter++): ?>
                        <li class="<?= ($counter == $page_no) ? 'active' : 'waves-effect' ?>">
                            <a href="?page_no=<?= $counter ?>"><?= $counter ?></a>
                        </li>
                    <?php endfor; ?>
                    
                    <li class="waves-effect">
                        <?php if ($page_no >= $total_no_of_pages): ?>
                            <a><i class="material-icons">chevron_right</i></a>
                        <?php else: ?>
                            <a href="?page_no=<?= $next_page ?>"><i class="material-icons">chevron_right</i></a>
                        <?php endif; ?>
            </li>
</ul>

                  <div class="p-10"><strong>Page <?=$page_no;?> of <?= $total_no_of_pages?></strong></div>
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
        $(document).ready(function(){
    $('.tooltipped').tooltip();
  });
        
    </script>
</body>
</html>