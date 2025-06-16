<?php
session_start();
include("database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Fitna</title>
    <link rel="stylesheet" href="assets/styles/index.css">
</head>

<body>
    <div class="content">
        <h1>Welcome</h1>
        <h2>Create account to continue your fitness journey now</h2>

        <?php
        if (isset($_SESSION["error"])) {
            echo $_SESSION["error"];
            unset($_SESSION["error"]);
        }

        if (isset($_SESSION["success"])) {
            echo $_SESSION["success"];
            unset($_SESSION["success"]);
        }
        ?>

        <form action="createAccount.php" method="POST">
            <div class="info">
                <label class="label" for="email">Email Address:</label> <br>
                <input type="email" id="email" name="email">
            </div>
            <div class="info">
                <label class="label" for="username">Username:</label> <br>
                <input type="text" id="username" name="username">
            </div>
            <div class="info">
                <label class="label" for="password">Password:</label> <br>
                <input type="password" id="password2" name="password">
            </div>
            <div class="info">
                <label class="label" for="confirmP">Confirm Password:</label> <br>
                <input type="password" id="confirmP" name="confirmP">
            </div>
            <input type="submit" class="button" id="signupButton" value="Create Account">
        </form>
        <p>Already have an account? <a href="index.html">Log in</a></p>
    </div>
    <img src="assets/images/Fitna.png" alt="">
    <script>
        document.getElementById("signupButton").addEventListener("click", function(e) {

            const email = document.querySelector('#email').value.trim();
            const username = document.querySelector('#username').value.trim();
            const password = document.querySelector('#password2').value.trim();
            const confirmPassword = document.querySelector('#confirmP').value.trim();

            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

            if (email === "" || password === "" || confirmPassword === "") {
                e.preventDefault();
                alert("Please complete filling up informations needed");
                return;
            }

            if (!passwordPattern.test(password)) {
                e.preventDefault();
                alert("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.");
                return;
            }

            if (password !== confirmPassword) {
                e.preventDefault();
                alert("Passwords do not match.");
                return;
            }
        });
    </script>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST["password"];
    $confirmP = $_POST["confirmP"];

    $check = $conn->prepare("SELECT * FROM users WHERE emailAddress = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["error"] = '<div class="error-message">Email or username already exists. Try again.</div>';
        header("Location: createAccount.php");
        exit;
    }

    $hashedP = password_hash($password, PASSWORD_DEFAULT);

    $sql = $conn->prepare("INSERT INTO users (emailAddress, username, password) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $email, $username, $hashedP);

    if ($sql->execute()) {
        $_SESSION["success"] = '<div class="success-message">Account created successfully! <a href="index.html">Login here</a></div>';
        header("Location: createAccount.php");
    } else {
        $_SESSION["error"] = "Something went wrong: " . $sql->error;
        header("Location: createAccount.php");
    }

    $check->close();
    $sql->close();
}

mysqli_close($conn);
?>