<?php
session_start();
    include("C:/xampp/htdocs/food/connection1.php");
    

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $fullname = $_POST['fullname'];
        $position = $_POST['position'];
        $admin_username = $_POST['admin_username'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $canteen_id=$_SESSION['canteen_id'];

        $query="select canteen_name from info where canteen_id='$canteen_id'";
        $result=mysqli_query($con2,$query);

        if($result){

            $arr=mysqli_fetch_assoc($result);
            $canteen_name=$arr['canteen_name'];
        }
        
        if($position){
            $query="insert into admin_tbl (fullname,position,admin_username,contact,email,password,canteen) values ('$fullname','$position','$admin_username','$contact','$email','$password','$canteen_name')";
            mysqli_query($con1,$query); 
            
            header("Location: ../manage-admin.php");
            die;
            
        }
        else{
            echo "Please enter the position";
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
        <form action="" method="POST">
        <div> Name: </div> <input type="text" name="fullname" required>
        <div> Position: </div> <input type="text" name="position" required>
        <div> Username: </div> <input type="text" name="admin_username" required>
        <div> Contact Number: </div> <input type="number" name="contact" required>
        <div> Email: </div> <input type="email" name="email" required>
        <div> Password: </div> <input type="password" name="password" required>
        <br><br>
        <input type="submit" value="Submit">
        </form>
        
    </div>
</body>
</html>