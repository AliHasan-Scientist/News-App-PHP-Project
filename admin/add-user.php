<?php include "header.php"; ?>
<?php

include_once 'db-connection.php';
include_once 'config.php';
// create user table
$create_user_query = "CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `role` int(11) NOT NULL ,PRIMARY KEY (`user_id`)
);";
$process_user_query = mysqli_query($db_connection, $create_user_query);
if ($process_user_query) {
    echo "user is create successfully!";
} else {
    echo "";
};
// get data through form

if (isset($_POST['save'])) {
// variables through form
    $fname = mysqli_real_escape_string($db_connection, $_POST['fname']);
    $lname = mysqli_real_escape_string($db_connection, $_POST['lname']);
    $user = mysqli_real_escape_string($db_connection, $_POST['user']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];
    // check the user if he already in the database;
    $check_user_exist = "SELECT `username` FROM user WHERE `username`='$user';";
    $process_user_exist_query = mysqli_query($db_connection, $check_user_exist) or die("process_user_exist_query [failed!]");
    //
    if (mysqli_num_rows($process_user_exist_query) > 0) {
        echo '<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Oops! : </strong> Username is already taken please try another.
</div>';
    } else {
        $insert_user_query = "INSERT INTO `user` (`first_name`, `last_name`, `username`, `password`, `role`) VALUES ('$fname', '$lname', '$user', '$password', '$role');";
        $process_add_user_query = mysqli_query($db_connection, $insert_user_query);
        if ($process_add_user_query) {
            include_once 'config.php';
            echo "user inserted successfully";
            header("Location:{$domain_name }/admin/users.php");
        } else {
            echo "";
        }
    }

}


?>

<body>
<div id="admin - content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin - heading">Add User</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action=" <?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="user" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0">Normal User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required/>
                </form>
                <!-- Form End-->
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
        crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
        crossorigin="anonymous"></script>
</body>
<?php include "footer.php"; ?>
