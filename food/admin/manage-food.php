<html>
    <head>
        <title> EatSpectra - Admin Panel</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
    <?php 
        include('partials/menu.php');
        include('../connection1.php');
    ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Food</h1> <br>

                <button><a href="manage-food/add.php">Add Food</a></button>
                <br>
                <table class="tbl-full">
                    <tr>
                        <th>S.no</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Availability</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    
                    $canteen_id=$_SESSION['canteen_id'];
                    $query = "select * from food where canteen_id='$canteen_id'";
                    $result = mysqli_query($con2,$query);

                    if ($result){

                        $count = mysqli_num_rows($result);
                        if ($count>0){

                            $sn = 1;
                            while($rows = mysqli_fetch_assoc($result)){
                                
                                $food_id = $rows['food_id'];
                                $category_id = $rows['category_id'];
                                $image_name = $rows['image_name'];
                                $food_name = $rows['food_name'];
                                $price = $rows['price'];
                                $availability = $rows['availability'];
                                $description = $rows['description'];

                                $query3= "select category_name from food_category where category_id='$category_id'";
                                $result3= mysqli_query($con2,$query3);
                                $arr2=mysqli_fetch_assoc($result3);
                                $category_name=$arr2['category_name'];
                                ?>

                                <tr>
                                    <td><?php echo $sn ?></td>
                                    <td><?php echo $food_name ?></td>
                                    <td><?php echo $description ?></td>
                                    <td><?php echo $category_name ?></td>
                                    
                                    <td><img src="../images/food/<?php echo $image_name;?>" alt="<?php echo $image_name ?>" width="100px" height="100px"></td>
                                    <td><?php echo $price ?></td>
                                    <td> <button><a href="manage-food/minus.php?id=<?php echo $food_id;?>">-</a></button>&nbsp;&nbsp;<?php echo $availability ?>&nbsp;&nbsp;<button><a href="manage-food/plus.php?id=<?php echo $food_id?>">+</a></button></td>
                                    <td>
                                    <button><a href="manage-food/update.php?id=<?php echo $food_id?>">Update</a></button>
                                    <button><a href="manage-food/delete.php?id=<?php echo $food_id?>&img_name=<?php echo $image_name?>">Delete</a></button>
                                    </td>
                                </tr>
                                <?php
                                $sn++;
                            }
                        }
                    }
                    ?>
                </table>
                
            </div>
        </div>
    </body>
</html>