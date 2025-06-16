<?php
session_start();
include("database.php");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = $conn->prepare("
    SELECT 
        COUNT(DISTINCT completed_at) AS days_active,
        COUNT(*) AS completed_workouts,
        SUM(sets * reps) AS total_reps,
        SUM(duration_seconds) AS total_duration
    FROM user_history
    WHERE user_id = ?
");

$sql->bind_param("i", $user_id);
$sql->execute();
$result = $sql->get_result();
$stats = $result->fetch_assoc();

echo json_encode($stats);
?>