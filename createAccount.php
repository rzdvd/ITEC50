<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Fitna</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="content">
        <h1>Welcome</h1>
        <h2>Create account to continue your fitness journey now</h2>
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
    <script>
        document.getElementById("signupButton").addEventListener("click", function (e) {
            e.preventDefault();

            const email = document.querySelector('#email').value.trim();
            const password = document.querySelector('#password2').value.trim();
            const confirmPassword = document.querySelector('#confirmP').value.trim();

            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

            if (email === "" || password === "" || confirmPassword === "") {
                alert("Please complete filling up informations needed");
                return;
            }

            if (!passwordPattern.test(password)) {
                alert("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.");
                return;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return;
            }

            localStorage.setItem('registeredEmail', email);
            localStorage.setItem('registeredPassword', password);

            alert("Account created successfully!");
            window.location.href = "index.html";
        });
    </script>
</body>

</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmP = filter_input(INPUT_POST, "confirmP", FILTER_SANITIZE_SPECIAL_CHARS);

        
    }

    mysqli_close($conn);
?>