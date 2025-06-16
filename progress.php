<?php
session_start();
include("database.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

include 'database.php';

// Handle weight logging
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['log_weight'])) {
    $log_date = date("Y-m-d"); // or get from form if you allow
    $weight = $_POST['weight'];

    $stmt = $conn->prepare("INSERT INTO weight (log_date, weight) VALUES (?, ?)");
    $stmt->bind_param("sd", $log_date, $weight);
    $stmt->execute();
    $stmt->close();
}

// Handle measurements update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_measurements'])) {
    $waist = empty($_POST['waist']) ? null : floatval($_POST['waist']);
    $hips = empty($_POST['hips']) ? null : floatval($_POST['hips']);
    $thigh = empty($_POST['thigh']) ? null : floatval($_POST['thigh']);
    $arm = empty($_POST['arm']) ? null : floatval($_POST['arm']);

    $stmt = $conn->prepare("INSERT INTO measurements (log_date, waist, hips, thigh, arm) VALUES (?, ?, ?, ?, ?)");
    $log_date = date("Y-m-d");
    $stmt->bind_param("sdddd", $log_date, $waist, $hips, $thigh, $arm);
    $stmt->execute();
    $stmt->close();
}

// You can fetch the latest measurements for display
$measurements = [
    'waist' => '',
    'chest' => '',
    'hips' => '',
    'thigh' => '',
    'arm' => ''
];

$latest_weight = "";

$result = $conn->query("SELECT weight FROM weight ORDER BY log_date DESC LIMIT 1");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $latest_weight = $row['weight'];
}

$result = $conn->query("SELECT * FROM measurements ORDER BY id DESC LIMIT 1");
if ($result && $result->num_rows > 0) {
    $measurements = $result->fetch_assoc();
}

$pageTitle = "Plans";
$pageId = "plans";
include 'includes/header.php';
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

<main id="progress">
    <div class="chartContainer">
        <div class="chart-header">
            <h2>My Weight</h2>
            <button id="logWeightBtn">Log</button>
        </div>
        <canvas id="progress-chart" ></canvas>
    </div>

    <div id="logWeightModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Log Weight</h2>
            <form method="POST">
                <input type="number" name="weight" placeholder="Enter weight (kg)" step="0.01" required>
                <button type="submit" name="log_weight">Save</button>
            </form>
        </div>
    </div>
    
    <form id="measurements-form" method ="POST">
        <div class="measurements">
            <div class="head">
                <h2>MEASUREMENTS</h2>
                <div class="log">
                    <button type="submit" name="save_measurements">Save Measurements</button>
                </div>
            </div>

            <div class="measurements-data">
                <?php 
                    $exclude = ['id', 'user_id', 'log_date']; 
                    foreach ($measurements as $part => $value): 
                    if (in_array($part, $exclude)) continue; 
                ?>
                    <div class="body-part">
                        <h4><?= ucfirst($part) ?></h4>
                        <input type="number" value="<?= $measurements[$part] ?>" step="0.01" name="<?= $part ?>" value="<?= $value ?>">
                    </div>
                    <hr>
                <?php endforeach; ?>
            </div>
            
           
        </div>
        <div class="streak">
           <p><span id="streakCount">0</span> Streak Days</p>
        </div>
    </section>
    
</main>

<?php include 'includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('progress_data.php')
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('progress-chart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Weight (kg)',
                    data: data.weights,
                    borderColor: '#fff',
                    backgroundColor: '#843d49',
                    fill: false,
                    pointRadius: 5,
                    tension: 0.3,
                    spanGaps: true  // allows gaps for nulls
                }]
            },
            options: {
                layout: {
                    padding: {
                        top: 30,
                        bottom: 20
                    }

                },
                plugins: {
                    legend: { display: false }
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: { color: '#fff', font: { size: 14 } },
                        grid: { color: '#f8f8f8' },
                        title: { display: true, text: 'Date', color: '#fff' }
                    },
                    y: {
                        min: data.minWeight,
                        max: data.maxWeight,
                        ticks: { stepSize: 0.1, color: '#fff', font: { size: 14 } },
                        grid: { color: '#f8f8f8' },
                        title: { display: true, text: 'Weight (kg)', color: '#fff' }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Error fetching progress data:', error);
    });
});

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById("logWeightModal");
    const btn = document.getElementById("logWeightBtn");
    const span = document.querySelector(".close");

    btn.onclick = function () {
        modal.style.display = "flex";
    }

    span.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
    fetch('streak.php')
    .then(response => response.json())
    .then(data => {
        document.getElementById("streakCount").innerText = data.streak;
    })
    .catch(error => console.error('Error fetching streak:', error));
});
</script>
