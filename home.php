<?php
session_start();
include("database.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$today = date('Y-m-d');

$sql = $conn->prepare("SELECT * FROM workout_plan WHERE user_id = ? AND planned_date = ?");
$sql->bind_param("is", $user_id, $today);
$sql->execute();
$result = $sql->get_result();

$quotes = [
    "“It’s supposed to be hard. If it wasn’t hard, everyone would do it.  The hard is what makes it great.”",
    "“You have to push past your perceived limits, push past that point you thought was as far as you can go.” ",
    "“If you want something you’ve never had, you must be willing to do something you’ve never done.”",
    "“Workout till you feel that pain and soreness in muscles. This one is good pain. No pain, no gain.”",
    "“Just believe in yourself. Even if you don’t, just pretend that you do and at some point, you will.”",
    "“I hated every minute of training, but I said, ‘Don’t quit. Suffer now and live the rest of your life as a champion.”",
    "“Most people fail, not because of lack of desire, but, because of lack of commitment.”"
];

$randomQuote = $quotes[array_rand($quotes)];

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/home-style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <title>Fitna - Home</title>
</head>

<body>
    <div class="nav">
        <ul>
            <li>
                <a href="">
                    <div>
                        <img src="" alt="">
                        <p></p>
                    </div>
                </a>
            </li>
            <li>
                <a href="home.php">
                    <div>
                        <img src="assets/images/home-icon.webp" alt="">
                        <p>Home</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="workouts.php">
                    <div>
                        <img src="assets/images/workouts-icon.webp" alt="">
                        <p>Workouts</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="plans.php">
                    <div>
                        <img src="assets/images/plans-icon.webp" alt="">
                        <p>Plans</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="history.php">
                    <div>
                        <img src="assets/images/history-icon.webp" alt="">
                        <p>History</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="progress.php">
                    <div>
                        <img src="assets/images/progress-icon.webp" alt="">
                        <p>Progress</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="profile.html">
                    <div>
                        <img src="assets/images/profile-icon.svg" alt="">
                        <p>Profile</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <div class="content">
        <div class="upperPart">
            <div class="leftSide">
                <img id="fitna" src="assets/images/Fitna.png" alt="">
                <p>Built by Effort. Backed by Progress</p>
            </div>
            <div class="rightSide">
                <div class="todaysPlan">
                    <h1>Today's Plan</h1>
                    <div class="plannedWOs">
                        <div class="plannedWO">
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <p>
                                        <strong><?= htmlspecialchars($row['exercise_name']) ?></strong>
                                    </p>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p>You have no workout plans for today.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="middlePart">
            <div class="quotes-holder">
                <h1>Motivational Quotes:</h1>
                <div class="quotes">
                    <p><?php echo $randomQuote; ?></p>
                </div>
            </div>
        </div>
        <div class="bottomPart">
            <div class="scrollableMenu">
                <h2>Explore</h2>
                <div class="bodyPartImages">
                    <a href="workouts.php?bodypart=back" class="bodyPartLink">
                        <div class="bodyPartImage" id="bpi1">
                            <p>Back <br> Workouts</p>
                            <button id="redirectBtn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </a>
                    <a href="workouts.php?bodypart=chest" class="bodyPartLink">
                        <div class="bodyPartImage" id="bpi2">
                            <p>Chest <br> Workouts</p>
                            <button id="redirectBtn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </a>
                    <a href="workouts.php?bodypart=core" class="bodyPartLink">
                        <div class="bodyPartImage" id="bpi3">
                            <p>Core <br> Workouts</p>
                            <button id="redirectBtn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </a>
                    <a href="workouts.php?bodypart=arms" class="bodyPartLink">
                        <div class="bodyPartImage" id="bpi4">
                            <p>Arms <br> Workouts</p>
                            <button id="redirectBtn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </a>
                    <a href="workouts.php?bodypart=legs" class="bodyPartLink">
                        <div class="bodyPartImage" id="bpi5">
                            <p>Legs <br> Workouts</p>
                            <button id="redirectBtn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </a>
                    <a href="workouts.php?bodypart=glutes" class="bodyPartLink">
                        <div class="bodyPartImage" id="bpi6">
                            <p>Glutes <br> Workouts</p>
                            <button id="redirectBtn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
mysqli_close($conn);
?>