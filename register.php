<?php
include_once "db_con/db.php";
if(isset($_POST['submit'])){
$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];
$cpass = $_POST['cpassword'];

$select = "SELECT * FROM `user_log` WHERE email = '$email' AND password = '$pass'";
$result = mysqli_query($con, $select);
// $row = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) > 0){
 $err[] = "Email or Password already Registered";
}elseif($pass != $cpass){
    $err[] = "Password did not match!";
}else{
    $insert = "INSERT INTO `user_log`(`name`, `email`, `password`, `cpass`) VALUES ('$name', '$email', '$pass', '$cpass')";
    mysqli_query($con, $insert);
    header('location: login.php');
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
    <title>Register</title>
</head>
<body>
<div class="container">
    <div class="row">
       <div class="col s12 m10 push-l3 l6">
       <div class="card">
       <div class="card-content center">
                <h5>B-house Maynilad Water Billing</h5>
                <img src="img/logo.png" width="80" alt="">
            <?php
                    if(isset($err)){
                        foreach($err as $error){
                            echo '<div class="center red-text">'.$error.'</div>';
                        }
                    }
                ?>
                <h5 class="center">Register Here</h5>
               <form action="" method="post">
               <div class="input-field">
                    <input type="text" name="name" required>
                    <label for="">Enter your Name</label>
                </div>
               <div class="input-field">
                    <input type="text" name="email" required>
                    <label for="">Enter your email</label>
                </div>
                <div class="input-field">
                    <input type="password" name="password" required>
                    <label for="">Enter your password</label>
                </div>
                <div class="input-field">
                    <input type="password" name="cpassword" required>
                    <label for="">Confirm your password</label>
                </div>
                <div class="input-field">
                <p class="center">Already have an account? <a href="login.php">Login Here</a></p>
                </div>
                <button type="submit" name="submit" class="btn-flat blue white-text" style="width: 100%;">Submit</button>

               </form>
            </div>
        </div>
       </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/materialize.min.js"></script> 
</body>
</html>