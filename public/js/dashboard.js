document.addEventListener('DOMContentLoaded', function () {
    const labelsStatus = ['Menunggu', 'Proses', 'Selesai'];
    const dataValues = [5, 12, 8]; // Sesuaikan dengan angka di card

    // --- 1. Bar Chart ---
    const ctxBar = document.getElementById('aspirasiBarChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: labelsStatus,
            datasets: [{
                data: dataValues,
                backgroundColor: ['#dc3545', '#f59f00', '#16a34a'],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // --- 2. Line Chart ---
    const ctxLine = document.getElementById('aspirasiLineChart').getContext('2d');
    const gradient = ctxLine.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(211, 47, 47, 0.4)');
    gradient.addColorStop(1, 'rgba(211, 47, 47, 0)');

    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: labelsStatus,
            datasets: [{
                data: dataValues,
                borderColor: '#d32f2f',
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 6,
                pointBackgroundColor: '#d32f2f'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f1f1' } },
                x: { grid: { display: false } }
            }
        }
    });
});
