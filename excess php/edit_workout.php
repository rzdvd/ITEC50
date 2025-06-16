<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $sets = $_POST['sets'];
    $reps = $_POST['reps'];
    $duration = $_POST['duration'];

    $stmt = $conn->prepare("UPDATE workout_plan SET sets=?, reps=?, duration=? WHERE id=?");
    $stmt->bind_param("sssi", $sets, $reps, $duration, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: plans.php");
    exit();
}
?>