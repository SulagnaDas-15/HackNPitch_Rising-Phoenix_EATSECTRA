<?php

    include("C:/xampp/htdocs/food/connection1.php");

    $id = $_GET['id'];
    $query1 = "select * from admin_tbl where id='$id'";
    $result1 = mysqli_query($con1,$query1);
    $row = mysqli_fetch_assoc($result1);

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<body>
<div>
        <form action="" method="POST">
        <div> Current Password: </div> <input type="password" name="old" required>
        <div> New Password: </div> <input type="password" name="new" required>
        <div> Confirm Password: </div> <input type="password" name="confirm" required>
        
        <br><br>
        <input type="submit" value="Submit">
        </form>
        
    </div>
</body>
</html>

<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $old = md5($_POST['old']);
        $new = md5($_POST['new']);
        $confirm = md5($_POST['confirm']);
        
        if ($old===$row['password']){
            echo "hi";
            if ($new === $confirm) {

                $query = "update admin_tbl set 
                password = '$new'  
                where id='$id'";

                mysqli_query($con1,$query); 
                
                header("Location: ../manage-admin.php");
                die;
                
            }
            else{
                echo "Incorrect Password Confirmed";
            }
        }
        else{
            echo "Wrong Password Entered";
        }
    }
?>