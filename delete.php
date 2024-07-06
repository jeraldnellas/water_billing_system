<?php
include_once "db_con/db.php";

if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $delete = "DELETE FROM `b-house_fam` WHERE id = '$id'";
    $result = mysqli_query($con, $delete);
    header('location:index.php');
    
}
mysqli_close($con);

if($query_run){
    echo "Deleted Successfully";
    exit(0);
}else{
    echo "Not Deleted";
    exit(0);
}
?>