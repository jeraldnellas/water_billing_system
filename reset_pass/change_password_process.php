<?php
 include_once "../db_con/db.php";
    if(isset($_GET['code'])){

    $code = $_GET['code'];
    $verifyquery = $con->query("SELECT * FROM `user_register` WHERE code = '$code' AND updated_time >= NOW() - Interval 1 DAY ");


    if($verifyquery->num_rows == 0){
        header('Location: ../index.php');
        exit();
    }
     if(isset($_POST['change'])){
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];
        $changequery =  $con->query("UPDATE `user_register` SET password = '$new_password' WHERE email = '$email' AND code = '$code' AND updated_time >= NOW() - Interval 1 DAY");
    
        if($changequery){
            header("location: success.php");
        }else{
            $err[] = "the code and email is not match!";
            header('location: change_password.php');
        }
    }$con->close();
}else{
    header("location: ../index.php");
    exit();
}

?>