<?php
session_start();
session_destroy();
header("Location:http://localhost:9090/news-app/admin/");

?>
