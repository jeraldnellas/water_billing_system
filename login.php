<?php
include_once "db_con/db.php";
session_start();
if(isset($_POST['submit'])){
$email = $_POST['email'];
$pass = $_POST['password'];

$select = "SELECT * FROM `user_log` WHERE email = '$email' AND password = '$pass'";
$result = mysqli_query($con, $select);
// $row = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['Name'] = $row['name'];
    $_SESSION['Access'] = $row['user_type'];
    header('location: index.php');
}else{
    $err[] = "Email or Password is Incorrect!";
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
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="row">
       <div class="col s12 m10 push-l3 l6">
       <div class="card">
            <div class="card-content">
                <?php
                    if(isset($err)){
                        foreach($err as $error){
                            echo '<div class="center red-text">'.$error.'</div>';
                        }
                    }
                ?>
                <h5 class="center">Login</h5>
               <form action="" method="post">
               <div class="input-field">
                    <input type="text" name="email">
                    <label for="">Enter your email</label>
                </div>
                <div class="input-field">
                    <input type="password" name="password">
                    <label for="">Enter your password</label>
                </div>

                <div class="input-field">
                <p class="center">Forgot your password? <a href="">Click Here</a></p>
                </div>
                <div class="input-field">
                <p class="center">No account yet? <a href="register.php">Register Here</a></p>
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