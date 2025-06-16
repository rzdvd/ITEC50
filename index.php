<?php
session_start();
include("database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = $conn->prepare("SELECT * FROM users WHERE emailAddress = ?");
    $sql->bind_param('s', $email);
    $sql->execute();
    $result = $sql->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['emailAddress'];

        header("Location: home.php");
        exit;
    } else {
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: index.php");
        exit;
    }
}

$error = "";
if (isset($_SESSION['login_error'])) {
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']); // Remove it after displaying once
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Fitna</title>
    <link rel="stylesheet" href="assets/styles/index.css">
</head>

<body>
    <div class="content">
        <h1>Welcome back</h1>
        <h2>Log in to continue your fitness journey now</h2>

        <?php if (!empty($error)) { ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php } ?>

        <form action="index.php" method="POST">
            <div class="info">
                <label class="label" for="email">Email Address:</label> <br>
                <input type="email" id="email" name="email">
            </div>
            <div class="info">
                <label class="label" for="password">Password:</label> <br>
                <input type="password" id="password1" name="password">
            </div>
            <input type="submit" class="button" id="loginButton" name="loginButton" value="Log In">
        </form>
        <p>Don't have an account? <a href="createAccount.html">Sign up</a></p>
    </div>
    <img src="assets/images/Fitna.png" alt="">

    <script>
        document.getElementById("loginButton").addEventListener("click", function(e) {

            const email = document.querySelector('#email').value.trim();
            const password = document.querySelector('#password1').value.trim();

            if (email === "" || password === "") {
                alert("Please complete filling up informations needed");
                e.preventDefault();
                return;
            }
        });
    </script>
</body>

</html>
<?php
mysqli_close($conn);
?>