
<html>
    <head>
        <title> EatSpectra - Admin Panel</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>

    <?php
        include("../connection1.php");
        include('partials/menu.php');
        /*$username=$_SESSION['admin_username'];

        $query="select canteen from admin_tbl where admin_username='$username'";
        $result=mysqli_query($con1,$query);

        if ($result){

            $arr=mysqli_fetch_assoc($result);
            $canteen_name=$arr['canteen'];

            $query="select canteen_id from info where canteen_name='$canteen_name'";
            $result=mysqli_query($con2,$query);

            if ($result){

                $arr=mysqli_fetch_assoc($result);
                $canteen_id=$arr['canteen_id'];
            }
        }*/
    ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Category</h1> <br>

                <button><a href="manage-category/add.php">Add Category</a></button>
                
                <br><br>

                <?php
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
                ?> 

                <br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.no</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $query = "select * from food_category where canteen_id='$canteen_id'";
                    $result = mysqli_query($con2,$query);

                    if ($result){

                        $count = mysqli_num_rows($result);
                        if ($count>0){

                            $sn = 1;
                            while($rows = mysqli_fetch_assoc($result)){
                                
                                $id = $rows['category_id'];
                                $category_name = $rows['category_name'];
                                $image_name = $rows['image_name'];
                                ?>

                                <tr>
                                    <td><?php echo $sn ?></td>
                                    <td><?php echo $category_name ?></td>
                                    <td><img src="../images/category/<?php echo $image_name;?>" alt="<?php echo $image_name ?>" width="100px" height="120px"></td>
                                    
                                    <td>
                                    <button><a href="manage-category/update.php?id=<?php echo $id?>">Update</a></button>
                                    <button><a href="manage-category/delete.php?id=<?php echo $id?>&img_name=<?php echo $image_name?>">Delete</a></button>
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