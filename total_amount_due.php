<?php
include_once "db_con/db.php";
$identry = $_GET['id'];
$select = "SELECT * FROM `b-house_fam` WHERE id = '$identry'";
$result = mysqli_query($con, $select);  

$row = mysqli_fetch_assoc($result);


if(isset($_POST['submit'])){
  
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
    $date_bill = $_POST['date_bill'];
    $to_date_bill = $_POST['to_date_bill'];
    $payment_due_date = $_POST['payment_due_date'];
    $year = $_POST['year'];
    $total_cu = $_POST['total_cubic'];
    $cu1 = $_POST['cu1'];
    $cu2 = $_POST['cu2'];
    $cu3 = $_POST['cu3'];
    $cu4 = $_POST['cu4'];
    

    // compute cu/m
    $cu1 = $f_pres - $f_prev;
    $cu2 = $s_pres - $s_prev;
    $cu3 = $t_pres - $t_prev;
    $cu4 = $frt_pres - $frt_prev;

    // total cu/m
    $total_cu = $cu1 + $cu2 + $cu3 + $cu4;

    $total_cubic = $total_amount_due / $total_cu;
    $total_cubic = round($total_cubic, 2);
    
    $f_floor_total_calculated = $total_cubic * $cu1;
    $f_floor_total_calculated = round($f_floor_total_calculated, 2);
    $s_floor_total_calculated = $total_cubic * $cu2;
    $s_floor_total_calculated = round($s_floor_total_calculated, 2);
    $t_floor_total_calculated = $total_cubic* $cu3;
    $t_floor_total_calculated = round($t_floor_total_calculated, 2);
    $frt_floor_total_calculated = $total_cubic * $cu4;
    $frt_floor_total_calculated = round($frt_floor_total_calculated, 2);

  
    if(!empty($total_amount_due)){
        $update = "UPDATE `b-house_fam` SET `total_amount_due`='$total_amount_due', `1flr_pres_bill` = '$f_pres',`1flr_prev_bill` = '$f_prev', `2flr_pres_bill` = '$s_pres', `2flr_prev_bill`= '$s_prev',`3flr_pres_bill` = '$t_pres', `3flr_prev_bill` = '$t_prev', `4flr_pres_bill` = '$frt_pres', `4flr_prev_bill` = '$frt_prev', `grand_total_cubic` = '$total_cubic', `first_floor` = '$f_floor_total_calculated', `second_floor` = '$s_floor_total_calculated', `third_floor` = '$t_floor_total_calculated', `fourth_floor` = '$frt_floor_total_calculated',`date_bill` = '$date_bill', `to_date_bill` = '$to_date_bill', `year` = '$year', `payment_due_date` = '$payment_due_date', `total_cubic` = '$total_cu', `cu1` = '$cu1', `cu2` = '$cu2', `cu3` = '$cu3', `cu4` = '$cu4' WHERE id = '$identry'";
        mysqli_query($con, $update);
        header('location: index.php');
        $msg[] = "Successfully saved";

    }else{
        $err[] = "Please don't leave blank field";
        header('location: index.php');
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
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-l2">
                <div class="card">
                    <div class="card-content">
                   
                            <form action="" method="post">
                            <a href="view_record_details.php?id=<?php echo $row['id']?>"><i class="material-icons">arrow_back</i></a>
                        <h5 class="center"> Create Reading & Consumption</h5><br>
                        <?php
                    if(isset($err)){
                        foreach($err as $error){
                            echo '<div class="red-text center">'.$error.'</div>';
                        }
                    }
                ?>
                <!-- msf -->
                <?php
                    if(isset($msg)){
                        foreach($msg as $msg){
                            echo '<div class="green-text center">'.$msg.'</div>';
                        }
                    }
                ?>
                          <div class="input-field col s3">
                            <select name="date_bill" id="">
                            <option value=""></option>
                                <option value="Jan" <?php echo ($row['date_bill'] == "Jan")? 'selected' : '';?> >Jan</option>
                                <option value="Feb" <?php echo ($row['date_bill'] == "Feb")? 'selected' : '';?>>Feb</option>
                                <option value="Mar" <?php echo ($row['date_bill'] == "Mar")? 'selected' : '';?>>Mar</option>
                                <option value="Apr" <?php echo ($row['date_bill'] == "Apr")? 'selected' : '';?>>Apr</option>
                                <option value="May" <?php echo ($row['date_bill'] == "May")? 'selected' : '';?>>May</option>
                                <option value="Jun" <?php echo ($row['date_bill'] == "Jun")? 'selected' : '';?>>Jun</option>
                                <option value="Jul" <?php echo ($row['date_bill'] == "Jul")? 'selected' : '';?>>Jul</option>
                                <option value="Aug" <?php echo ($row['date_bill'] == "Aug")? 'selected' : '';?>>Aug</option>
                                <option value="Sep" <?php echo ($row['date_bill'] == "Sep")? 'selected' : '';?>>Sep</option>
                                <option value="Oct" <?php echo ($row['date_bill'] == "Oct")? 'selected' : '';?>>Oct</option>
                                <option value="Nov" <?php echo ($row['date_bill'] == "Nov")? 'selected' : '';?>>Nov</option>
                                <option value="Dec" <?php echo ($row['date_bill'] == "Dec")? 'selected' : '';?>>Dec</option>
                            </select>
                            <label for="">Billing for month of:</label>
                          </div>
                          <div class="input-field col s3">
                            <select name="to_date_bill" id="">
                            <option value=""></option>
                            <option value="Jan" <?php echo ($row['to_date_bill'] == "Jan")? 'selected' : '';?> >Jan</option>
                                <option value="Feb" <?php echo ($row['to_date_bill'] == "Feb")? 'selected' : '';?>>Feb</option>
                                <option value="Mar" <?php echo ($row['to_date_bill'] == "Mar")? 'selected' : '';?>>Mar</option>
                                <option value="Apr" <?php echo ($row['to_date_bill'] == "Apr")? 'selected' : '';?>>Apr</option>
                                <option value="May" <?php echo ($row['to_date_bill'] == "May")? 'selected' : '';?>>May</option>
                                <option value="Jun" <?php echo ($row['to_date_bill'] == "Jun")? 'selected' : '';?>>Jun</option>
                                <option value="Jul" <?php echo ($row['to_date_bill'] == "Jul")? 'selected' : '';?>>Jul</option>
                                <option value="Aug" <?php echo ($row['to_date_bill'] == "Aug")? 'selected' : '';?>>Aug</option>
                                <option value="Sep" <?php echo ($row['to_date_bill'] == "Sep")? 'selected' : '';?>>Sep</option>
                                <option value="Oct" <?php echo ($row['to_date_bill'] == "Aug")? 'selected' : '';?>>Oct</option>
                                <option value="Nov" <?php echo ($row['to_date_bill'] == "Nov")? 'selected' : '';?>>Nov</option>
                                <option value="Dec" <?php echo ($row['to_date_bill'] == "Dec")? 'selected' : '';?>>Dec</option>
                            </select>
                            <label for="">To month of:</label>
                          </div>
                          <div class="input-field col s5">
                            <select name="year" id="">
                                <option value="2023">2023</option>
                                <option value="2023">2024</option>
                                <option value="2023">2025</option>
                            </select>
                            <label for="">Year</label>
                          </div>
                        <!-- First Floor -->
                            <div class="input-field col s6">
                                <input type="text" name="1flr_pres_bill" onkeypress="restrictInput(event)" placeholder="Present cu/meter" value="<?php echo $row['1flr_pres_bill'] ?>" required>
                                <label for="">First Floor </label>
                            </div>

                            <div class="input-field col s6">
                                <input type="text" name="1flr_prev_bill" onkeypress="restrictInput(event)" placeholder="Previous cu/meter" value="<?php echo $row['1flr_prev_bill'] ?>"required>
                                <label for="">First Floor </label>
                            </div>

                               <!-- Second Floor -->
                               <div class="input-field col s6">
                                <input type="text" name="2flr_pres_bill" onkeypress="restrictInput(event)" placeholder="Present cu/meter"value="<?php echo $row['2flr_pres_bill'] ?>" required>
                                <label for="">Second Floor </label>
                            </div>

                            <div class="input-field col s6">
                                <input type="text" name="2flr_prev_bill" onkeypress="restrictInput(event)" placeholder="Previous cu/meter"value="<?php echo $row['2flr_prev_bill'] ?>" required>
                                <label for="">Second Floor </label>
                            </div>

                              <!-- Third Floor -->
                              <div class="input-field col s6">
                                <input type="text" name="3flr_pres_bill" onkeypress="restrictInput(event)" placeholder="Present cu/meter"value="<?php echo $row['3flr_pres_bill'] ?>" required>
                                <label for="">Third Floor </label>
                            </div>

                            <div class="input-field col s6">
                                <input type="text" name="3flr_prev_bill" onkeypress="restrictInput(event)" placeholder="Previous cu/meter"value="<?php echo $row['3flr_prev_bill'] ?>" required>
                                <label for="">Third Floor </label>
                            </div>

                            <!-- Fourth Floor -->
                            <div class="input-field col s6">
                                <input type="text" name="4flr_pres_bill" onkeypress="restrictInput(event)" placeholder="Present cu/meter"value="<?php echo $row['4flr_pres_bill'] ?>" required>
                                <label for="">Fourth Floor </label>
                            </div>

                            <div class="input-field col s6">
                                <input type="text" name="4flr_prev_bill" onkeypress="restrictInput(event)" placeholder="Previous cu/meter"value="<?php echo $row['4flr_prev_bill'] ?>" required>
                                <label for="">Fourth Floor </label>
                            </div>
                            <!-- payment due date -->
                            <div class="input-field col s12">
                                <input type="text" class="datepicker" name="payment_due_date" placeholder="Payment Due Date" value="<?php echo $row['payment_due_date']?>">
                                <label for="">Payment Due Date</label>
                            </div>

                        <!-- Amount Due -->
                            <div class="input-field col s12">
                            <input type="text" name="total_amount_due" onkeypress="restrictInput(event)" placeholder="Total Amount Due" value="<?php echo $row['total_amount_due']?>" required>
                            <label for="">Total Amount Due</label>
                            </div>

                            <button type="submit" name="submit" class="btn-flat blue white-text" style="width:100%">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/materialize.min.js"></script>
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
    <script>
          $(document).ready(function(){
    $('select').formSelect();
  });
        
  $(document).ready(function(){
    $('.datepicker').datepicker();
  });
          
    </script>
</body>
</html>