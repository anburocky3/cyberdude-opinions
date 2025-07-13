import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {
    const suggestionsCtx = document.getElementById('suggestionsChart').getContext('2d');
    const suggestionsChart = new Chart(suggestionsCtx, {
        type: 'bar',
        data: {
            labels: JSON.parse(document.getElementById('suggestionsChart').dataset.labels),
            datasets: [{
                label: 'Suggestions',
                data: JSON.parse(document.getElementById('suggestionsChart').dataset.values),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const usersCtx = document.getElementById('usersChart').getContext('2d');
    const usersChart = new Chart(usersCtx, {
        type: 'pie',
        data: {
            labels: JSON.parse(document.getElementById('usersChart').dataset.labels),
            datasets: [{
                label: 'Users',
                data: JSON.parse(document.getElementById('usersChart').dataset.values),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed !== null) {
                                label += context.parsed;
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
});
