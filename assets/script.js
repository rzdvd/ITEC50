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

/* PLANS */

function setActive(button) {
    const buttons = document.querySelectorAll(".day-tab");
    buttons.forEach(btn => day-tab.classList.remove("active"));

    button.classList.add("active");
}


document.querySelectorAll(".day-tab").forEach(button => {
    button.addEventListener("click", () => {

        document.querySelectorAll(".day-tab").forEach(btn => {
            btn.classList.remove("active");
        });
        button.classList.add("active");

        const day = button.getAttribute("data-day");
        loadWorkout(day);
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



