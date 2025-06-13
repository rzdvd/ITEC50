

/* PLANS */

function changeDay(day) {
    window.location.href = 'plans.php?day=' + day;
}

const modal = document.getElementById("workoutModal");
const addWorkoutButton = document.querySelector(".add");
const closeButton = document.querySelector(".close");

addWorkoutButton.onclick = function() {
    modal.style.display = "block";
}

closeButton.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

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
                            color:'#fff'
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


