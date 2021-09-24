<?php
session_start();
    include("C:/xampp/htdocs/food/connection1.php");
    

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $food_name=$_POST['food_name'];
        $category_name = $_POST['category_name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image_name1 = $_POST['image_name1'];
        $availability=0;
        $canteen_id=$_SESSION['canteen_id'];
       
        if (isset($_FILES['image']['name'])){

            $image_name=$_FILES['image']['name'];
            $ext= end(explode(".",$image_name));
            $image_name=$image_name1.".".$ext;
            
            $query1="select category_id from food_category where category_name='$category_name'";
            
            if(!$result1=mysqli_query($con2,$query1) or mysqli_num_rows($result1)==0){
                echo "No such category available";
            }

            else{
                $arr = mysqli_fetch_assoc($result1);
                $category_id= $arr['category_id'];
                $query="select * from food where image_name='$image_name'";
                $result=mysqli_query($con2,$query);
            

                if($result==false or mysqli_num_rows($result)==0){
                    $source_path=$_FILES['image']['tmp_name'];
                    $destination_path="../../images/food/".$image_name;

                    $upload=move_uploaded_file($source_path,$destination_path);
                    
                    if ($upload==false){
                        
                        $_SESSION['upload']="<div clas='error'> Failed to upload Image </div>";
                        header("Location:../manage-food.php");
                        die();
                    }
                    else{
                        
                        $query2 = "insert into food set
                        food_name='$food_name',
                        category_id='$category_id',
                        price='$price',
                        image_name='$image_name',
                        description='$description',
                        availability='$availability'
                        canteen_id='$canteen_id' ";


                        if(!mysqli_query($con2,$query2)){
                            echo "fail";
                            echo mysqli_error($con2);
                        } 
                        
                        header("Location: ../manage-food.php");
                        die();
                    }
                }
                else{
                    echo "This Image Name already exists";
                }    
            }    
        
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
        <form action="" method="POST" enctype="multipart/form-data">
        <div> Food Name: </div> <input type="text" name="food_name" required>
        <div> Category Name: </div> <input type="text" name="category_name" required>
        <div> Price: </div> <input type="number" name="price" required>
        <div> Food Description: </div> <textarea type="text" rows="10" cols="40" name="description" required></textarea>
        <div> Image: </div> <input type="file" name="image" required>
        <div> Image Name: </div> <input type="text" name="image_name1" required>
        
        <br><br>
        <input type="submit" value="Submit">
        </form>
        
    </div>
</body>
</html>