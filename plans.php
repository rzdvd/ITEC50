<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {

    $deleteId = intval($_POST['delete_id']);

    $stmt = $conn->prepare("DELETE FROM workout_plan WHERE id = ?");
    $stmt->bind_param("i", $deleteId);
    $stmt->execute();
    $stmt->close();

    header("Location: plans.php?day=".$currentDay);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['workout'])) {
    $plan_id = $_POST['plan_id'] ?? 1; // Default to plan_id 1 if not set
    $workout_day = $_POST['workout_day'] ?? date('D'); // Default to current day if not set
    $workout = $_POST['workout'];
    $sets = $_POST['sets'];
    $reps = $_POST['reps'];

    $stmt = $conn->prepare("INSERT INTO workout_plan (plan_id, workout_day, exercise_name, sets, reps) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $plan_id, $workout_day, $workout, $sets, $reps);
    $stmt->execute();
    $stmt->close();

    header("Location: plans.php?day=".$workout_day);
    exit();
}

$currentDay = $_GET['day'] ?? date('D');

$sql = "SELECT id, name, focus, sets, reps FROM workouts";
$result = $conn->query($sql);
$workouts_add = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $workouts_add[] = $row;
    }
}

$stmt = $conn->prepare("SELECT * FROM workout_plan WHERE workout_day = ?");
$stmt->bind_param("s", $currentDay);
$stmt->execute();
$result = $stmt->get_result();
$workouts = [];
while ($row = $result->fetch_assoc()) {
    $workouts[] = $row;
}

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
        <button class="day-tab" onclick="changeDay('Sun')"><p>Sun</p></button>
        <button class="day-tab" onclick="changeDay('Mon')"><p>Mon</p></button>
        <button class="day-tab" onclick="changeDay('Tue')"><p>Tue</p></button>
        <button class="day-tab" onclick="changeDay('Wed')"><p>Wed</p></button>
        <button class="day-tab" onclick="changeDay('Thu')"><p>Thu</p></button>
        <button class="day-tab" onclick="changeDay('Fri')"><p>Fri</p></button>
        <button class="day-tab" onclick="changeDay('Sun')"><p>Sat</p></button>
    </div>

    <section id="workout-plan" >
        <div class="head">
            <h3>Today's Plan</h3>
            <div class="label">
                <h5>Sets</h5>
                <h5>Reps</h5>
                <h5>Duration</h5>
                <h5>Mark as Completed</h5>
            </div>
        </div>
        <div class="workouts-plan">
            <?php foreach ($workouts as $workout): ?>
                <div class="workout">
                    <div class="name">
                        <img src="assets/images/<?= $workout['exercise_name'] ?>.svg" alt="<?= $workout['exercise_name'] ?>">
                        <p><?= ucfirst($workout['exercise_name']) ?></p>
                    </div>
                    <div class="data">
                        <div class="sets"><?= $workout['sets'] ?></div>
                        <div class="reps"><?= $workout['reps'] ?></div>
                        <div class="done">
                            <input type="checkbox" id="done-<?= $workout['id'] ?>" name="done-<?= $workout['id'] ?>">
                        </div>
                        <div class="delete">
                            <form method="POST" action="plans.php" onsubmit="return confirm('Are you sure you want to delete this workout?');">
                                <input type="hidden" name="delete_id" value="<?= $workout['id'] ?>">
                                <button type="submit" class="delete-button">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="add">
                <img src="assets/images/add-icon.svg" alt="Add Workout">
                <p>Add Workout</p>
            </div>
        </div>
    </section>

    <div id="workoutModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Workout</h2>
            <form id="addWorkoutForm" method="POST" action="plans.php?day=<?= $currentDay ?>">
                <input type="hidden" name="plan_id" value="<?= $plan_id ?>">
                <input type="hidden" name="workout_day" value="<?= $currentDay ?>">
                <select name="workout" id="workoutSelect" required>
                    <option value="">Select a workout</option>
                    <?php foreach ($workouts_add as $workout): ?>
                        <option value="<?= $workout['name'] ?>"><?= ucfirst($workout['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="sets">
                    <label for="sets">Sets:</label>
                    <input type="number" id="sets" name="sets" min="1" max="10" required>
                </div>
                <div class="reps">
                    <label for="reps">Reps/Duration:</label>
                    <input type="text" id="reps" name="reps" min="1" max="1000" required> 
                </div>
                <div class="duration">
                    <label for="duration">Duration (min):</label>
                    <input type="text" id="duration" name="duration" min="1" max="120" required>
                </div>
                <button type="submit">Add Workout</button>
            </form>
        </div>
    </div>
</div>

<script>
    const workoutsData = <?php echo json_encode($workouts_add); ?>;
</script>

<?php include 'includes/footer.php'; ?>