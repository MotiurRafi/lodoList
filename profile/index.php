<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating a Stunning Personal Profile Card with HTML and CSS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
    session_start(); 
    include "../header.php";
    include "../db.php";

    if (!isset($_SESSION['user_id'])) {
        echo "User is not logged in."; // You can redirect to a login page here
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Query to retrieve user data
    $query = "SELECT * FROM users INNER JOIN profiles on users.id = profiles.user_id WHERE users.id = $user_id";
    $result = mysqli_query($conn, $query);

    // Check if the query executed successfully
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
    } else {
        // Check if user data was found
        if (mysqli_num_rows($result) > 0) {
            // Fetch and display user data
            $row = mysqli_fetch_assoc($result);
            $user_name = $row['first_name'] . ' ' . $row['last_name'];
            $user_age = date('Y') - $row['birth_y'];
            $user_email = $row['email'];
            $user_gender = $row['gender'];
            $user_profession = $row['profession'];
            $bio = $row['bio'];

            echo '
            <div class="card">
                <div class="left-container"> <img src="https://cdn.pixabay.com/photo/2015/01/08/18/29/entrepreneur-593358__480.jpg" alt="Profile Image">
                    <h2><span>' . $user_name . '</span></h2>
                    <p>' . $user_profession . '</p>
                    <p class="description">' . $bio . '</p>
                    <form action="/todoList/logout" method="post">
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
        mysqli_free_result($result);
    }

    // Close the database connection
    mysqli_close($conn);

    ?>





</body>

</html>