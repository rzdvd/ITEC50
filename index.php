<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Fitna</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="content">
        <h1>Welcome back</h1>
        <h2>Log in to continue your fitness journey now</h2>
        <form action="#">
            <div class="info">
                <label class="label" for="email">Email Address:</label> <br>
                <input type="email" id="email" name="email">
            </div>
            <div class="info">
                <label class="label" for="password">Password:</label> <br>
                <input type="password" id="password1" name="password">
            </div>
            <button type="button" class="button" id="loginButton" name="loginButton">Log In</button>
        </form>
        <p>Don't have an account? <a href="createAccount.html">Sign up</a></p>
    </div>

    <script>

        document.getElementById("loginButton").addEventListener("click", function (e) {
            e.preventDefault(); // Prevent form submission
            
            const email = document.querySelector('#email').value.trim();
            const password = document.querySelector('#password1').value.trim();
            const storedEmail = localStorage.getItem('registeredEmail');
            const storedPassword = localStorage.getItem('registeredPassword');

            if (email === "" || password === "") {
                alert("Please complete filling up informations needed");
                return;
            }

            if (email === storedEmail && password === storedPassword) {
                alert("Login successful!");
                window.location.href = "home.html";
            } else {
                alert("Invalid email or password.");
            }
        });

    </script>
</body>
</html>
<?php
    mysqli_close($conn);
?>