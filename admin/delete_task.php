<?php
include_once "./DB/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_task"])) {
    $task_id = $_POST["remove_task"];
    $stmt = $conn->prepare("DELETE FROM todos WHERE id = ?");
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        header("Location: /todoList");
    } else {
        // Error occurred while deleting the task
        echo "Error deleting the task: " . $stmt->error;
    }
}
