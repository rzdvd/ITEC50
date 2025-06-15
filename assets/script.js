

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
const modal = document.getElementById("workoutModal");
const addWorkoutButton = document.querySelector(".add");
const closeButton = document.querySelector(".close");

addWorkoutButton.onclick = function () {
    modal.style.display = "block";
}

closeButton.onclick = function () {
    modal.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const workoutSelect = document.getElementById('workoutSelect');
    const setsInput = document.getElementById('sets');
    const repsInput = document.getElementById('reps');
    const durationInput = document.getElementById('duration');

    workoutSelect.addEventListener('change', function () {
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

console.log("Script loaded");

window.onload = () => loadWorkout("tue");

const monthYearElement = document.getElementById('monthYear');
const datesElement = document.getElementById('dates');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

let currentDate = new Date();

const addDateClickListeners = () => {
    const dateDivs = document.querySelectorAll('.date:not(.inactive)');

    function displayHistory(data) {
        const completedWOContainer = document.querySelector('#completedWOs .completedWO');

        completedWOContainer.innerHTML = '';

        if (data.length === 0) {
            completedWOContainer.innerHTML = '<p>No workout history for this day.</p>';
            return;
        }

        data.forEach(entry => {
            const p = document.createElement('p');
            p.textContent = `${entry.exercise_name} - ${entry.sets} sets × ${entry.reps} reps (${entry.duration} sec)`;
            completedWOContainer.appendChild(p);
        });
    }

    dateDivs.forEach(dateDiv => {
        dateDiv.addEventListener('click', () => {
            const selectedDate = dateDiv.getAttribute('data-date');

            //highlight selected date
            document.querySelectorAll('.date').forEach(d => d.classList.remove('selected'));
            dateDiv.classList.add('selected');

            console.log("Clicked date:", selectedDate);  // For debugging

            fetch(`/get-history?date=${selectedDate}`)
                .then(res => res.json())
                .then(data => {
                    displayHistory(data); // You define this function
                })
                .catch(err => console.error('Failed to load history:', err));
        });
    });
};

const updateCalendar = () => {
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();

    const firstDay = new Date(currentYear, currentMonth, 1); // ✅ fixed
    const lastDay = new Date(currentYear, currentMonth + 1, 0);
    const totalDays = lastDay.getDate();
    const firstDayIndex = firstDay.getDay(); // 0 (Sunday) - 6 (Saturday)
    const lastDayIndex = lastDay.getDay();

    const monthYearString = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });
    monthYearElement.textContent = monthYearString;

    let datesHTML = '';

    // Fill in the previous month's trailing days
    for (let i = firstDayIndex; i > 0; i--) {
        const prevDate = new Date(currentYear, currentMonth, 1 - i);
        datesHTML += `<div class="date inactive">${prevDate.getDate()}</div>`;
    }

    // Fill in current month
    for (let i = 1; i <= totalDays; i++) {
        const date = new Date(currentYear, currentMonth, i);
        const activeClass = date.toDateString() === new Date().toDateString() ? 'active' : '';
        const isoDate = date.toISOString().split('T')[0];

        datesHTML += `<div class="date ${activeClass}" data-date="${isoDate}">${i}</div>`;
    }

    // Fill in next month's leading days
    const totalCells = firstDayIndex + totalDays;
    const nextDays = (7 - (totalCells % 7)) % 7;
    for (let i = 1; i <= nextDays; i++) {
        const nextDate = new Date(currentYear, currentMonth + 1, i);
        datesHTML += `<div class="date inactive">${nextDate.getDate()}</div>`;
    }

    datesElement.innerHTML = datesHTML;
    addDateClickListeners();
};

prevBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    updateCalendar();
});

nextBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    updateCalendar();
});

updateCalendar();

/* PROGRESS */

document.addEventListener('DOMContentLoaded', function () {
    fetch('progress_data.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('progress-chart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Weight',
                        data: data.weights,
                        borderColor: '#fff',
                        backgroundColor: '#843d49',
                        fill: false,
                        pointRadius: 5,
                        tension: 0.3
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'My Weight',
                            color: '#fff',
                            font: {
                                size: 24
                            },
                            align: 'start',
                            padding: {
                                bottom: 30
                            }
                        },
                        legend: {
                            display: false
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: {
                                color: '#fff',
                                font: {
                                    size: 14
                                }
                            },
                            grid: {
                                color: '#f8f8f8'
                            },
                            title: {
                                display: true,
                                text: 'Date',
                                color: '#fff'
                            },
                        },
                        y: {
                            min: 49.4,
                            max: 50.4,
                            ticks: {
                                stepSize: 0.1,
                                color: '#fff',
                                font: {
                                    size: 14
                                }
                            },
                            grid: {
                                color: '#f8f8f8'
                            },
                            title: {
                                display: true,
                                text: 'Weight (kg)',
                                color: '#fff'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching progress data:', error);
        });
});


