<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn</title>
</head>

<body>
    <?php
    // Start the session
    session_start();
    include "../db.php";

    $errorMessage = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get input values
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Hash the provided password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Query the database to check the user's credentials
        $getUserSQL = "SELECT * FROM `users` WHERE `username` = '$username'";
        $result = mysqli_query($conn, $getUserSQL);

        if ($result && mysqli_num_rows($result) == 1) {
            // Fetch the user data from the result
            $row = mysqli_fetch_assoc($result);

            // Verify the hashed password
            if (password_verify($password, $row["password"])) {
                // Login successful, store user data in session
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["email"] = $row["email"];

                // Redirect to a protected page or wherever you want
                header("Location: /todoList");
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
        mysqli_free_result($result);
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="container">
        <img src="../img/login.png" alt="" class="bg_img">
        <div class="signin_card">
            <a href="/todoList"><img src="../img/logo.png" alt=""></a>
            <h2 class="heading"><span>Welcome Back!</span></h2>
            <div class="alert_container">
                <p class="alert"><?php echo $errorMessage ?></p>
            </div>
            <form action="/todoList/login/index.php" method="post" class="">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="submit">Log In</button>
            </form>

            <a href="/todoList/signup" class="tosignup">Doesn't have an Account? SignUp!</a>
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