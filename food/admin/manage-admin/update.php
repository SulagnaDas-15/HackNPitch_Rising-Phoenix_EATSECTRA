<?php

    include("C:/xampp/htdocs/food/connection1.php");

    $id = $_GET['id'];
    $query1 = "select * from admin_tbl where id='$id'";
    $result1 = mysqli_query($con1,$query1);
    $row = mysqli_fetch_assoc($result1);

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $fullname = $_POST['fullname'];
        $position = $_POST['position'];
        $admin_username = $_POST['admin_username'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
       
        
        $query2 = "select * from admin_tbl where admin_username='$admin_username' and id !='$id'";
        $result2 = mysqli_query($con1,$query2);

        if ((mysqli_num_rows($result2))===0){
            if($position){

                $query = "update admin_tbl set 
                fullname = '$fullname' ,
                position = '$position' ,
                admin_username = '$admin_username' ,
                contact = '$contact' ,
                email = '$email' 
                where id='$id'";

                mysqli_query($con1,$query); 
                
                header("Location: ../manage-admin.php");
                die;
                
            }
            else{
                echo "Please enter the position";
            }
        }
        else{
            echo "The username already exists";
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
        <div> Name: </div> <input type="text" name="fullname" value= <?php echo $row['fullname']; ?> required>
        <div> Position: </div> <input type="text" name="position" value= <?php echo $row['position']; ?> required>
        <div> Username: </div> <input type="text" name="admin_username" value= <?php echo $row['admin_username']; ?> required>
        <div> Contact Number: </div> <input type="number" name="contact" value= <?php echo $row['contact']; ?> required>
        <div> Email: </div> <input type="email" name="email" value= <?php echo $row['email']; ?> required>
        
        <br><br>
        <input type="submit" value="Submit">
        </form>
        
    </div>
</body>
</html>