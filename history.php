<?php
session_start();
include("database.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$pageId = 'history';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/history-style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <title>Fitna - History</title>
</head>

<body>
    <div class="nav">
        <ul>
            <li>
                <a href="home.php" class="<?= ($pageId == 'home') ? 'active' : '' ?>">
                    <div>
                        <img src="assets/images/home-icon.webp" alt="">
                        <p>Home</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="workouts.php" class="<?= ($pageId == 'workouts') ? 'active' : '' ?>">
                    <div>
                        <img src="assets/images/workouts-icon.webp" alt="">
                        <p>Workouts</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="plans.php" class="<?= ($pageId == 'plans') ? 'active' : '' ?>" >
                    <div>
                        <img src="assets/images/plans-icon.webp" alt="">
                        <p>Plans</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="history.php" class="<?= ($pageId == 'history') ? 'active' : '' ?>" >
                    <div>
                        <img src="assets/images/history-icon.webp" alt="">
                        <p>History</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="progress.php" class="<?= ($pageId == 'progress') ? 'active' : '' ?>">
                    <div>
                        <img src="assets/images/progress-icon.webp" alt="">
                        <p>Progress</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="profile.php" class="<?= ($pageId == 'profile') ? 'active' : '' ?>">
                    <div>
                        <img src="assets/images/profile-icon.svg" alt="">
                        <p>Profile</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <main id="history">
        <div class="container1">
            <div class="calendar">
                <div class="header">
                    <button id="prevBtn">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <div class="monthYear" id="monthYear"></div>
                    <button id="nextBtn">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <div class="days">
                    <div class="day">Mon</div>
                    <div class="day">Tue</div>
                    <div class="day">Wed</div>
                    <div class="day">Thu</div>
                    <div class="day">Fri</div>
                    <div class="day">Sat</div>
                    <div class="day">Sun</div>
                </div>
                <div class="dates" id="dates"></div>
            </div>
            <div class="verticalLine"></div>
            <div class="history">
                <h1>History</h1>
                <div class="completedWOs" id="completedWOs">
                    <div class="completedWO">
                    </div>
                </div>
            </div>
        </div>
        <div class="container2">
            <div class="box">
                <div class="data"></div>
                <p>Total Number of Days Active</p>
            </div>
            <div class="box">
                <div class="data"></div>
                <p>Total Number of Completed Workouts</p>
            </div>
            <div class="box">
                <div class="data"></div>
                <p>Total Number of Completed Reps</p>
            </div>
            <div class="box">
                <div class="data"></div>
                <p>Total Number of Duration of Completed Workouts</p>
            </div>
        </div>
    </main>

    <script src="assets/js/history.js"></script>
</body>

</html>

<?php
mysqli_close($conn);
?>