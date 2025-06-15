<?php
include 'database.php';

$currentDay = $_GET['day'] ?? date('D');

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
    $duration = $_POST['duration'];

    $stmt = $conn->prepare("INSERT INTO workout_plan (plan_id, workout_day, exercise_name, sets, reps) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $plan_id, $workout_day, $workout, $sets, $reps);
    $stmt->execute();
    $stmt->close();

    header("Location: plans.php?day=".$workout_day);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_completed_id'])) {
    $id = intval($_POST['toggle_completed_id']);
    $currentStatus = intval($_POST['current_completed_status']);
    $newStatus = $currentStatus ? 0 : 1;

    $stmt = $conn->prepare("UPDATE workout_plan SET completed = ? WHERE id = ?");
    $stmt->bind_param("ii", $newStatus, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: plans.php?day=".$currentDay);
    exit();
}




$sql = "SELECT id, name, focus, sets, reps FROM workouts";
$result = $conn->query($sql);
$workouts_add = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $workouts_add[] = $row;
    }
}

$stmt = $conn->prepare("
    SELECT wp.*, w.focus 
    FROM workout_plan wp 
    JOIN workouts w ON wp.exercise_name = w.name 
    WHERE wp.workout_day = ?
");
$stmt->bind_param("s", $currentDay);
$stmt->execute();
$result = $stmt->get_result();
$workouts = [];
while ($row = $result->fetch_assoc()) {
    $workouts[] = $row;
}

// Calculate current week number and day name
$today = new DateTime();
$weekNumber = $today->format('W');
$dayName = $today->format('D');
$fullDayName = $today->format('l');
$monthName = $today->format('F');
$dayOfMonth = $today->format('j');

// If a day is selected, use that day for display
$validDays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
if (isset($_GET['day']) && in_array($_GET['day'], $validDays)) {
    $dayName = $_GET['day'];
    // Find the next occurrence of the selected day (including today if it matches)
    $today = new DateTime();
    if ($today->format('D') !== $dayName) {
        $today->modify('next ' . $dayName);
    }
    $monthName = $today->format('F');
    $dayOfMonth = $today->format('j');
    $fullDayName = $today->format('l');
}

$pageTitle = "Plans";
$pageId = "plans";
include 'includes/header.php';
?>

<div id="plans">
    <section class="date-header">
        <h2>Week <?= $weekNumber ?></h2>
        <div class="date-plan"><?= $dayName ?>, <?= $monthName ?> <?= $dayOfMonth ?></div>
    </section>

    <div class="day-tabs">
        <button class="day-tab<?= $currentDay == 'Sun' ? ' selected' : '' ?>" onclick="changeDay('Sun')"><p>Sun</p></button>
        <button class="day-tab<?= $currentDay == 'Mon' ? ' selected' : '' ?>" onclick="changeDay('Mon')"><p>Mon</p></button>
        <button class="day-tab<?= $currentDay == 'Tue' ? ' selected' : '' ?>" onclick="changeDay('Tue')"><p>Tue</p></button>
        <button class="day-tab<?= $currentDay == 'Wed' ? ' selected' : '' ?>" onclick="changeDay('Wed')"><p>Wed</p></button>
        <button class="day-tab<?= $currentDay == 'Thu' ? ' selected' : '' ?>" onclick="changeDay('Thu')"><p>Thu</p></button>
        <button class="day-tab<?= $currentDay == 'Fri' ? ' selected' : '' ?>" onclick="changeDay('Fri')"><p>Fri</p></button>
        <button class="day-tab<?= $currentDay == 'Sat' ? ' selected' : '' ?>" onclick="changeDay('Sat')"><p>Sat</p></button>
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
                <div class="workout" 
                    data-id="<?= $workout['id'] ?>"
                    data-name="<?= $workout['exercise_name'] ?>"
                    data-sets="<?= $workout['sets'] ?>"
                    data-reps="<?= $workout['reps'] ?>"
                    data-duration="<?= $workout['duration'] ?>"
                >
                    <div class="name">
                        <img src="assets/images/<?= $workout['focus'] ?>-icon.png" alt="<?= $workout['exercise_name'] ?>">
                        <div class="with-edit">
                            <p><?= ucfirst($workout['exercise_name']) ?></p>

                            <img 
                                src="assets/images/edit-icon.webp" 
                                alt="Edit" 
                                class="edit-button" 
                                data-id="<?= $workout['id'] ?>"
                                data-sets="<?= $workout['sets'] ?>"
                                data-reps="<?= $workout['reps'] ?>"
                                data-duration="<?= $workout['duration'] ?>"
                                style="height: 20px; margin-left: 10px; cursor: pointer; filter: invert(100%);"
                            >
                        </div>
                    </div>
                    <div class="data">
                        <div class="sets"><?= $workout['sets'] ?></div>
                        <div class="reps"><?= $workout['reps'] ?></div>
                        <div class="duration"><?= $workout['duration'] ?></div>
                        <div class="done">
                            <form method="POST" action="plans.php">
                                <input type="hidden" name="toggle_completed_id" value="<?= $workout['id'] ?>">
                                <input type="hidden" name="current_completed_status" value="<?= $workout['completed'] ?>">
                                <button type="submit" class="completed-button" style="background:none; border:none;">
                                    <?php if ($workout['completed']): ?>
                                        <img src="assets/images/check-icon.svg" alt="Completed" style="height: 40px;">
                                    <?php else: ?>
                                        <img src="assets/images/check-icon.svg" alt="Not Completed" style="height: 40px; opacity: 0.3;">
                                    <?php endif; ?>
                                </button>
                            </form>
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
                <img src="assets/images/add-icon.webp" style="height: 50px; filter: invert(100%);" alt="Add Workout">
                <p>Add Workout</p>
            </div>
        </div>
    </section>

    <div id="workoutModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Workout</h2>
            <form id="addWorkoutForm" method="POST" action="plans.php?day=<?= $currentDay ?>">
                <input type="hidden" name="plan_id" value="1">
                <input type="hidden" name="workout_day" value="<?= $currentDay ?>">
                <select name="workout" id="workoutSelect" required>
                    <option value="">Select a workout</option>
                    <?php foreach ($workouts_add as $workout): ?>
                        <option value="<?= $workout['name'] ?>"><?= ucfirst($workout['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="sets">
                    <label for="sets">Sets:</label>
                    <input type="text" id="sets" name="sets" min="1" max="10" required>
                </div>
                <div class="reps">
                    <label for="reps">Reps/Duration:</label>
                    <input type="text" id="reps" name="reps" min="1" max="1000" > 
                </div>
                <div class="duration">
                    <label for="duration">Duration (min):</label>
                    <input type="text" id="duration" name="duration" min="1" max="120" >
                </div>
                <button type="submit">Add Workout</button>
            </form>
        </div>
    </div>
</div>

<div id="editWorkoutModal" class="modal">
  <div class="modal-content">
    <span class="close-edit">&times;</span>
    <h2>Edit Workout</h2>
    <form id="editWorkoutForm" method="POST" action="edit_workout.php">
      <input type="hidden" name="id" id="edit-id">

      <div class="sets">
        <label for="edit-sets">Sets:</label>
        <input type="number" id="edit-sets" name="sets" min="1" max="10" required>
      </div>

      <div class="reps">
        <label for="edit-reps">Reps:</label>
        <input type="text" id="edit-reps" name="reps" required>
      </div>

      <div class="duration">
        <label for="edit-duration">Duration (min):</label>
        <input type="text" id="edit-duration" name="duration">
      </div>

      <button type="submit">Save Changes</button>
    </form>
  </div>
</div>

<script>
    const workoutsData = <?php echo json_encode($workouts_add); ?>;

    window.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const workoutFromParam = urlParams.get('workout');

    if (workoutFromParam) {
        const dropdown = document.getElementById('workoutSelect');
        
        for (let option of dropdown.options) {
            if (option.value.toLowerCase() === workoutFromParam.toLowerCase()) {
                option.selected = true;
                break;
            }
        }

        document.getElementById('workoutModal').style.display = 'flex';
    }
});
</script>

<?php include 'includes/footer.php'; ?>