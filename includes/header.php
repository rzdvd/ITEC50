<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Fitness Website</title>
</head>
<body id="<?php echo $pageId ?? ''; ?>">

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