<?php
$server = "localhost";      // Change this to your database host
$username = "root";       // Change this to your database username
$pass = '';   // Change this to your database password
$database = "todolist";       // Your database name

// Create a connection to the database

$conn = new mysqli($server , $username, $pass, $database);

if ($conn -> connect_errno) {
    echo " Failed to connect to MySQL" . $conn ->connect_error;
};