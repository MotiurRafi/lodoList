<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
</head>



<body>
    <?php
    session_start();
    include "../db.php";
    $errorMessages = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve data from the form and set as PHP variables
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $bio = $_POST["bio"];
        $username = $_POST["username"];
        $day = $_POST["day"];
        $month = $_POST["month"];
        $year = $_POST["year"];
        $gender = $_POST["gender"];
        $profession = $_POST["profession"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $confirm_pass = $_POST["confirm_pass"];

        if ($pass !== $confirm_pass) {
            $errorMessages[] = "Password and Confirm Password do not match!";
        }

        $checkUsernameSQL = "SELECT * FROM `users` WHERE `username` = '$username'";
        $resultUsername = mysqli_query($conn, $checkUsernameSQL);

        if (mysqli_num_rows($resultUsername) > 0) {
            $errorMessages[] = "Please use a different username!";
        }

        // Check if the email is unique
        $checkEmailSQL = "SELECT * FROM `users` WHERE `email` = '$email'";
        $resultEmail = mysqli_query($conn, $checkEmailSQL);

        if (mysqli_num_rows($resultEmail) > 0) {
            $errorMessages[] = "Please use a different email!";
        }

        if (empty($errorMessages)) {
            // Hash the password
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

            // SQL query to insert data into the "users" table
            $insertUserSQL = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('$username', '$email', '$hashedPassword')";

            // Execute the query
            if (mysqli_query($conn, $insertUserSQL)) {
                // Retrieve the last inserted user ID
                $user_id = mysqli_insert_id($conn);

                // SQL query to insert data into the "profile" table
                $insertProfileSQL = "INSERT INTO `profiles` (`user_id`, `first_name`, `last_name`, `bio`, `gender`, `birth_d`, `birth_m`, `birth_y`, `profession`) VALUES ('$user_id', '$fname', '$lname', '$bio', '$gender', '$day', '$month', '$year', '$profession')";

                // Execute the query
                if (mysqli_query($conn, $insertProfileSQL)) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    header("Location: /todoList?user=$username");
                    exit();
                } else {
                    echo"Error inserting data into the profile table: " . mysqli_error($conn);
                }
            } else {
                echo  "Error inserting data into the users table: " . mysqli_error($conn);
            }
        }
    }

    // Close the database connection when done
    mysqli_close($conn);
    ?>
    <div class="container">
        <div class="signup_card">
            <a href="/todoList"><img src="../img/logo.png" alt=""></a>
            <h2><span>Create an Account!</span></h2>
            <div class="alert_container">
                <?php
                if (!empty($errorMessages)) {
                    foreach ($errorMessages as $errorMessage) {
                        echo '<p class="alert">' . $errorMessage . '</p>';
                    }
                }
                ?>
            </div>
            <form action="/todoList/signup/index.php" method="post" class="signupform">
                <input type="text" name="fname" placeholder="First Name" required>
                <input type="text" name="lname" placeholder="Last Name" required>
                <textarea name="bio" id="bio" rows="4" class="bio" placeholder="Bio"></textarea>
                <input type="text" name="username" placeholder="Username" required>
                <!-- date-of-birth -->
                <div class="dateofbirth">
                    Date of Birth -
                    <!-- Day Select -->
                    <select id="day" name="day" required>
                        <option disabled selected>Day</option>
                        <?php
                        for ($day = 1; $day <= 31; $day++) {
                            $formattedDay = str_pad($day, 2, '0', STR_PAD_LEFT); // Zero-padded day
                            echo "<option value='$formattedDay'>$formattedDay</option>";
                        }
                        ?>
                    </select>

                    <!-- Month Select -->
                    <select id="month" name="month" required>
                        <option disabled selected>Month</option>
                        <?php
                        $monthNames = ['Jan',  'Feb',  'Mar',  'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                        foreach ($monthNames as $monthName) {
                            echo "<option value='$monthName'>$monthName</option>";
                        }
                        ?>
                    </select>

                    <!-- Year Select -->
                    <select id="year" name="year" required>
                        <option disabled selected>Year</option>
                        <?php
                        for ($year = 1990; $year <= 2007; $year++) {
                            echo "<option value='$year'>$year</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="gender-options">
                    Gender -
                    <div class="male-option gender-option">
                        <input type="radio" name="gender" id="maleinp" value="Male" required>
                        <label for="maleinp">Male</label>
                    </div>
                    <div class="female-option gender-option">
                        <input type="radio" name="gender" id="femaleinp" value="Female" required>
                        <label for="femaleinp">Female</label>
                    </div>
                    <div class="other-option gender-option">
                        <input type="radio" name="gender" id="otherinp" value="Other" required>
                        <label for="otherinp">Other</label>
                    </div>
                </div>
                <input type="text" name="profession" id="profession" class="profession" placeholder="Profession" required>
                <input type="email" name="email" id="email" class="email" placeholder="Email" required>
                <input type="password" name="pass" id="pass" class="pass" placeholder="Password" required>
                <input type="password" name="confirm_pass" id="confirm_pass" class="confirm_pass" placeholder="Confirm Password" required>

                <input type="submit" value="Submit" class="submit">
            </form>
            <a href="/todoList/login" class="tologin">Already have an Account? LogIn!</a>
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
            position: relative;
            background: url(../img/signupbg.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container .signup_card {
            backdrop-filter: blur(8px);
            background-color: rgba(221, 211, 253, .3);
            /* height: 80%; */
            width: 68%;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 4rem;
            box-shadow: 0 0 2px 0 #675a9f;
            padding: 2rem;
        }

        .container .signup_card {}

        .container .signup_card img {
            height: 8rem;
        }

        .container .signup_card h2 {
            font-size: 2rem;
            color: white;
            font-weight: 400;
            margin: 0 0 .5rem 0;
        }

        .container .signup_card form {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            padding: 0 4rem;
            gap: 1rem;
        }

        .container .signup_card form textarea {
            grid-column: 1 / 3;
        }

        .container .signup_card form .email {
            grid-column: 1 / 3;
        }

        .container .signup_card form textarea,
        .container .signup_card form select,
        .container .signup_card form .gender-option,
        .container .signup_card form input {
            background: transparent;
            padding: .3rem 1rem;
            border-radius: .5rem;
            outline: none;
            border: 2px solid #c4bada;
            color: var(--third-color);
            font-size: .9rem;
        }

        .container .signup_card form .gender-options {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 1rem;
        }

        .container .signup_card form .gender-options .gender-option {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: .2rem;
        }

        select {
            -webkit-appearance: none;
            /* Safari and Chrome */
            -moz-appearance: none;
            /* Firefox */
            appearance: none;
        }

        .submit {
            width: fit-content;
            border: 1px solid var(--sec-color) !important;
            transition: .3s ease;
            cursor: pointer;
            display: flex;
            justify-self: center;
            grid-column: 1/ 3;
        }

        .submit:hover {
            background: linear-gradient(90deg, var(--first-color), var(--sec-color)) !important;
            color: #fff !important;
        }

        .tologin {
            width: 80%;
            border-top: 1px solid #c2bbda;
            margin: 2rem 0 0 0;
            padding: 1rem 0 0 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            color: #675a9f;
        }
    </style>
</body>


</html>