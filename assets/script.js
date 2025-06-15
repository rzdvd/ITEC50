

/* PLANS */

function changeDay(day) {
    window.location.href = 'plans.php?day=' + day;
}

document.querySelector(".add").addEventListener("click", function() {
    document.getElementById("workoutModal").style.display = "flex";
});

document.querySelector(".close").addEventListener("click", function() {
    document.getElementById("workoutModal").style.display = "none";
});

window.addEventListener("click", function(e) {
    const modal = document.getElementById("workoutModal");
    if (e.target === modal) {
        modal.style.display = "none";
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const workoutSelect = document.getElementById('workoutSelect');
    const setsInput = document.getElementById('sets');
    const repsInput = document.getElementById('reps');
    const durationInput = document.getElementById('duration');

    workoutSelect.addEventListener('change', function() {
        const selectedWorkout = this.value;

        const workout = workoutsData.find(workout => workout.name === selectedWorkout);
        if (workout) {
            setsInput.value = workout.sets;
            repsInput.value = workout.reps;
            durationInput.value = workout.duration;
        } else {
            setsInput.value = '';
            repsInput.value = '';
            durationInput.value = '';
        }
    });
});

document.querySelectorAll('.edit-button').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const sets = this.dataset.sets;
        const reps = this.dataset.reps;
        const duration = this.dataset.duration;

        // Populate form fields
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-sets').value = sets;
        document.getElementById('edit-reps').value = reps;
        document.getElementById('edit-duration').value = duration;

        // Show modal
        document.getElementById('editWorkoutModal').style.display = 'flex';
    });
});

// Close modal logic (optional: make sure you also add close button logic)
document.querySelector('.close-edit').addEventListener('click', function() {
    document.getElementById('editWorkoutModal').style.display = 'none';
});

window.addEventListener("click", function(e) {
  const modal = document.getElementById("editWorkoutModal");
  if (e.target === modal) {
    modal.style.display = "none";
  }
});


/* HISTORY */

window.onload = () => loadWorkout ("tue"); 
const monthYearElement = document.getElementById('monthYear');
const datesElement = document.getElementById('dates');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

let currentDate = new Date();

const updateCalendar = () => {
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();

    const firstDay = new Date(currentYear, currentMonth, 0);
    const lastDay = new Date(currentYear, currentMonth + 1, 0);
    const totalDays = lastDay.getDate();
    const firstDayIndex = firstDay.getDay();
    const lastDayIndex = lastDay.getDay();

    const monthYearString = currentDate.toLocaleString('default', {month: 'long', year: 'numeric'});
    monthYearElement.textContent = monthYearString;

    let datesHTML = '';

    for(let i = firstDayIndex; i > 0; i--) {
        const prevDate = new Date(currentYear, currentMonth, 0 - i + 1);
        datesHTML += `<div class="date inactive">${prevDate.getDate()}</div>`;
    }

    for(let i = 1; i <= totalDays; i++) {
        const date = new Date(currentYear, currentMonth, i);
        const activeClass = date.toDateString() === new Date().toDateString() ? 'active' : '';
        datesHTML += `<div class="date ${activeClass}">${i}</div>`;
    }

    for(let i = 1; i<=7 - lastDayIndex; i++) {
        const nextDate = new Date(currentYear, currentMonth + 1, i);
        datesHTML += `<div class="date inactive">${nextDate.getDate()}</div>`;
    }

    datesElement.innerHTML = datesHTML;
}

prevBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    updateCalendar();
})

nextBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    updateCalendar();
})

updateCalendar();

/* PROGRESS */



