<?php

    include("C:/xampp/htdocs/food/connection1.php");

    $id = $_GET['id'];

    $query1 = "select availability from food where food_id='$id'";
    $result1 = mysqli_query($con2,$query1);
    $row = mysqli_fetch_assoc($result1);

    $availability=$row['availability'];
    $availability-=1;

    $query2 = "update food set availability='$availability' where food_id=$id ";
    
    

    mysqli_query($con2,$query2);
    header("Location: ../manage-food.php");
    die();