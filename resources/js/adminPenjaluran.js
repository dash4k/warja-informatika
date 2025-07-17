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
                                    return `${context.label}: ${context.raw} Responden`;
                                }
                            }
                        }
                    }
                }
            };
            new Chart(ctx, config);
        }
    }

    document.querySelectorAll('.showButton').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const jalur = row.dataset.jalur;
            const surveyData = JSON.parse(row.dataset.survey || '[]');

            const modal = document.getElementById('previewModal');
            const modalTitle = document.getElementById('modalTitle');
            const previewTable = document.getElementById('previewTable');

            const headers = [
                { label: 'ID', key: 'id' },
                { label: 'NIM', key: 'nim' },
                { label: 'Jalur', key: 'id_jalur' },
                { label: 'Tanggal/Waktu', key: 'created_at' }
            ];

            modalTitle.textContent = `Daftar Responded Jalur ${jalur}`;

            // Clear existing table content
            previewTable.innerHTML = '';

            if (surveyData.length === 0) {
                previewTable.innerHTML = '<tr><td class="text-center py-4">Belum ada data untuk jalur ini.</td></tr>';
            } else {
                // Create table headers
                const thead = document.createElement('thead');
                const headerRow = document.createElement('tr');
                headers.forEach(({ label }) => {
                    const th = document.createElement('th');
                    th.className = 'border px-4 py-2 bg-blue-100';
                    th.textContent = label;
                    headerRow.appendChild(th);
                });
                thead.appendChild(headerRow);
                previewTable.appendChild(thead);

                // Create table body
                const tbody = document.createElement('tbody');
                surveyData.forEach(entry => {
                    const row = document.createElement('tr');
                    headers.forEach(({ key }) => {
                        const td = document.createElement('td');
                        td.className = 'border px-4 py-2';
                        td.textContent = key === 'created_at' ? new Date(entry[key]).toLocaleString() : entry[key] ?? '-';
                        row.appendChild(td);
                    });
                    tbody.appendChild(row);
                });
                previewTable.appendChild(tbody);
            }

            // Show the modal
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
        });
    });

    document.getElementById('closeModal').addEventListener('click', () => {
        const modal = document.getElementById('previewModal');
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100');
    });

    document.getElementById('previewModal').addEventListener('click', (e) => {
        if (e.target === e.currentTarget) {
            const modal = document.getElementById('previewModal');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.classList.remove('opacity-100');
        }
    });
});