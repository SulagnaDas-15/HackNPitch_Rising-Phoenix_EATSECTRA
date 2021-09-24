<?php
session_start();
    include("C:/xampp/htdocs/food/connection1.php");
    

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $category_name = $_POST['category_name'];
        $image_name1 = $_POST['image_name1'];
        $canteen_id=$_SESSION['canteen_id'];
       
        if (isset($_FILES['image']['name'])){

            $image_name=$_FILES['image']['name'];
            $ext= end(explode(".",$image_name));
            $image_name=$image_name1.".".$ext;
            
            $query="select * from food_category where image_name='$image_name'";
            $result=mysqli_query($con2,$query);

            if($result==false or mysqli_num_rows($result)==0){
                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="C:/xampp/htdocs/food/images/category/".$image_name;

                $upload=move_uploaded_file($source_path,$destination_path);
                
                if ($upload==false){
                    
                    $_SESSION['upload']="<div clas='error'> Failed to upload Image </div>";
                    header("Location:../manage-category.php");
                    die();
                }
                else{
                    
                    $query="insert into food_category (category_name,image_name,canteen_id) values ('$category_name','$image_name','$canteen_id')";
                    if(!mysqli_query($con2,$query)){
                        echo "fail";
                        echo mysqli_error($con2);
                    } 
                    
                    header("Location: ../manage-category.php");
                    die();
                }
            }
            else{
                echo "This Image Name already exists";
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
        <div> Category Name: </div> <input type="text" name="category_name" required>
        <div> Image: </div> <input type="file" name="image" required>
        <div> Image Name: </div> <input type="text" name="image_name1" required>
        
        <br><br>
        <input type="submit" value="Submit">
        </form>
        
    </div>
</body>
</html>