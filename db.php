<?php
$server = "localhost";      // Change this to your database host
$username = "root";       // Change this to your database username
$pass = '';   // Change this to your database password
$database = "todolist";       // Your database name

// Create a connection to the database
$conn = mysqli_connect($server, $username, $pass, $database);
?>