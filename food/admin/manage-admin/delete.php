<?php

include("C:/xampp/htdocs/food/connection1.php");

$id = $_GET['id'];

$query = "delete from admin_tbl where id='$id'" ;
$result = mysqli_query($con1,$query) || die("Failed to delete");

header("Location: ../manage-admin.php");
?>