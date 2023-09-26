<?php
// Start the session
session_start();

// Destroy all session data
session_destroy();

// Redirect to the home page
header("Location: /todoList"); // Replace with the actual URL of your home page
exit();
?>