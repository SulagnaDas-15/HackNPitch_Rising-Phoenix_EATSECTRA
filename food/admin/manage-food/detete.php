<?php
session_start();
include("C:/xampp/htdocs/food/connection1.php");

if(isset($_GET['id']) && isset($_GET['img_name'])){
    $id = $_GET['id'];
    $image_name=$_GET['img_name'];

    $path="../../images/food/".$image_name;
    $remove=unlink($path);

    if ($remove==false){
        $_SESSION['remove'] = "<div> Error: Failed to Delete</div>";
        header("Location: ../manage-food.php");
        die();
    }

    else{
        $query = "delete from food where food_id='$id'" ;
        $result = mysqli_query($con2,$query) || die("Failed to delete");

        header("Location: ../manage-food.php");
    }
}
else{
    $_SESSION['remove'] = "<div> Error: Failed to Delete</div>";
    header("Location: ../manage-food.php");
    die();
}
?>