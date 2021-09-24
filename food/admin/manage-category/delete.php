<?php

include("C:/xampp/htdocs/food/connection1.php");

if(isset($_GET['id']) && isset($_GET['img_name'])){
    $id = $_GET['id'];
    $image_name=$_GET['img_name'];

    $query="select * from food where category_id='$id'";
    $result=mysqli_query($con2,$query);

    if($result){
        $rows=mysqli_fetch_assoc($result);

        while($rows = mysqli_fetch_assoc($result)){
            $food_id = $rows['food_id'];
            $img_name=$rows['image_name'];

            $path="../../images/food/".$img_name;
            $remove=unlink($path);

            if ($remove==false){
                $_SESSION['remove'] = "<div> Error: Failed to Delete</div>";
                header("Location: ../manage-category.php");
                die();
            }
            else{
                $query5 = "delete from food where food_id='$food_id'" ;
                $result5 = mysqli_query($con2,$query5) || die("Failed to delete");
                header("Location: ../manage-category.php");
            }
        }
    }

    $path="../../images/category/".$image_name;
    $remove=unlink($path);

    if ($remove==false){
        $_SESSION['remove'] = "<div> Error: Failed to Delete</div>";
        header("Location: ../manage-category.php");
        die();
    }

    else{
        $query = "delete from food_category where category_id='$id'" ;
        $result = mysqli_query($con2,$query) || die("Failed to delete");

        header("Location: ../manage-category.php");
    }
}
else{
    $_SESSION['remove'] = "<div> Error: Failed to Delete</div>";
    header("Location: ../manage-category.php");
    die();
}
?>