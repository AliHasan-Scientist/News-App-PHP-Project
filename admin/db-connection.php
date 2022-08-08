<?php
$server_name = 'localhost';
$user_name = 'root';
$password = '';
$database = 'news-app';
$db_connection = mysqli_connect($server_name, $user_name, $password, $database);

if ($db_connection) {
    echo '';
} else {
    echo die($db_connection) . mysqli_connect_error();
}

