<?php

include 'database.php';

// Get unique dates where user logged weight
$weight_dates = [];
$result = $conn->query("SELECT DISTINCT log_date FROM weight");
while ($row = $result->fetch_assoc()) {
    $weight_dates[] = $row['log_date'];
}

// Get unique dates where user logged measurements
$measurement_dates = [];
$result = $conn->query("SELECT DISTINCT log_date FROM measurements");
while ($row = $result->fetch_assoc()) {
    $measurement_dates[] = $row['log_date'];
}

// Merge and remove duplicates
$all_dates = array_unique(array_merge($weight_dates, $measurement_dates));

// Convert to DateTime objects and sort descending
$date_objs = array_map(function($d) { return new DateTime($d); }, $all_dates);
usort($date_objs, function($a, $b) { return $b <=> $a; });

// Calculate streak
$streak = 0;
$expected_date = new DateTime(date('Y-m-d'));

foreach ($date_objs as $workout_date) {
    if ($workout_date->format('Y-m-d') == $expected_date->format('Y-m-d')) {
        $streak++;
        $expected_date->modify('-1 day');
    } else if ($workout_date->format('Y-m-d') == $expected_date->modify('-1 day')->format('Y-m-d')) {
        $streak++;
        $expected_date->modify('-1 day');
    } else {
        break;
    }
}

echo json_encode(["streak" => $streak]);

$conn->close();
?>