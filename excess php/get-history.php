<?php
session_start();
include("database.php");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$userid = $_SESSION['user_id'];

if (!isset($_GET['date'])) {
    echo json_encode(['error' => 'No date provided']);
    exit;
}

$date = $_GET['date'];

$sql = $conn->prepare("
                    SELECT exercise_name, reps, sets, duration_seconds 
                    FROM user_history
                    WHERE user_id = ? AND completed_at = ?");

$sql->bind_param("is", $userid, $date);
$sql->execute();
$result = $sql->get_result();

$history = [];

while ($row = $result->fetch_assoc()) {
    $history[] = $row;
}

echo json_encode($history);
mysqli_close($conn);
exit;

?>
