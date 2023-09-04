<?php 
include_once "db_con/db.php";
$idnote = $_GET['id'];
$select = "SELECT * FROM `b-house_fam` WHERE id = '$idnote'";
$result = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
$title = $_POST['title'];
$message = $_POST['message'];
$remarks = $_POST['remarks'];

$update = "UPDATE `b-house_fam` SET `title`='$title', `message` = '$message', `remarks` = '$remarks' WHERE `id` = '$idnote'";
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
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Important Note</title>
</head>
<body>
   
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-l2">
                <div class="card">
                    <div class="card-content">
                        <a href="view_record_details.php?id=<?php echo $row['id']?>"><i class="material-icons left">arrow_back</i></a><br>
                        <h5 class="center">Important Note</h5>


                        <form action="" method="post">
    <div class="input-field">
        <input type="text" name="title" placeholder="Title of Message" value="<?php echo $row['title'] ?>">
        <label for="title">Title Message</label>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <textarea id="textarea2" name="message" class="materialize-textarea" data-length="120"><?php echo $row['message'] ?></textarea>
            <label for="textarea2">Your Message</label>
        </div>
        <!-- remarks -->
        <div class="input-field col s12">
            <select name="remarks" id="remarks">
                <option value=""></option>
                <option value="Paid"class="red-text" <?php echo ($row['remarks'] == "Paid")? 'selected' : '';?>>Paid</option>
                <option value="Unpaid" <?php echo ($row['remarks'] == "Unpaid")? 'selected' : '';?>>Unpaid</option>
            </select>
            <label for="remarks">Remarks</label>
        </div>
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
<script>
     $(document).ready(function() {
    $('input#input_text, textarea#textarea2').characterCounter();
  });

  $(document).ready(function(){
    $('select').formSelect();
  });
        
</script>
</body>
</html>