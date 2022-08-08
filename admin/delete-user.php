<?php
include_once('db-connection.php');
include_once('config.php');
$user_id = $_GET['id'];
$delete_user_query = "DELETE FROM `user` WHERE `user_id`='$user_id' ";
$process_delete_user_query = mysqli_query($db_connection, $delete_user_query);
if ($process_delete_user_query) {
    echo "user is deleted successfully";
    header("Location:{$domain_name}/admin/users.php");
} else {
    echo "user is not deleted";
}
mysqli_close($db_connection);