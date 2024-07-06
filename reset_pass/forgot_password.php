<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Forgot Password</title>
</head>
<body>
    <div class="conatainer">
        <div class="row">
            <div class="col s12 m4 offset-l4">
                <div class="card">
                    <div class="card-content center">
                        <form action="forgot_password_process.php" method="post">
                            <h5>Reset Password</h5>
                             <input type="email" name="email" placeholder="Type your Email">
                             <button type="submit" name="reset" style="width: 100%;" class="btn-flat blue white-text">Reset Password</button>
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