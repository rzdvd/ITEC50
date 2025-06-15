<?php
include 'includes/header.php';
?>
    <div class="content">
        <div class="workout-main">
            <h2 class="section-title">TARGET BODY PART</h2>
            <div class="carousel-container">
                <button class="carousel-arrow left" id="prevFocus">
                    <img src="assets/images/arrow_left.svg" alt="Previous">
                </button>
                <div class="carousel-focus">
                    <div class="carousel-img-stack" id="carouselImgStack"></div>
                    <img id="focusImage" class="carousel-main-img" src="assets/images/back.jpg" alt="Back">
                    <div class="focus-label" id="focusLabel">Back</div>
                </div>
                <button class="carousel-arrow right" id="nextFocus">
                    <img src="assets/images/arrow_right.svg" alt="Next">
                </button>
            </div>
            <div class="carousel-dots" id="carouselDots"></div>
            <div class="exercise-list-section">
                <div class="exercise-list-title" id="exerciseListTitle">Back</div>
                <div class="exercise-list" id="exerciseList">
                </div>
            </div>
        </div>
    </div>
    <div id="exerciseModal" class="exercise-modal">
        <div class="exercise-modal-content">
            <div class="exercise-modal-images">
                <img id="modalgif1" src="assets/images/sample-exercise.jpg" alt="Exercise Image">
                <img id="modalgif2" src="assets/images/sample-exercise.jpg" alt="Exercise Image">
            </div>
            <div class="exercise-modal-details">
                <h2 id="modalTitle">Dumbell Row</h2>
                <div class="exercise-modal-info">
                    <div>
                        <strong>Focus</strong>
                        <span id="modalFocus">Back</span>
                    </div>
                    <hr>
                    <div>
                        <strong>Equipment/s</strong>
                        <span id="modalEquip">Dumbell</span>
                    </div>
                    <div>
                        <strong>Reps</strong>
                        <span id="modalReps">##</span>
                    </div>
                    <div>
                        <strong>Duration</strong>
                        <span id="modalDuration">##</span>
                    </div>
                    <div>
                        <strong>Sets</strong>
                        <span id="modalSets">##</span>
                    </div>
                </div>
                <div class="exercise-modal-actions">
                    <button id="addWorkoutBtn" data-exercise="<?= $workout['name'] ?>">add workout</button>
                    <button id="closeModalBtn" class="return-btn">return</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const focuses = [
            {
                name: "Back",
                img: "assets/images/back.jpg",
                exercises: [
                    "Pull Up",
                    "Barbell Deadlift",
                    "Lat Pulldown",
                    "Back Extension",
                    "T-Bar Row"
                ]
            },
            {
                name: "Chest",
                img: "assets/images/chest.jpg",
                exercises: [
                    "Chest Press",
                    "Lying Chest Overhead Extension",
                    "Incline Dumbbell Bench Chest Press",
                    "Push Up",
                    "Standing Cable Chest Press"
                ]
            },
            {
                name: "Core",
                img: "assets/images/core.jpg",
                exercises: [
                    "Sit Up",
                    "Weighted Russian Twist",
                    "Lying Leg Raise",
                    "Plank",
                    "Crunch"
                ]
            },
            {
                name: "Arms",
                img: "assets/images/arms.jpg",
                exercises: [
                    "Bent Over Double Arm Tricep Kickback",
                    "Standing Bicep Cable Curl",
                    "Tricep Cable Rope Pull Down",
                    "Seated Dumbbell Bicep Curl",
                    "Bench Tricep Dip"
                ]
            },
            {
                name: "Legs",
                img: "assets/images/legs.jpg",
                exercises: [
                    "Barbell Overhead Squat",
                    "Leg Press Machine Calf Raise",
                    "Lying Leg Curl",
                    "Jump Rope",
                    "Agility Ladder Drill"
                ]
            },
            {
                name: "Glutes",
                img: "assets/images/glutes.jpg",
                exercises: [
                    "Barbell Kneeling Squat",
                    "Glute Bridge",
                    "Dumbbell Lunges",
                    "Jump Squat",
                    "Resistance Band Glute Kickback"
                ]
            }
        ];
        
        const exerciseDetails = {
            "Pull Up": {
                focus: "Back",
                equipment: "Pull-up Bar",
                reps: "10",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/back1.gif",
                gif2: "assets/GIF/back2.gif"
            },
            "Barbell Deadlift": {
                focus: "Back",
                equipment: "Barbell",
                reps: "8",
                duration: "40s",
                sets: "4",
                gif1: "assets/GIF/back3.gif",
                gif2: "assets/GIF/back4.gif"
            },
            "Lat Pulldown": {
                focus: "Back",
                equipment: "Lat Pulldown Machine",
                reps: "12",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/back5.gif",
                gif2: "assets/GIF/back6.gif"
            },
            "Back Extension": {
                focus: "Back",
                equipment: "Back Extension Bench",
                reps: "15",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/back7.gif",
                gif2: "assets/GIF/back8.gif"
            },
            "T-Bar Row": {
                focus: "Back",
                equipment: "T-Bar",
                reps: "10",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/back9.gif",
                gif2: "assets/GIF/back10.gif"
            },

            "Chest Press": {
                focus: "Chest",
                equipment: "Chest Press Machine",
                reps: "12",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/chest1.gif",
                gif2: "assets/GIF/chest2.gif"
            },
            "Lying Chest Overhead Extension": {
                focus: "Chest",
                equipment: "Dumbbell",
                reps: "10",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/chest3.gif",
                gif2: "assets/GIF/chest4.gif"
            },
            "Incline Dumbbell Bench Chest Press": {
                focus: "Chest",
                equipment: "Dumbbell",
                reps: "10",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/chest5.gif",
                gif2: "assets/GIF/chest6.gif"
            },
            "Push Up": {
                focus: "Chest",
                equipment: "Bodyweight",
                reps: "15",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/chest7.gif",
                gif2: "assets/GIF/chest8.gif"
            },
            "Standing Cable Chest Press": {
                focus: "Chest",
                equipment: "Cable Machine",
                reps: "12",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/chest9.gif",
                gif2: "assets/GIF/chest10.gif"
            },

            "Sit Up": {
                focus: "Core",
                equipment: "Mat",
                reps: "20",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/core1.gif",
                gif2: "assets/GIF/core2.gif"
            },
            "Weighted Russian Twist": {
                focus: "Core",
                equipment: "Medicine Ball",
                reps: "16",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/core3.gif",
                gif2: "assets/GIF/core4.gif"
            },
            "Lying Leg Raise": {
                focus: "Core",
                equipment: "Mat",
                reps: "15",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/core5.gif",
                gif2: "assets/GIF/core6.gif"
            },
            "Plank": {
                focus: "Core",
                equipment: "Mat",
                reps: "-",
                duration: "60s",
                sets: "3",
                gif1: "assets/GIF/core7.gif",
                gif2: "assets/GIF/core8.gif"
            },
            "Crunch": {
                focus: "Core",
                equipment: "Mat",
                reps: "20",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/core9.gif",
                gif2: "assets/GIF/core10.gif"
            },

            "Bent Over Double Arm Tricep Kickback": {
                focus: "Arms",
                equipment: "Dumbbell",
                reps: "12",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/arms1.gif",
                gif2: "assets/GIF/arms2.gif"
            },
            "Standing Bicep Cable Curl": {
                focus: "Arms",
                equipment: "Cable Machine",
                reps: "12",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/arms3.gif",
                gif2: "assets/GIF/arms4.gif"
            },
            "Tricep Cable Rope Pull Down": {
                focus: "Arms",
                equipment: "Cable Machine",
                reps: "12",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/arms5.gif",
                gif2: "assets/GIF/arms6.gif"
            },
            "Seated Dumbbell Bicep Curl": {
                focus: "Arms",
                equipment: "Dumbbell",
                reps: "12",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/arms7.gif",
                gif2: "assets/GIF/arms8.gif"
            },
            "Bench Tricep Dip": {
                focus: "Arms",
                equipment: "Bench",
                reps: "15",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/arms9.gif",
                gif2: "assets/GIF/arms10.gif"
            },

            "Barbell Overhead Squat": {
                focus: "Legs",
                equipment: "Barbell",
                reps: "10",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/legs1.gif",
                gif2: "assets/GIF/legs2.gif"
            },
            "Leg Press Machine Calf Raise": {
                focus: "Legs",
                equipment: "Leg Press Machine",
                reps: "15",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/legs3.gif",
                gif2: "assets/GIF/legs4.gif"
            },
            "Lying Leg Curl": {
                focus: "Legs",
                equipment: "Leg Curl Machine",
                reps: "12",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/legs5.gif",
                gif2: "assets/GIF/legs6.gif"
            },
            "Jump Rope": {
                focus: "Legs",
                equipment: "Jump Rope",
                reps: "-",
                duration: "60s",
                sets: "3",
                gif1: "assets/GIF/legs7.gif",
                gif2: "assets/GIF/legs8.gif"
            },
            "Agility Ladder Drill": {
                focus: "Legs",
                equipment: "Agility Ladder",
                reps: "-",
                duration: "60s",
                sets: "3",
                gif1: "assets/GIF/legs9.gif",
                gif2: "assets/GIF/legs10.gif"
            },

            "Barbell Kneeling Squat": {
                focus: "Glutes",
                equipment: "Barbell",
                reps: "10",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/glutes1.gif",
                gif2: "assets/GIF/glutes2.gif"
            },
            "Glute Bridge": {
                focus: "Glutes",
                equipment: "Mat",
                reps: "15",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/glutes3.gif",
                gif2: "assets/GIF/glutes4.gif"
            },
            "Dumbbell Lunges": {
                focus: "Glutes",
                equipment: "Dumbbell",
                reps: "12",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/glutes5.gif",
                gif2: "assets/GIF/glutes6.gif"
            },
            "Jump Squat": {
                focus: "Glutes",
                equipment: "Bodyweight",
                reps: "15",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/glutes7.gif",
                gif2: "assets/GIF/glutes8.gif"
            },
            "Resistance Band Glute Kickback": {
                focus: "Glutes",
                equipment: "Resistance Band",
                reps: "15",
                duration: "30s",
                sets: "3",
                gif1: "assets/GIF/glutes9.gif",
                gif2: "assets/GIF/glutes10.gif"
            }
        };

        let currentFocus = 0;

        const bodypartMap = {
            back: 0,
            chest: 1,
            core: 2,
            arms: 3,
            legs: 4,
            glutes: 5
        };
        
        const urlParams = new URLSearchParams(window.location.search);
        const bodypart = urlParams.get('bodypart');
        if (bodypart && bodypartMap.hasOwnProperty(bodypart.toLowerCase())) {
            currentFocus = bodypartMap[bodypart.toLowerCase()];
        }

        function updateFocus() {
            const focus = focuses[currentFocus];
            document.getElementById('focusImage').src = focus.img;
            document.getElementById('focusImage').alt = focus.name;
            document.getElementById('focusLabel').textContent = focus.name;
            document.getElementById('exerciseListTitle').textContent = focus.name;
            // Populate exercises
            const list = document.getElementById('exerciseList');
            list.innerHTML = '';
            focus.exercises.forEach(ex => {
                const row = document.createElement('div');
                row.className = 'exercise-row';
                row.innerHTML = `
                    <span class="exercise-name">${ex}</span>
                    <button class="view-btn">view</button>
                `;
                list.appendChild(row);
            });
            // Update dots
            const dots = document.getElementById('carouselDots');
            dots.innerHTML = '';
            for (let i = 0; i < focuses.length; i++) {
                const dot = document.createElement('span');
                dot.className = 'dot' + (i === currentFocus ? ' active' : '');
                dot.onclick = () => { currentFocus = i; updateFocus(); };
                dots.appendChild(dot);
            }
            // Update carousel background images
            const stack = document.getElementById('carouselImgStack');
            stack.innerHTML = '';
            // Show up to 2 left and 2 right images
            const left2 = focuses[(currentFocus - 2 + focuses.length) % focuses.length];
            const left1 = focuses[(currentFocus - 1 + focuses.length) % focuses.length];
            const right1 = focuses[(currentFocus + 1) % focuses.length];
            const right2 = focuses[(currentFocus + 2) % focuses.length];

            let imgFarLeft = document.createElement('img');
            imgFarLeft.src = left2.img;
            imgFarLeft.alt = left2.name;
            imgFarLeft.className = 'far-left';
            stack.appendChild(imgFarLeft);

            let imgLeft = document.createElement('img');
            imgLeft.src = left1.img;
            imgLeft.alt = left1.name;
            imgLeft.className = 'left';
            stack.appendChild(imgLeft);

            let imgRight = document.createElement('img');
            imgRight.src = right1.img;
            imgRight.alt = right1.name;
            imgRight.className = 'right';
            stack.appendChild(imgRight);

            let imgFarRight = document.createElement('img');
            imgFarRight.src = right2.img;
            imgFarRight.alt = right2.name;
            imgFarRight.className = 'far-right';
            stack.appendChild(imgFarRight);

            // Attach view listeners after rendering
            attachViewListeners();
        }

        document.getElementById('prevFocus').onclick = function() {
            currentFocus = (currentFocus - 1 + focuses.length) % focuses.length;
            updateFocus();
        };
        document.getElementById('nextFocus').onclick = function() {
            currentFocus = (currentFocus + 1) % focuses.length;
            updateFocus();
        };

        // Modal logic
        function attachViewListeners() {
            document.querySelectorAll('.view-btn').forEach((btn) => {
                btn.onclick = function() {
                    // Get exercise name from the row
                    const exName = btn.parentElement.querySelector('.exercise-name').textContent;
                    const ex = exerciseDetails[exName] || {
                        focus: "Unknown", equipment: "Unknown", reps: "##", duration: "##", sets: "##",
                        gif1: "assets/images/sample-exercise.jpg", gif2: "assets/images/sample-exercise.jpg"
                    };
                    document.getElementById('modalTitle').textContent = exName;
                    document.getElementById('modalFocus').textContent = ex.focus;
                    document.getElementById('modalEquip').textContent = ex.equipment;
                    document.getElementById('modalReps').textContent = ex.reps;
                    document.getElementById('modalDuration').textContent = ex.duration;
                    document.getElementById('modalSets').textContent = ex.sets;
                    document.getElementById('modalgif1').src = ex.gif1;
                    document.getElementById('modalgif2').src = ex.gif2;
                    document.getElementById('exerciseModal').style.display = 'flex';
                };
            });
        }

        document.getElementById('closeModalBtn').onclick = function() {
            document.getElementById('exerciseModal').style.display = 'none';
        };
        document.getElementById('exerciseModal').onclick = function(e) {
            if (e.target === this) this.style.display = 'none';
        };
        
        updateFocus();

    function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
  }

  // Example workout data by body part
    const workoutData = {
    chest: ["Push-ups", "Bench Press", "Chest Fly"],
    legs: ["Squats", "Lunges", "Leg Press"],
    arms: ["Bicep Curl", "Triceps Dips", "Hammer Curl"],
  };

  // Load workout list based on selected body part
    window.addEventListener("DOMContentLoaded", function () {
    const selectedBodyPart = getQueryParam("bodypart");

    if (selectedBodyPart && workoutData[selectedBodyPart]) {
      const workoutListDiv = document.getElementById("workout-list");

      // Clear existing content
      workoutListDiv.innerHTML = "";

      // Add new workouts
      workoutData[selectedBodyPart].forEach(workout => {
        const li = document.createElement("li");
        li.textContent = workout;
        workoutListDiv.appendChild(li);
      });
    }
  });

  function attachViewListeners() {
    document.querySelectorAll('.view-btn').forEach((btn) => {
        btn.onclick = function() {
            const exName = btn.parentElement.querySelector('.exercise-name').textContent;
            const ex = exerciseDetails[exName] || {
                focus: "Unknown", equipment: "Unknown", reps: "##", duration: "##", sets: "##",
                gif1: "assets/images/sample-exercise.jpg", gif2: "assets/images/sample-exercise.jpg"
            };
            document.getElementById('modalTitle').textContent = exName;
            document.getElementById('modalFocus').textContent = ex.focus;
            document.getElementById('modalEquip').textContent = ex.equipment;
            document.getElementById('modalReps').textContent = ex.reps;
            document.getElementById('modalDuration').textContent = ex.duration;
            document.getElementById('modalSets').textContent = ex.sets;
            document.getElementById('modalgif1').src = ex.gif1;
            document.getElementById('modalgif2').src = ex.gif2;

            // Store selected exercise to dataset
            document.getElementById('addWorkoutBtn').dataset.exercise = exName;

            document.getElementById('exerciseModal').style.display = 'flex';
        };
    });
}

    document.getElementById('addWorkoutBtn').onclick = function() {
        const workoutName = this.dataset.exercise;
        const confirmAdd = confirm("Do you want to add this workout to your plan?");
        if (confirmAdd) {
            window.location.href = "plans.html?workout=" + encodeURIComponent(workoutName);
        }
    };

</script>

<?php include 'includes/footer.php'; ?>