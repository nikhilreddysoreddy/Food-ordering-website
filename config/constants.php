<?php
    //start the session
    session_start();


    //create constant to store non repeating values
    define('SITEURL', 'http://localhost/food-order/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'nikhil23');
    define('DB_NAME', 'food-order');
    $conn = mysqli_connect('LOCALHOST', DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error());//database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
?>