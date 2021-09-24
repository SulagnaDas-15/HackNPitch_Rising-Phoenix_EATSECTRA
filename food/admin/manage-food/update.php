<?php

    include("C:/xampp/htdocs/food/connection1.php");

    $id = $_GET['id'];
    $query1 = "select * from food where food_id='$id'";
    $result1 = mysqli_query($con2,$query1);
    $row = mysqli_fetch_assoc($result1);

    $image_name=$row['image_name'];

    $path="../../images/food/".$image_name;

    $category_id = $row['category_id'];

    $query2="select category_name from food_category where category_id='$category_id'";
    $result2=mysqli_query($con2,$query2);
    $arr=mysqli_fetch_assoc($result2);
    $category_name=$arr['category_name'];

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $food_name=$_POST['food_name'];
        $category_name = $_POST['category_name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image_name1 = $_POST['image_name1'];
        
       
        if (isset($_FILES['image']['name'])){

            $image_name=$_FILES['image']['name'];
            $ext= end(explode(".",$image_name));
            $image_name=reset(explode(".",$image_name1)).".".$ext;
            
            $query1="select category_id from food_category where category_name='$category_name'";
            
            if(!$result1=mysqli_query($con2,$query1) or mysqli_num_rows($result1)==0){
                echo "No such category available";
            }

            else{
                $arr = mysqli_fetch_assoc($result1);
                $category_id= $arr['category_id'];
                $query="select * from food where image_name='$image_name' and food_id!=$id";
                $result=mysqli_query($con2,$query);
            

                if($result==false or mysqli_num_rows($result)==0){
                    $source_path=$_FILES['image']['tmp_name'];
                    $destination_path="../../images/food/".$image_name;

                    $remove=unlink($path);

                    if ($remove==false){
                        $_SESSION['remove'] = "<div> Error: Failed to Update</div>";
                        header("Location: ../manage-food.php");
                        die();
                    }

                    $upload=move_uploaded_file($source_path,$destination_path);
                    
                    if ($upload==false){
                        
                        $_SESSION['upload']="<div clas='error'> Failed to upload Image </div>";
                        header("Location:../manage-food.php");
                        die();
                    }
                    else{
                        
                        $query2 = "update food set
                        food_name='$food_name',
                        category_id='$category_id',
                        price='$price',
                        image_name='$image_name',
                        description='$description'
                        where food_id=$id ";

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
        <div> Food Name: </div> <input type="text" name="food_name" value= <?php echo $row['food_name']; ?> required>
        <div> Category Name: </div> <input type="text" name="category_name" value= <?php echo $category_name; ?> required>
        <div> Price: </div> <input type="number" name="price" value= <?php echo $row['price']; ?> required>
        <div> Food Description: </div> <textarea type="text" rows="10" cols="40" name="description" value= <?php echo $row['description']; ?> required></textarea>
        <div> Image: </div> <input type="file" name="image" value="../../images/food/<?php echo $row['image_name']; ?>" required>
        <div> Image Name: </div> <input type="text" name="image_name1" value= <?php echo $row['image_name']; ?> required>
        
        <br><br>
        <input type="submit" value="Submit">
        </form>
        
    </div>
</body>
</html>