<?php
$server_name = 'localhost';
$user_name = 'root';
$password = '';
$database = 'new-app';
$db_connection = mysqli_connect($server_name, $user_name, $password);

if ($db_connection) {
    echo true;
} else {
    echo die($db_connection) . mysqli_connect_error();
}

