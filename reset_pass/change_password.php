<?php

 if(isset($_GET['code'])){
  include_once "../db_con/db.php";
    $code = $_GET['code'];
    $verifyquery = "SELECT * FROM `user_log` WHERE code = '$code' AND updated_time >= NOW() - Interval 1 DAY ";
    $result = mysqli_query($con, $verifyquery);
    $row = mysqli_fetch_assoc($result); 

    if(mysqli_num_rows($result) == 0 ){
       header('location: ../index.php');
       exit();
    }
     if(isset($_POST['change'])){
        $email = $_POST['email'];
        $new_password = $_POST['password'];
        $c_new_password = $_POST['cpass'];
        
        if($new_password !== $c_new_password){
            $err[] = "Password not match!";
        }else{
            $changequery =  "UPDATE `user_log` SET password = '$new_password', cpass = '$c_new_password' WHERE email = '$email' AND code = '$code' AND updated_time >= NOW() - Interval 1 DAY";
            mysqli_query($con, $changequery);
            header("location: success.php");
        }
        }$con->close();  
    }else{
    header("location: ../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Change Password</title>
</head>
<body>
    <div class="conatainer">
        <div class="row">
            <div class="col s12 m4 offset-l4">
                <div class="card">
                    <div class="card-content center">
                        <?php
                            if(isset($err)){
                                foreach($err as $error){
                                    echo '<span class="red-text">'.$error.'</span>';
                                }
                            }
                        ?>
                        <form action="" method="post">
                            <h5>Change Password</h5>
                            <div class="input-field">
                                <input type="email" name="email" placeholder="Type your email">
                            </div>
                            <div class="input-field">
                            <input type="password" name="password" placeholder="Type your New Password">
                            </div>
                            <div class="input-field">
                            <input type="password" name="cpass" placeholder="Confirm New Password">
                            </div>
                             <button type="submit" name="change" style="width: 100%;" class="btn-flat blue white-text">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../js/materialize.min.js"></script>
</body>
</html>