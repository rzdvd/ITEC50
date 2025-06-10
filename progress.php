<?php
$pageTitle = "Plans";
$pageId = "plans";
include 'includes/header.php';
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

<main id="progress">
    <div class="chartContainer">
        <canvas id="progress-chart" ></canvas>
    </div>
    <section class="bottom">
        <div class="measurements">
            <div class="head">
                <h2>MEASUREMENTS</h3>
                <div class="log">
                    <h3>LOG</h3>
                </div>
            </div>
            <div class="body-part">
                <h4>Waist</h4>
                <p>##</p>
            </div>
            <hr>
            <div class="body-part">
                <h4>Chest</h4>
                <p>##</p>
            </div>
            <hr>
            <div class="body-part">
                <h4>Hips</h4>
                <p>##</p>
            </div>
            <hr>
            <div class="body-part">
                <h4>Thigh</h4>
                <p>##</p>
            </div>
            <hr>
            <div class="body-part">
                <h4>Arm</h4>
                <p>##</p>
            </div>
            <hr>
        </div>
    </section>
    
</main>

<?php include 'includes/footer.php'; ?>