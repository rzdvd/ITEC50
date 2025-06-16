<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}
$user_id = $_SESSION['user_id'];


// Prepare 7-day window (today - 3 days, today + 3 days)
$startDate = date("Y-m-d", strtotime("-3 days"));
$endDate = date("Y-m-d", strtotime("+3 days"));

// Fetch weight data within this window
$stmt = $conn->prepare("SELECT log_date, weight FROM weight WHERE user_id = ? AND log_date BETWEEN ? AND ?");
$stmt->bind_param("iss", $user_id, $startDate, $endDate);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[$row['log_date']] = (float)$row['weight'];
}

// Build full 7-day date array
$labels = [];
$weights = [];
$minWeight = PHP_FLOAT_MAX;
$maxWeight = PHP_FLOAT_MIN;

for ($i = -3; $i <= 3; $i++) {
    $date = date("Y-m-d", strtotime("$i days"));
    $labels[] = $date;

    if (isset($data[$date])) {
        $weights[] = $data[$date];
        if ($data[$date] < $minWeight) $minWeight = $data[$date];
        if ($data[$date] > $maxWeight) $maxWeight = $data[$date];
    } else {
        $weights[] = null;  // blank spot
    }
}

// Prevent chart crash if no data
if ($minWeight === PHP_FLOAT_MAX) {
    $minWeight = 0;
    $maxWeight = 10;
} else {
    $minWeight -= 1;
    $maxWeight += 1;
}

echo json_encode([
    'labels' => $labels,
    'weights' => $weights,
    'minWeight' => $minWeight,
    'maxWeight' => $maxWeight
]);
?>
