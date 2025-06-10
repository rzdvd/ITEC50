<?php
$day = $_GET['day'] ?? 'tue';

$plans = [
    'tue' => ["Pushups", "Situps", "Plank", "Squats", "Burpees"]
    // Add other days as needed
];

$excercises = $plans[$day]['exercises'] ?? [];

foreach ($excercises as $exercise) {
    echo "<div class='exercise-card'>";
    echo "<img src='assets/images/exercise-icon.webp' alt='Exercise Icon'>";
    echo "<div class='info'>";
    echo "<p>$excercise</p><p>## / ##</p>";
    echo "</div><div class='check-icon'>check</div></div>";   
}