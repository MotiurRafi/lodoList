<?php
include_once "./DB/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task_id"])) {
    $id = $_POST["task_id"];
    $task = $_POST["editTaskTitle"];
    $priority = $_POST["editPriority"];

    $stmt = $conn->prepare("UPDATE todos SET `task` = ?, `priority` = ? WHERE `id` = ?");
    $stmt->bind_param('ssi', $task, $priority, $id);
    if ($stmt->execute()) {
        header("Location: /todoList");
    } else {
        // Error occurred while deleting the task
        echo "Error deleting the task: " . $stmt->error;
    }
}