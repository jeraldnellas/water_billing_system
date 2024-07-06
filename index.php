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

// $date = $row['date'];
// $timestamp = strtotime($date);
// $formattedDate = date('F j, Y', $timestamp);

if(isset($_POST['submit'])){
    $total_amount_due = $_POST['total_amount_due'];
    $formattedDate = $_POST['date'];


    // Validate if the input is a valid number
    if(preg_match("/^[0-9]*\.?[0-9]+$/", $total_amount_due)){
        $total_amount_due = round(floatval($total_amount_due), 2); // Convert to float and then round
        $insert = "INSERT INTO `b-house_fam`(`total_amount_due`, `date`) VALUES ('$total_amount_due', '$formattedDate')";
        mysqli_query($con, $insert);
        header('location: index.php');
        exit;
    } else {
        $err[] = "Invalid Input Amount Due"; // Update the error message
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
    <link rel="icon" type="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .card{
            margin-top: 40px;
        }
    </style>
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
    width: 80%;
    /* max-width: 800px; */
    padding: 20px;
    box-sizing: border-box;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    /* margin-right: 0; */
  }

  table {
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #ccc;
  }

  th {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: center;
  }
  td {
    border: 1px solid #ccc;
    padding: 8px;
  }

  th {
    background-color: #f0f0f0;
  }

td #details {
    position: relative;
    top: 8px;
}
</style>
    <title>Billing Records</title>
</head>
<body>
   
<div class="container dashboard">
    <div class="row">
        <div class="col s12">
            <!-- <div class="card"> -->
               <!-- <div class="card-content"> -->
                <a href="logout.php" class="tooltipped" data-tooltip="Logout" data-position="bottom"><i class="material-icons">logout</i></a>
                <a href="#modal-payment" class="btn-flat green-text right modal-trigger tooltipped" data-position="bottom" data-tooltip="Add Billing"><i class="material-icons large">add</i></a>
            
                        <!-- modal payment -->
            <div id="modal-payment" class="modal bottom-sheet">
            <div class="modal-content">
        <?php 
        if(isset($err)){
            foreach($err as $error){
                echo '<div class="center red-text">'.$error.'</div>';
           
            }
        }
        ?>
      <h5 class="center">Input Billing Received</h5>
    
      <form action="" method="post">
       
     <div class="input-field">
     <input type="text" name="total_amount_due" onkeypress="restrictInput(event)" placeholder="Enter Total Amount Due" required>
        <label for="">Total Amount Due</label>
     </div>
        
    <div class="input-field">
     <input type="text" name="date" class="datepicker"  placeholder="Date Received">
     <label for="">Date Received</label>
    </div>
    <div class="modal-footer">
    <a href="#!" class="modal-close btn-flat">close</a>
     <button type="submit" name="submit" class="btn-flat blue white-text">Submit</button>
    
      </form>
    </div>
    </div>
    
  </div><br>
             <div class="col s12">
             <div class="center">  <h5 class="center green-text"> Maynilad Water Billing Record</h5> <img src="img/logo.png" width="100" alt=""></div> 
             </div>       
         
                <br>
                 <!-- sidenav -->
    <ul id="slide-out" class="sidenav">
    <li><div class="user-view">
      <div class="background">
        <img src="img/water.jpeg">
      </div>
      <a href="#user"><img class="circle responsive-img" src="img/logo.png"></a>
    </div></li>
    <li><a href="#!"><i class="material-icons">water</i>List of Bills</a></li>
    <li><a href="list_of_bills/first_flr.php">First Floor</a></li>
    <li><div class="divider"></div></li>
    <li><a class="waves-effect" href="list_of_bills/second_flr.php">Second Floor</a></li>
    <li><div class="divider"></div></li>
    <li><a class="waves-effect" href="list_of_bills/third_flr.php">Third Floor</a></li>
    <li><div class="divider"></div></li>
    <li><a class="waves-effect" href="list_of_bills/fourth_flr.php">Fourth Floor</a></li>
  </ul>
  <a href="#" data-target="slide-out" class="sidenav-trigger "><i class="material-icons">menu</i></a>

               <table class="highlight responsive-table centered">
                    <thead>
                        <tr>
                            <th>Date Received</th>
                            <th>Total Amount Due</th>
                            <th>Total Consumption</th>
                            <th>Rate/Flr.</th>
                            <th>Details</th>
                            <th>Delete</th>
                            <th>Remarks</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                   
                    <?php 
                    
                    $select = "SELECT * FROM `b-house_fam` ORDER BY `id` DESC LIMIT $offset, $total_records_per_page   ";
                    $result = mysqli_query($con, $select);
                   
                    while($row = mysqli_fetch_array($result)){ ?>
                 
                        <tr  class="">
                         
                            <td><?php echo $row['date']?></td>
                            <td><?php echo 'Php '.$row['total_amount_due']?></td>
                            <td><?php echo $row['total_cubic']." "."cu. m"?></td>
                            <td><?php echo 'Php '. $row['grand_total_cubic']." "."/cu. m"?></td>
                            <td>
                            
                            <a href="view_record_details.php?id=<?php echo $row['id'];?>" id="details" class="btn-flat blue-text tooltipped " target="_blank" data-position="top" data-tooltip="view & update details"><i class="material-icons">visibility</i></a>
                            <p><input type="hidden" name="id" value="<?php echo $row['id'] ?>"></p>
                        </td>
                        <td>
                            <form action="delete.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id']?>">
                                <button type="submit" name="delete" class="btn-flat red-text tooltipped " data-position="top" data-tooltip="delete" onclick="return confirm('Are you sure! want to delete with the amount due of <?php echo $row['total_amount_due']?>?')"><i class="material-icons">delete</i></button>
                            </form>

                        </td>

                        <td>
                            <p><?php echo $row['remarks']?></p>
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

                  <span class="p-10"><strong>Page <?=$page_no;?> of <?= $total_no_of_pages?></strong></span>
                  <div class="right">Version: 1</div>
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

  $(document).ready(function(){
    $('select').formSelect();
  });
        
  $(document).ready(function(){
    $('.datepicker').datepicker();
  });
    </script>
    <script>
        $(document).ready(function(){
    $('.sidenav').sidenav({
        draggable: false,
        isFixed: true,
        isOpen: true,
    });
});
    </script>
</body>
</html>