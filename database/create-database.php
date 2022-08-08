<?php
include_once('db-connection.php');
$create_db_query = "CREATE DATABASE  `news-app`";
$process_create_db = mysqli_query($db_connection, $create_db_query);
if ($process_create_db) {
    echo "db successfully created";
} else {
    echo "db is no created successfully";
}