<?php

$data = [
    'labels' => ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
    'weights' => [50.0, 50.0, 50.0 ]
];

header('Content-Type: application/json');
echo json_encode($data);
?>