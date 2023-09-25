<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoList</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>



    <div class="wrapper">
        <?php
        session_start();

        include "db.php";
        // Include your database connection code here (e.g., include "db.php")

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve data from the form
            $task = $_POST["taskinp"];
            $priority = $_POST["priority"];
            $user_id = $_SESSION['user_id'];

            // Insert data into the "todos" table
            $insertTodoSQL = "INSERT INTO `todos` (`user_id`, `task`, `priority`) VALUES ('$user_id', '$task', '$priority')";

            // Execute the query
            if (mysqli_query($conn, $insertTodoSQL)) {
                // Data inserted successfully
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            } else {
                // Error inserting data
                echo "Error adding task: " . mysqli_error($conn);
            }

            // Close the database connection when done
            mysqli_close($conn);
        }
        ?>
        <?php include "header.php"; ?>
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
                        <img src="img/check1.png" alt="">

                    </div>
                    <h2 class="heading">Task List</h2>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 30%;">Task</th>
                                <th style="width: 15%;">Priority</th>
                                <th style="width: 15%;">Due-Date</th>
                                <th style="width: 10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $user_id = $_SESSION['user_id'];
                            $getTasksSQL = "SELECT * FROM `todos` WHERE `user_id` = '$user_id'";
                            $result = mysqli_query($conn, $getTasksSQL);

                            if ($result) {
                                // Loop through the retrieved tasks and populate the table rows
                                while ($row = mysqli_fetch_assoc($result)) {
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
                                            <button title="Edit" class="edit"><i class="fa-regular fa-pen-to-square"></i></button>
                                            <button title="Remove" class="remove"><i class="fas fa-trash-alt fa-lg text-warning"></i></button>
                                        </td>
                                    </tr>';
                                }

                                // Close the table
                                echo '</tbody>
                                </table>';
                            } else {
                                echo "Error fetching tasks: " . mysqli_error($conn);
                            }

                            // Close the database connection
                            mysqli_close($conn);
                            ?>
                        </tbody>

                    </table>
                </div>

            </section>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let priorities = document.querySelectorAll(".priority");

            priorities.forEach((priority) => {
                const priorityValue = priority.dataset.priority;

                if (priorityValue === "Low") {
                    priority.style.backgroundColor = "#13c16d"
                } else if (priorityValue === "Medium") {
                    priority.style.backgroundColor = "#ffc107"
                } else if (priorityValue === "High") {
                    priority.style.backgroundColor = "#dc3545"
                }
            });
        });


        // const taskToggleBtn = document.getElementById('taskToggleBtn');
        const card = document.getElementById('newtask_card');
        let tasktoggle = () => {
            console.log("sdsds")
            card.classList.toggle('hidden');
        }



        ////header toggling
        let container = document.getElementById("container")
        let header = document.getElementById("header")
        let lastScrollTop = 0;
        document.addEventListener("DOMContentLoaded", function() {
            header.style.top = 0
        });
        container.onscroll = function() {
            const scrollTop = container.scrollTop;
            const windowHeight = container.clientHeight;
            const contentHeight = container.scrollHeight;

            if (scrollTop === 0) {
                // User is at the top of the container
                header.style.top = 0
            } else if (scrollTop + windowHeight === contentHeight) {
                // User is at the bottom of the container
                header.style.top = 0
            } else if (scrollTop > lastScrollTop) {
                // User is scrolling down
                header.style.top = -85 + "px";
            } else {
                // User is scrolling up
                header.style.top = 0;
            }

            lastScrollTop = scrollTop;
        };
    </script>


    <script src="script.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
</body>

</html>