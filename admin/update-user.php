<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <?php
                include_once('db-connection.php');
                $id = $_GET['id'];


                $get_user = "SELECT * FROM `user` WHERE `user_id`='$id'";
                $process_get_user_query = mysqli_query($db_connection, $get_user) or die();
                if (mysqli_num_rows($process_get_user_query) > 0) {
                    while ($row = mysqli_fetch_assoc($process_get_user_query)) {


                        ?>
                        <!-- Form Start -->
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control"
                                       value="<?php echo $row['first_name'] ?>" placeholder=""
                                       required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control"
                                       value="<?php echo $row['last_name'] ?>" placeholder=""
                                       required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control"
                                       value="<?php echo $row['username'] ?>" placeholder=""
                                       required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                                    <?php
                                    if ($row['role'] == 1) {
                                        echo ' 
                                    <option value="1" selected>Admin</option>
                                    <option value="0" >Normal</option>
                                    ';

                                    } else {
                                        echo ' <option  value="0" selected>Normal</option>;
                                         echo  <option  value="1" >Admin</option>;

                                   ';
                                    }
                                    ?>

                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required/>
                        </form>
                        <!-- /Form -->
                        <?php
                    }
                }

                ?>
                <!--                update data-->
                <?php
                if (isset($_POST['submit'])) {
                    $first_name = $_POST['f_name'];
                    $last_name = $_POST['l_name'];
                    $username = $_POST['username'];
                    $role = $_POST['role'];
                    $update_user_data_query = "UPDATE `user` SET `first_name` = '$first_name' , `last_name` ='$last_name' ,`username` ='$username' , `role`='$role' WHERE `user`.`user_id` = '$id'; ";
                    $process_update_user_query = mysqli_query($db_connection, $update_user_data_query);
                    if ($process_update_user_query) {
                        echo "<p> user is updated</p> ";
                    } else {
                        echo "user is not updated";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
