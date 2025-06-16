document.addEventListener('DOMContentLoaded', () => {

    function loadWorkoutStats() {
        fetch('get-stats.php')
            .then(res => res.json())
            .then(data => {
                if (data.error) {
                    console.error(data.error);
                    return;
                }

                // Fill in the data boxes
                const boxes = document.querySelectorAll('.container2 .box');
                boxes[0].querySelector('.data').textContent = data.days_active || 0;
                boxes[1].querySelector('.data').textContent = data.completed_workouts || 0;
                boxes[2].querySelector('.data').textContent = data.total_reps || 0;
                boxes[3].querySelector('.data').textContent = (data.total_duration / 60) + 'mins';
            })
            .catch(err => console.error('Failed to load stats:', err));
    }

    const monthYearElement = document.getElementById('monthYear');
    const datesElement = document.getElementById('dates');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    let currentDate = new Date();
    let selectedDate = null;

    const addDateClickListeners = () => {
        const dateDivs = document.querySelectorAll('.date:not(.inactive)');

        function displayHistory(data) {
            const completedWOContainer = document.querySelector('#completedWOs .completedWO');

            if (!completedWOContainer) {
                console.warn('⚠️ Container for completed workouts not found in the DOM.');
                return;
            }

            completedWOContainer.innerHTML = '';

            if (data.length === 0) {
                completedWOContainer.innerHTML = '<p>No workout history for this day.</p>';
                return;
            }

            data.forEach(entry => {
                const p = document.createElement('p');
                p.textContent = `${entry.exercise_name} - ${entry.reps} reps (${entry.duration} sec) x ${entry.sets} sets`;
                completedWOContainer.appendChild(p);
            });
        }

        dateDivs.forEach(dateDiv => {
            dateDiv.addEventListener('click', () => {
                selectedDate = dateDiv.getAttribute('data-date');

                // Remove both active and selected styles
                document.querySelectorAll('.date').forEach(d => d.classList.remove('selected', 'active'));

                // Apply selected style to clicked date
                dateDiv.classList.add('selected');

                // Load history
                fetch(`get-history.php?date=${selectedDate}`)
                    .then(res => res.json())
                    .then(data => displayHistory(data))
                    .catch(err => console.error('Failed to load history:', err));
            });
        });
    }

    const updateCalendar = () => {
        const currentYear = currentDate.getFullYear();
        const currentMonth = currentDate.getMonth();

        const firstDay = new Date(currentYear, currentMonth, 0);
        const lastDay = new Date(currentYear, currentMonth + 1, 0);
        const totalDays = lastDay.getDate();
        const firstDayIndex = firstDay.getDay();
        const lastDayIndex = lastDay.getDay();

        const monthYearString = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });
        monthYearElement.textContent = monthYearString;

        let datesHTML = '';

        for (let i = firstDayIndex; i > 0; i--) {
            const prevDate = new Date(currentYear, currentMonth, 0 - i + 1);
            datesHTML += `<div class="date inactive">${prevDate.getDate()}</div>`;
        }

        for (let i = 1; i <= totalDays; i++) {
            const date = new Date(currentYear, currentMonth, i);
            const activeClass = date.toDateString() === new Date().toDateString() ? 'active' : '';

            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const isoDate = `${year}-${month}-${day}`;

            datesHTML += `<div class="date ${activeClass}" data-date="${isoDate}">${i}</div>`;
        }

        for (let i = 1; i <= 7 - lastDayIndex; i++) {
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
    loadWorkoutStats();

        // Automatically load today's history on page load
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const isoDate = `${year}-${month}-${day}`;
    fetch(`get-history.php?date=${isoDate}`)
        .then(res => res.json())
        .then(data => {
            // Highlight today's date in the calendar if present
            document.querySelectorAll('.date').forEach(d => {
                if (d.getAttribute('data-date') === isoDate) {
                    d.classList.add('selected');
                }
            });
            // Display today's history
            const completedWOContainer = document.querySelector('#completedWOs .completedWO');
            if (completedWOContainer) {
                completedWOContainer.innerHTML = '';
                if (data.length === 0) {
                    completedWOContainer.innerHTML = '<p>No workout history for this day.</p>';
                } else {
                    data.forEach(entry => {
                        const p = document.createElement('p');
                        p.textContent = `${entry.exercise_name} - ${entry.reps} reps (${entry.duration} sec) x ${entry.sets} sets`;
                        completedWOContainer.appendChild(p);
                    });
                }
            }
        });
});