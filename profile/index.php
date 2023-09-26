    <?php
    session_start(); 
    include "../admin/attachments/header.php";
    include "../admin/attachments/navbar.php";

    include "../admin/DB/db.php";
    // Check if the user is logged in (adjust the condition as needed)
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page or display an error message
        header("Location: /todoList/admin/auth/login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Query to retrieve user data]
    $stmt = $conn->prepare("SELECT * FROM users INNER JOIN profiles ON users.id = profiles.user_id WHERE users.id = ?");
    $stmt->bind_param("i", $user_id);
    
    if ($stmt->execute()) {
        // Store the result in a variable
        $result = $stmt->get_result();
    
        // Check if user data was found
        if ($result->num_rows > 0) {
            // Fetch and display user data
            $row = $result->fetch_assoc();
            $user_name = $row['first_name'] . ' ' . $row['last_name'];
            $user_age = date('Y') - $row['birth_y'];
            $user_email = $row['email'];
            $user_gender = $row['gender'];
            $user_profession = $row['profession'];
            $bio = $row['bio'];

            echo '
            <div class="card">
                <div class="left-container"> <img src="/todoList/assets/userimg.png" alt="Profile Image">
                    <h2><span>' . $user_name . '</span></h2>
                    <p>' . $user_profession . '</p>
                    <p class="description">' . $bio . '</p>
                    <form action="/todoList/admin/logout.php" method="post">
                        <button type="submit">Log Out</button>
                    </form>
                </div>
                <div class="right-container">
                    <h3 class="gradienttext"><span>Profile Details</span></h3>
                    <table>
                        <tr>
                            <td>Name :</td>
                            <td>' . $user_name . '</td>
                        </tr>
                        <tr>
                            <td>Age :</td>
                            <td>' . $user_age . '</td>
                        </tr>
                        <tr>
                            <td>Gender :</td>
                            <td>'.$user_gender.'</td>
                        </tr>
                        <tr>
                            <td>Email :</td>
                            <td>'.$user_email.'</td>
                        </tr>
                        <tr>
                            <td>Address :</td>
                            <td>123 Main St, Anytown, USA</td>
                        </tr>
                    </table>
                </div>
            </div>
        ';
        } else {
            echo "No user data found.";
        }

        // Free the result set
        $result->free_result();
    }

    // Close the database connection
    $conn->close();
    include "../admin/attachments/footer.php";
    ?>
