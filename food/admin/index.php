<?php
    include("../connection1.php");
    
    /*

    $admin_data=check_login($con1);
    $canteen=$admin_data('canteen');

    $query="select canteen_id from info where canteen_name='$canteen'";
    $result=mysqli_query($con2,$query);
    $arr=mysqli_fetch_assoc($result);
    $canteen_id=$arr['canteen_id'];*/

    
?>

<html>
    <head>
        <title> EatSpectra - Admin Panel</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>

        <?php
        include('partials/menu.php');
        ?>
        <div class="main-content">
            
                <h1>DASHBOARD</h1>
                <br><br><br><br>
                <div class="col-4-img text-center">

                    <?php
                        /*echo $_SESSION['canteen_name'];*/
                        $canteen_name = $_SESSION['canteen_name'];
                        $query="select canteen_img from info where canteen_name='$canteen_name'";
                        $result=mysqli_query($con2,$query);
                        $arr=mysqli_fetch_assoc($result);
                        $canteen_img=$arr['canteen_img'];
                    ?>

                    <img type="img" src="../images/canteen/<?php echo $canteen_img;?>" alt="<?php echo $canteen_img;?>" width="40%">
                </div>
                <br><br>
                <div class="wrapper">
                <div class="col-4">
                    <h1>5</h1>
                    <br>
                    Categories
                </div>
                <div class="col-4">
                    <h1>5</h1>
                    <br>
                    Categories
                </div>
                <div class="col-4 ">
                    <h1>5</h1>
                    <br>
                    Categories
                </div>
                <div class="col-4 ">
                    <h1>5</h1>
                    <br>
                    Categories
                </div>
                
                <div class="clearfix"></div>
            </div>
        </div>
    </body>
</html>