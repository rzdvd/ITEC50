<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $plan_id = $_POST['plan_id'];
    $workout_day = $_POST['workout_day'];
    $exercise_name = $_POST['exercise_name'];
    $sets = $_POST['sets'];
    $reps = $_POST['reps'];

    $stmt = $conn->prepare("INSERT INTO exercises (plan_id, workout_day, exercise_name, sets, reps) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $plan_id, $workout_day, $exercise_name, $sets, $reps);
    if ($stmt->execute()) {
        echo "New exercise added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    
    header("Location: plans.php");
    
}
?>