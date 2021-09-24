<?php
session_start();
    include("C:\xampp\htdocs\food\connection1.php");

    if($_SERVER['REQUEST_METHOD']=="POST"){
        
        $admin_username = $_POST['admin_username'];
        $password = $_POST['password'];
        
        
        $query = "select * from user_login where admin_username='$admin_username' limit 1";
        $result = mysqli_query($con1,$query); 

        if (mysqli_num_rows($result)>0){
            
            $row = mysqli_fetch_assoc($result);
            if($row['password']===$password){
               
                $_SESSION['admin_id']=$row['admin_id'];
                header("Location: ../index.php");
                die();
            }
            else{
                echo "Incorrect password";
            }
        }
        else{
            echo "Incorrect username";
        }
    }
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
        <form action="" method="post">
        <div> UserName: </div> <input type="text" name="admin_username" required>
        <div> Password: </div> <input type="password" name="password" required>
        <br><br>
        <input type="submit" value="Login">
        </form>
        <br>
        <a href="signup.php"> Want to add a new Canteen? Sign Up</a>
    </div>
</body>
</html>