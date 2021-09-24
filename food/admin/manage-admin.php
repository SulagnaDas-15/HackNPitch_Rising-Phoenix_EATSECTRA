
<html>
    <head>
        <title> EatSpectra - Admin Panel</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>

        <?php
            include("../connection1.php");
            include('partials/menu.php');

            $canteen_id=$_SESSION['canteen_id'];
            $query="select canteen_name from info where canteen_id='$canteen_id'";
            $result=mysqli_query($con2,$query);

            if($result){

                $arr=mysqli_fetch_assoc($result);
                $canteen_name=$arr['canteen_name'];
            }
        ?>
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1> <br>

                <button><a href="manage-admin/add.php">Add Admin</a></button>
                <br>
                <table class="tbl-full">
                    <tr>
                        <th>S.no</th>
                        <th>Fullname</th>
                        <th>Position</th>
                        <th>Username</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    $query = "select * from admin_tbl where canteen='$canteen_name'";
                    $result = mysqli_query($con1,$query);

                    if ($result){

                        $count = mysqli_num_rows($result);
                        if ($count>0){

                            $sn = 1;
                            while($rows = mysqli_fetch_assoc($result)){
                                
                                $id = $rows['id'];
                                $fullname = $rows['fullname'];
                                $position = $rows['position'];
                                $admin_username = $rows['admin_username'];
                                $contact = $rows['contact'];
                                $email = $rows['email'];
                                ?>

                                <tr>
                                    <td><?php echo $sn ?></td>
                                    <td><?php echo $fullname ?></td>
                                    <td><?php echo $position ?></td>
                                    <td><?php echo $admin_username ?></td>
                                    <td><?php echo $contact ?></td>
                                    <td><?php echo $email ?></td>
                                    <td>
                                    <button><a href="manage-admin/update.php?id=<?php echo $id ?>">Update</a></button>
                                    <button><a href="manage-admin/delete.php?id=<?php echo $id ?>">Delete</a></button>
                                    <button><a href="manage-admin/change-pass.php?id=<?php echo $id ?>">Change Password</a></button>
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