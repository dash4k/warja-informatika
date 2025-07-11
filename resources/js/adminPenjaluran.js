import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {
    if (typeof window.storeSoalUrl === 'undefined' || typeof window.updateSoalUrl === 'undefined') {
        console.error("Routing URLs (storeSoalUrl, updateSoalUrl) are not defined in the Blade file!");
    }

    if (typeof window.chartData !== 'undefined') {
        const ctx = document.getElementById('jalurPieChart');

        if (ctx) {
            const data = {
                labels: window.chartData.labels,
                datasets: [{
                    label: 'Jumlah Soal per Jalur',
                    data: window.chartData.data,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                        '#9966FF', '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56'
                    ],
                    hoverOffset: 4
                }],
                borderColor: '#ffffff',
                borderWidth: 2,
            };

            const config = {
                type: 'pie',
                data: {
                    labels: window.chartData.labels,
                    datasets: [{
                        label: 'Jumlah Soal',
                        data: window.chartData.data,
                        backgroundColor: [
                            '#ff6384', '#36a2eb', '#ffce56', '#4bc0c0',
                            '#9966ff', '#ff9f40', '#c9cbcf', '#8a2be2', '#00b894'
                        ],
                        borderColor: '#fff',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                font: {
                                    size: 14,
                                    family: 'Poppins'
                                },
                                color: '#444',
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw} soal`;
                                }
                            }
                        }
                    }
                }
            };
            new Chart(ctx, config);
        }
    }
});