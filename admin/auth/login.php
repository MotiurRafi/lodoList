    <?php
    include "../attachments/header.php";
    // Start the session
    session_start();

    // Include the database connection file (assuming db.php contains your database connection)
    include "../DB/db.php";

    // Check if the user is already logged in, redirect if they are
    if (isset($_SESSION['user_id'])) {
        // Redirect to the home page or display an error message
        header("Location: /todoList");
        exit();
    }

    // Initialize an error message variable
    $errorMessage = "";

    // Check if the request method is POST and username is set

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"])) {
        // Get input values
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Hash the provided password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute a database query to check the user's credentials
        $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = ?");
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            // Get the result set
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // Fetch the user data
                $row = $result->fetch_assoc();

                if (password_verify($password, $row["password"])) {
                    // Set session variables for the user
                    $_SESSION["user_id"] = $row["id"];
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["email"] = $row["email"];

                    // Redirect to a protected page or wherever you want
                    header("Location: /todoList?user=".$_SESSION["username"]."");
                    exit();
                } else {
                    // Password is incorrect, append an error message
                    $errorMessage .= "Invalid password. ";
                }
            } else {
                // User not found, append an error message
                $errorMessage .= "User not found. ";
            }

            // Free the result set
            $result->free_result();
        } else {
            // Error in SQL query, append an error message
            $errorMessage .= "Error executing the query. ";
        }
    }

    // Close the database connection
    $conn->close();
    ?>

    <div class="container">
        <img src="/todoList/assets/login.png" alt="" class="bg_img">
        <div class="signin_card">
            <img src="/todoList/assets/logo.png" alt="">
            <h2 class="heading"><span>Welcome Back!</span></h2>
            <div class="alert_container">
                <p class="alert"><?php echo $errorMessage ?></p>
            </div>
            <form action="/todoList/admin/auth/login.php" method="post" class="">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="submit">Log In</button>
            </form>

            <a href="./register.php" class="tosignup">Doesn't have an Account? SignUp!</a>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        ::-webkit-scrollbar {
            width: 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --first-color: rgba(126, 64, 246, 255);
            /*#7e40f6 */
            --first-color-opacity: rgba(126, 64, 246, .7);
            --sec-color: rgba(80, 138, 252, 255);
            /*#508afc */
            --sec-color-opacity: rgba(80, 138, 252, .7);
            --third-color: rgb(105, 100, 248);
            --blueblack-color: rgba(35, 17, 76, 1);
            /*#23114c*/
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --success-color: #13c16d;
        }

        span {
            background: linear-gradient(90deg, var(--first-color), var(--sec-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .alert_container {
            height: 1.2rem;
            width: 100%;
            display: flex;
            gap: .5rem;
            padding: 0 4rem;
        }

        .alert_container .alert {
            text-align: left;
            font-size: .7rem;
            color: var(--danger-color);
        }

        .container {
            height: 100vh;
            /* background-color: #ffc107; */
            overflow: hidden;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container .bg_img {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            width: 60%;

        }

        .container .signin_card {
            backdrop-filter: blur(3px);
            background-color: rgba(80, 138, 252, .4);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem 2rem;
            width: 35%;
            border-radius: 4rem;
            margin: 0 0 0 -20rem;
        }

        .container .signin_card img {
            height: 8rem;
        }

        .container .signin_card h2 {
            font-size: 2rem;
            color: white;
            font-weight: 400;
            margin: 0 0 .5rem 0;
        }

        .container .signin_card form {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-direction: column;
            width: 100%;
            gap: 1rem;
        }

        .container .signin_card form input {
            background: transparent;
            padding: 0.3rem 1rem;
            border-radius: 0.5rem;
            outline: none;
            border: 2px solid #c4bada;
            color: var(--third-color);
            font-size: .9rem;
            width: 100%;
        }

        .container .signin_card form .submit {
            background: transparent;
            padding: 0.3rem 1rem;
            border-radius: 0.5rem;
            outline: none;
            border: 1px solid var(--sec-color);
            color: var(--third-color);
            font-size: .9rem;
            transition: .3s ease;
            margin: 0 0 0 13rem;
            cursor: pointer;
        }

        .submit:hover {
            background: linear-gradient(90deg, var(--first-color), var(--sec-color)) !important;
            color: #fff !important;
        }

        .signin_card .tosignup {
            text-decoration: none;
            border-top: 1px solid #c2bbda;
            margin: 2rem 0 0 0;
            padding: 1rem 0 0 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            color: #675a9f;
            width: 100%;
        }
    </style>
    </body>

    </html>