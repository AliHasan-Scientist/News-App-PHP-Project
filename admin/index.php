<?php
session_start();

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<div id="wrapper-admin" class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <img class="logo" src="images/news.jpg">
                <h3 class="heading">Admin</h3>
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="" required>
                    </div>
                    <input type="submit" name="login" class="btn btn-primary" value="login"/>
                </form>
                <!-- /Form  End -->
                <!--  Login the user-->
                <?php
                if (isset($_POST['login'])) {
                    include_once('db-connection.php');
                    // get the date from table
                    $_SESSION['username'] = $_POST["username"];

//     get the user name and password from user table
                    $get_user_data_query = "SELECT `username` , `password` FROM `user`  ";
                    $process_get_user_query = mysqli_query($db_connection, $get_user_data_query);
                    $username_f = $_POST["username"];
                    $password_f = $_POST["password"];
                    $login_user = false;
                    while ($row = mysqli_fetch_assoc($process_get_user_query)) {
                        $username = $row["username"];
                        $password = $row["password"];
                        if (password_verify($password_f, $password) && $username_f == $username) {
                            $login_user = true;

                        } else {
                            $login_user = false;
                        }
                    }
                    if ($login_user) {
                        include_once("config.php");
                        echo "you are login successfully";
                        header("Location:{$domain_name }/admin/users.php");
                    } else {
                        echo "bad credentials";
                    }
                }


                ?>

            </div>
        </div>
    </div>
</div>
</body>
</html>
