<x-layout title="Statistik Penjaluran Informatika">
    <section class="py-12 px-4 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-bold text-center text-indigo-800 mb-10">Statistik Penjaluran Informatika</h1>

            <div class="flex flex-col items-center bg-gradient-to-br from-white via-blue-100 to-indigo-100 rounded-2xl shadow-2xl p-14 min-h-[60vh] justify-center relative overflow-hidden w-full">

                <p class="text-gray-700 text-lg text-center mb-8">Statistik jumlah mahasiswa per jalur dari tahun ke tahun dan data penunjang lainnya.</p>

                <!-- Dropdown Filter Tahun -->
                <div class="mb-6">
                    <label for="tahunFilter" class="block text-sm font-medium text-gray-700 text-center mb-2">Pilih Tahun</label>
                    <select id="tahunFilter" class="block w-48 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-center">
                        <option value="all" selected>Semua Tahun</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>

                <!-- Grafik -->
                <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h2 class="text-xl font-bold text-indigo-700 mb-4 text-center">Grafik Jumlah Mahasiswa</h2>
                    <canvas id="chartJalur" height="200"></canvas>
                </div>

                <!-- Tabel -->
                <div class="w-full max-w-2xl bg-white rounded-xl shadow p-6 mb-8 overflow-x-auto">
                    <h2 class="text-lg font-semibold text-indigo-700 mb-2">Rekap Data Mahasiswa per Jalur</h2>
                    <table class="min-w-full text-sm text-center">
                        <thead>
                            <tr class="bg-indigo-100">
                                <th class="px-2 py-1">Tahun</th>
                                <th class="px-2 py-1">J1</th>
                                <th class="px-2 py-1">J2</th>
                                <th class="px-2 py-1">J3</th>
                                <th class="px-2 py-1">J4</th>
                                <th class="px-2 py-1">J5</th>
                                <th class="px-2 py-1">J6</th>
                                <th class="px-2 py-1">J7</th>
                                <th class="px-2 py-1">J8</th>
                                <th class="px-2 py-1">J9</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- Isi tabel akan dimodifikasi via JS -->
                        </tbody>
                    </table>
                </div>

                <!-- Statistik -->
                <div class="w-full max-w-2xl grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div class="bg-indigo-200 rounded-lg p-4 text-center shadow">
                        <div class="text-2xl font-bold text-indigo-800">250</div>
                        <div class="text-sm text-indigo-900">Total Mahasiswa</div>
                    </div>
                    <div class="bg-blue-200 rounded-lg p-4 text-center shadow">
                        <div class="text-2xl font-bold text-blue-800">J1</div>
                        <div class="text-sm text-blue-900">Jalur Terfavorit</div>
                    </div>
                    <div class="bg-green-200 rounded-lg p-4 text-center shadow">
                        <div class="text-2xl font-bold text-green-800">35</div>
                        <div class="text-sm text-green-900">Mahasiswa Terbanyak (2024)</div>
                    </div>
                </div>

                <!-- Chart.js CDN & Script -->
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const dataByYear = {
                        2022: [30, 28, 25, 20, 18, 22, 19, 21, 17],
                        2023: [32, 29, 27, 22, 20, 24, 21, 23, 19],
                        2024: [35, 31, 29, 24, 22, 26, 23, 25, 21],
                    };
                    const jalurLabels = ['J1','J2','J3','J4','J5','J6','J7','J8','J9'];
                    const chartCanvas = document.getElementById('chartJalur').getContext('2d');
                    let chart;

                    function generateChart(type, datasets, labels) {
                        if (chart) chart.destroy();
                        chart = new Chart(chartCanvas, {
                            type: type,
                            data: {
                                labels: labels,
                                datasets: datasets
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: { position: 'bottom' },
                                    title: { display: false }
                                },
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });
                    }

                    function updateTableView(year) {
                        const tableBody = document.getElementById('tableBody');
                        tableBody.innerHTML = "";

                        if (year === "all") {
                            for (let y of ["2022", "2023", "2024"]) {
                                const row = dataByYear[y].map(d => `<td class="px-2 py-1">${d}</td>`).join('');
                                tableBody.innerHTML += `<tr><td class="px-2 py-1">${y}</td>${row}</tr>`;
                            }
                        } else {
                            const row = dataByYear[year].map(d => `<td class="px-2 py-1">${d}</td>`).join('');
                            tableBody.innerHTML = `<tr><td class="px-2 py-1">${year}</td>${row}</tr>`;
                        }
                    }

                    function updateChart(year) {
                        if (year === "all") {
                            const datasets = jalurLabels.map((jalur, index) => ({
                                label: jalur,
                                data: Object.values(dataByYear).map(y => y[index]),
                                borderColor: `hsl(${index * 40}, 80%, 50%)`,
                                backgroundColor: `hsl(${index * 40}, 80%, 80%)`,
                                fill: false
                            }));
                            generateChart('line', datasets, ['2022', '2023', '2024']);
                        } else {
                            const dataset = [{
                                label: `Jumlah Mahasiswa ${year}`,
                                data: dataByYear[year],
                                backgroundColor: '#6366F1'
                            }];
                            generateChart('bar', dataset, jalurLabels);
                        }
                    }

                    document.getElementById('tahunFilter').addEventListener('change', function () {
                        const selectedYear = this.value;
                        updateTableView(selectedYear);
                        updateChart(selectedYear);
                    });

                    // Init default: Semua Tahun
                    updateTableView("all");
                    updateChart("all");
                </script>
            </div>
        </div>
    </section>
</x-layout>
