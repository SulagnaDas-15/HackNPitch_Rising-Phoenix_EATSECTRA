<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body style="font-size:25px; padding:0% 20%" >
    
<?php

    include("connection1.php");

    $canteen_id = $_GET['id'];
    $query="select canteen_name from info where canteen_id='$canteen_id'";
    $result= mysqli_query($con2,$query);

    if ($result){

        $arr=mysqli_fetch_assoc($result);
        $canteen_name=$arr['canteen_name'];
    }

    $query1 = "select * from food_category where canteen_id='$canteen_id' ";
    $result1 = mysqli_query($con2,$query1);

    if($result1){
        ?>
        <h1 style="text-align:center;"><?php echo $canteen_name;?></h1><br><br><br><?php
        while($row1 = mysqli_fetch_assoc($result1)){

            $category_id=$row1['category_id'];
            $category_name=$row1['category_name'];
            $query2="select * from food where category_id='$category_id'";
            $result2= mysqli_query($con2,$query2);

            if ($result2){

                ?>
                    
                    
                    <h2 style="text-decoration:underline; width:4000px;" ><?php echo $category_name;?></h2><br><br>
                    <div style="background-color:rgba(191, 194, 197, 0.925); padding: 10px; align:left;">
                    <?php
                    while ($row2 = mysqli_fetch_assoc($result2)){

                        $image_name=$row2['image_name'];
                        $path="images/food/".$image_name;

                        $food_name=$row2['food_name'];
                        $food_id=$row2['food_id'];
                        $price=$row2['price'];

                        ?>

                                <form style="width:80%; list-style:none;  text-align:center;" method="POST" action="addtocart.php?action=add&id=<?php echo $row2["food_id"]; ?>">
                            <!-- <li style="width:80%; list-style:none;  text-align:center;"> -->
                            
                                <span style="position: relative; right: 62px; top: 19px;"><img class="img-responsive" src="<?php echo $path;?>" alt="<?php echo $path;?>" width="70px" height="70px"></span> &nbsp;&nbsp;&nbsp;
                                <span><a style="text-decoration:none; color:black;" href="desc-rating.php?id=<?php echo $food_id;?>"><?php echo $food_name;?></a></span>&nbsp;&nbsp;&nbsp;&#9;
                                <span>&#8377;&nbsp;<?php echo $price;?></span>&nbsp;&nbsp;&nbsp;
                                <input type="hidden" name="hidden_name" value="<?php echo $row2["food_name"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row2["price"]; ?>">
                                <input type="hidden" name="action" value="add">
                                <input type="hidden" name="id" value="<?php echo $row2["food_id"]; ?>">
                                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success" 
                                               value="Add to Cart"  >
                            
                            
                            <br>

                    </div>

                        <?php
                    }
                    ?>
                <?php
            }
        }
    }
?> 
</body>
</html>   

    