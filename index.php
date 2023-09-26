<?php
session_start();

// Check if the user is logged in (adjust the condition as needed)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: /todoList/admin/auth/login.php");
    exit();
}




include "./admin/DB/db.php";
// Include your database connection code here (e.g., include "db.php")

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve data from the form
    $task = $_POST["taskinp"];
    $priority = $_POST["priority"];
    $user_id = $_SESSION['user_id'];

    // Insert data into the "todos" table
    $stmt = $conn->prepare("INSERT INTO `todos` (`user_id`, `task`, `priority`) VALUES ()");
    $stmt->bind_param("iss", $user_id , $task , $priority);
    // Execute the query
    if ($stmt->execute()) {
        // Data inserted successfully
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        // Error inserting data
        echo "Error adding task: " . mysqli_error($conn);
    }

    // Close the database connection when done
    $conn->close();
}
?>
<?php include_once "./admin/attachments/header.php" ?>
<?php include_once "./admin/attachments/navbar.php" ?>

<div class="container" id="container">
    <section class="newtask_sec">
        <button class="tasktoggle_btn" id="taskToggleBtn" onclick="tasktoggle()"><i class="fa-regular fa-plus"></i> NEW TASK</button>
        <div class="newtask_card hidden" id="newtask_card">
            <div class="form_container">
                <form action="/todoList/index.php" method="post" class="taskform">
                    <textarea name="taskinp" id="taskinp" rows="6" placeholder="Task" required></textarea>
                    <div class="priority_box">
                        <p>Priority -</p>
                        <label>
                            <input type="radio" name="priority" value="Low" required> Low
                        </label>
                        <label>
                            <input type="radio" name="priority" value="Medium" required> Medium
                        </label>
                        <label>
                            <input type="radio" name="priority" value="High" required> High
                        </label>
                    </div>
                    <button type="submit" class="submit">Add Task</button>
                </form>
            </div>
        </div>
    </section>
    <section class="tasklist_sec">
        <div class="task_list_card">
            <div class="tasks_icon">
                <img src="/todoList/assets/check1.png" alt="">

            </div>
            <h2 class="heading">Task List</h2>
            <table>
                <thead>
                    <tr>
                        <th style="width: 30%;">Task</th>
                        <th style="width: 20%;">Priority</th>
                        <th style="width: 15%;">Due-Date</th>
                        <th style="width: 10%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user_id = $_SESSION['user_id'];

                    $stmt = $conn->prepare("SELECT * FROM `todos` WHERE `user_id` = ?");
                    $stmt->bind_param("i", $user_id);
                    
                    if ($stmt->execute()) {
                        $result = $stmt->get_result();
                        // Loop through the retrieved tasks and populate the table rows
                        while ($row = $result->fetch_assoc()) {
                            $dueDate = strtotime($row['duedate']); // Convert duedate to a timestamp
                            $formattedDueDate = date("d M Y", $dueDate);
                            echo '<tr>
                                        <td>' . $row['task'] . '</td>
                                        <td>
                                            <h6 class="priority" data-priority="' . $row['priority'] . '">' . $row['priority'] . '</h6>
                                        </td>
                                        <td>' . $formattedDueDate . '</td>
                                        <td>
                                            <button title="Done" class="done"><i class="fas fa-check fa-lg text-success me-3"></i></button>
                                            <button title="Edit" class="editbtn" id="editbtn"><i class="fa-regular fa-pen-to-square"></i></button>
                                            <form action="./admin/delete_task.php" method="POST" style="display: unset;">
                                                <!-- Other task information -->
                                                <button title="Remove" class="remove" style="margin: unset;" type="submit" name="remove_task" value=" '. $row['id'].'">
                                                    <i class="fas fa-trash-alt fa-lg text-warning"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="taskEdit" id="taskEdit" style="display:none;">
                                        <form action="./admin/edit_task.php" method="post">
                                            <td>
                                                <textarea name="editTaskTitle" class="editTaskTitle">'.$row["task"].'</textarea>
                                            </td>
                                            <td>
                                                <label class="editPriority editPriority1">
                                                    <input type="radio" name="editPriority" value="Low" required> Low
                                                </label>
                                                <label class="editPriority editPriority2">
                                                    <input type="radio" name="editPriority" value="Medium" required> Medium
                                                </label>
                                                <label class="editPriority editPriority3">
                                                    <input type="radio" name="editPriority" value="High" required> High
                                                </label>
                                            </td>
                                            <td><button type="submit" class="submit" name="task_id" value="'. $row["id"].'">Edit</button></td>
                                        </form>
                                    </tr>
                                    ';
                        }

                        // Close the table
                        echo '</tbody>
                                </table>';
                    } else {
                        echo "Error fetching tasks: " . mysqli_error($conn);
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>

            </table>
        </div>

    </section>
    <footer class="footer">
        All the contents are owened by YxK Studio
    </footer>
</div>



<?php include_once "./admin/attachments/footer.php" ?>