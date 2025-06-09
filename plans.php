<?php
$pageTitle = "Plans";
$pageId = "plans";
include 'includes/header.php';
?>

<div id="plans">
    <section class="date-header">
        <h2>Week 15, Day 2</h2>
        <div class="date-plan">Tue, May 20</div>
    </section>

    <section class="tags">
        <span class="focus-tag">FOCUS: CORE</span>
        <span class="goal-tag">GOAL: 5 Excerises</span>
    </section>

    <div class="day-tabs">
        <button class="day-tab" onclick="setActive(this)"><p>Sun</p></button>
        <button class="day-tab" onclick="setActive(this)"><p>Mon</p></button>
        <button class="day-tab active" onclick="setActive(this)"><p>Tue</p></button>
        <button class="day-tab" onclick="setActive(this)"><p>Wed</p></button>
        <button class="day-tab" onclick="setActive(this)"><p>Thu</p></button>
        <button class="day-tab" onclick="setActive(this)"><p>Fri</p></button>
        <button class="day-tab" onclick="setActive(this)"><p>Sat</p></button>
    </div>

    <section id="workout-plan">
        <div class="head">
            <h3>Today's Plan</h3>
            <div class="label">
                <h5>Reps/Duration Completed</h5>
                <h5>Mark as Dpne</h5>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>