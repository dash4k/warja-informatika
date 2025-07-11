<x-layout title="Referensi Penjaluran Informatika">
    <section class="min-h-screen py-12 px-4 bg-gray-100 font-[Poppins]">
        <div class="max-w-7xl mx-auto">
            <header class="text-center mb-12">
                <h1 class="text-3xl md:text-5xl font-bold text-gray-800 mb-4">Referensi Penjaluran Informatika</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">Temukan inspirasi dari arsip Tugas Akhir mahasiswa Informatika. Gunakan filter untuk mencari berdasarkan tahun, jalur, atau kata kunci.</p>
            </header>
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <aside class="lg:col-span-1 bg-white p-6 rounded-2xl shadow-lg h-fit sticky top-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-3">Filter & Pencarian</h2>
                    <div class="space-y-6">
                        <div>
                            <label for="searchInput" class="block mb-2 font-semibold text-gray-700">Cari Judul / Penulis</label>
                            <input id="searchInput" type="text" placeholder="e.g., Machine Learning" class="border rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
                        </div>
                        <div>
                            <label for="tahunSelect" class="block mb-2 font-semibold text-gray-700">Tahun</label>
                            <select id="tahunSelect" class="border rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                                <option value="all" selected>Semua Tahun</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                        <div>
                            <label for="jalurSelect" class="block mb-2 font-semibold text-gray-700">Jalur</label>
                            <select id="jalurSelect" class="border rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                                <option value="all" selected>Semua Jalur</option>
                                <option value="J1">J1 - Text Mining</option>
                                <option value="J2">J2 - Knowledge Discovery and Management</option>
                                <option value="J3">J3 - Music Information Retrieval</option>
                                <option value="J4">J4 - Multimedia System</option>
                                <option value="J5">J5 - Digital Security</option>
                                <option value="J6">J6 - Wireless Sensor Network</option>
                                <option value="J7">J7 - Smart Computing</option>
                                <option value="J8">J8 - Big Data Processing and Bussiness Management</option>
                                <option value="J9">J9 - User Interaction and Experience</option>
                            </select>
                        </div>
                    </div>
                </aside>
                <main class="lg:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="daftarTA"></div>
                    <div id="pagination" class="flex justify-center items-center gap-2 mt-8"></div>
                    <div id="noResults" class="hidden text-center text-gray-500 py-24 bg-white rounded-2xl shadow-md">
                        <p class="text-lg font-semibold">Data Tidak Ditemukan</p>
                        <p class="text-sm">Coba ubah filter atau kata kunci pencarian Anda.</p>
                    </div>
                </main>
            </div>
        </div>
        <script>
            const tugasAkhir = {
                '2022': [
                    {judul: 'Implementasi Algoritma K-Means untuk Segmentasi Data Mahasiswa', penulis: 'Ayu Lestari', jalur: 'J1', link: '#'},
                    {judul: 'Sistem Rekomendasi Buku Perpustakaan Berbasis Content-Based Filtering', penulis: 'Budi Santosa', jalur: 'J2', link: '#'},
                    {judul: 'Analisis Kerentanan SQL Injection pada Aplikasi Web Pemerintahan', penulis: 'Rahmat Hidayat', jalur: 'J3', link: '#'},
                ],
                '2023': [
                    {judul: 'Analisis Sentimen Opini Publik terhadap Kebijakan PPKM Menggunakan LSTM', penulis: 'Citra Dewi', jalur: 'J1', link: '#'},
                    {judul: 'Pengembangan Aplikasi Mobile Absensi Karyawan Berbasis QR Code dan GPS', penulis: 'Dewa Putra', jalur: 'J2', link: '#'},
                    {judul: 'Implementasi Intrusion Detection System (IDS) Menggunakan Snort pada Jaringan Skala Kecil', penulis: 'Indah Permata', jalur: 'J3', link: '#'},
                    {judul: 'Rancang Bangun Game Edukasi "Petualangan Aksara" untuk Anak Usia Dini', penulis: 'Gede Cahya', jalur: 'J5', link: '#'},
                ],
                '2024': [
                    {judul: 'ANALISIS SENTIMEN ULASAN PELAYANAN E-GOVERNMENT MENGGUNAKAN DISTILBERT', penulis: 'Ni Luh Putu Happy Nirmala', jalur: 'J1', link: '#'},
                    {judul: 'PEMODELAN TOPIK ULASAN PENGGUNA GOOGLE MAPS TERHADAP BIOSKOP DI BALI MENGGUNAKAN METODE BERTOPIC DENGAN INDOBERT-BASE-P1', penulis: 'I KOMANG DWIPRAYOGA', jalur: 'J1', link: '#'},
                    {judul: 'ASPECT BASED SENTIMEN ANALYSIS TERHADAP REVIEW APLIKASI GOJEK MENGGUNAKAN MODEL RoBERTa', penulis: 'WAYAN FAREL NICKHOLAS SADEWA', jalur: 'J1', link: '#'},
                    {judul: 'SISTEM PENCARIAN TREATMENT WAJAH PADA KLINIK KECANTIKAN DI KOTA DENPASAR BERBASIS ONTOLOGI', penulis: 'Putu Chandra Mayoni', jalur: 'J2', link: '#'},
                    {judul: 'PENGEMBANGAN SISTEM INFORMASI BERBASIS ONTOLOGI UNTUK PENCARIAN SEKOLAH LUAR BIASA (SLB) DI BADUNG DAN DENPASAR BALI', penulis: 'NI NYOMAN SUKMA PRASETYADEWI GITA', jalur: 'J2', link: '#'},
                    {judul: 'SISTEM PENDUKUNG KEPUTUSAN UNTUK PENANAMAN TANAMAN OBAT DI INDONESIA MENGGUNAKAN METODE SIMPLE ADDITIVE WEIGHTING (SAW)', penulis: 'Gede Verel Aditya Setiabudi', jalur: 'J2', link: '#'},
                ],
                '2025': [
                    {judul: 'Optimasi Model Generatif (GAN) untuk Sintesis Gambar Wajah Realistis', penulis: 'Kadek Surya', jalur: 'J4', link: '#'},
                    {judul: 'Perancangan Mekanika Karakter dan AI Musuh pada Game RPG 3D', penulis: 'Nyoman Bayu', jalur: 'J5', link: '#'},
                    {judul: 'Prediksi Harga Saham Menggunakan Analisis Time Series dengan Model ARIMA', penulis: 'Komang Ayu', jalur: 'J1', link: '#'},
                ]
            };

            // Definisikan ikon dan warna untuk setiap jalur untuk tampilan visual
            const jalurInfo = {
                'J1': { icon: 'J1', color: 'bg-blue-100 text-blue-800' },
                'J2': { icon: 'J2', color: 'bg-green-100 text-green-800' },
                'J3': { icon: 'J3', color: 'bg-red-100 text-red-800' },
                'J4': { icon: 'J4', color: 'bg-purple-100 text-purple-800' },
                'J5': { icon: 'J5', color: 'bg-orange-100 text-orange-800' },
                'J6': { icon: 'J6', color: 'bg-sky-100 text-orange-800' },
                'J7': { icon: 'J7', color: 'bg-green-100 text-orange-800' },
                'J8': { icon: 'J8', color: 'bg-cyan-100 text-orange-800' },
                'J9': { icon: 'J9', color: 'bg-pink-100 text-orange-800' },
            };

            // Inline style for fade-in-up
            function addFadeInUp(el, delay) {
                el.style.opacity = 0;
                el.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    el.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                    el.style.opacity = 1;
                    el.style.transform = 'translateY(0)';
                }, delay);
            }

            const ITEMS_PER_PAGE = 8;
            let currentPage = 1;
            let lastData = [];

            // Fungsi untuk menampilkan kartu tugas akhir
            function renderTA(tahun, jalur, search, page = 1) {
                const container = document.getElementById('daftarTA');
                const noResults = document.getElementById('noResults');
                const pagination = document.getElementById('pagination');
                container.innerHTML = '';
                let data = [];
                if (tahun === 'all') {
                    // Gabungkan semua tahun
                    Object.values(tugasAkhir).forEach(arr => data.push(...arr));
                } else {
                    data = tugasAkhir[tahun] || [];
                }
                if (jalur !== 'all') {
                    data = data.filter(ta => ta.jalur === jalur);
                }
                if (search) {
                    const s = search.toLowerCase();
                    data = data.filter(ta =>
                        ta.judul.toLowerCase().includes(s) ||
                        ta.penulis.toLowerCase().includes(s)
                    );
                }
                lastData = data;
                // Pagination logic
                const totalPages = Math.ceil(data.length / ITEMS_PER_PAGE) || 1;
                if (page > totalPages) page = totalPages;
                currentPage = page;
                const start = (page - 1) * ITEMS_PER_PAGE;
                const end = start + ITEMS_PER_PAGE;
                const pageData = data.slice(start, end);
                if (pageData.length === 0) {
                    noResults.style.display = 'block';
                    pagination.innerHTML = '';
                } else {
                    noResults.style.display = 'none';
                    pageData.forEach((ta, index) => {
                        const info = jalurInfo[ta.jalur] || { icon: '', color: 'bg-gray-100 text-gray-800' };
                        const card = document.createElement('div');
                        card.className = 'bg-white rounded-2xl shadow-md p-6 flex flex-col gap-4 transition-all duration-300 hover:shadow-xl hover:-translate-y-1';
                        addFadeInUp(card, index * 70);

                        card.innerHTML = `
                            <div class="flex items-start justify-between">
                                <h3 class="font-bold text-gray-900 text-lg pr-4 leading-tight">${ta.judul}</h3>
                                <div title="${ta.jalur}" class="flex-shrink-0 p-2 rounded-full ${info.color}">${info.icon}</div>
                            </div>
                            <p class="text-sm text-gray-600">Oleh: ${ta.penulis}</p>
                            <div class="mt-auto pt-4 border-t border-gray-100">
                                <a href="${ta.link}" target="_blank" class="text-indigo-600 font-semibold hover:text-indigo-800 text-sm flex items-center gap-2">
                                    Lihat Dokumen
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                                </a>
                            </div>
                        `;
                        container.appendChild(card);
                    });
                    // Render pagination
                    let pagHTML = '';
                    if (totalPages > 1) {
                        if (currentPage > 1) pagHTML += `<button class='px-3 py-1 rounded bg-gray-200 hover:bg-indigo-200' onclick='goToPage(${currentPage-1})'>&laquo;</button>`;
                        for (let i = 1; i <= totalPages; i++) {
                            pagHTML += `<button class='px-3 py-1 rounded ${i===currentPage?'bg-indigo-500 text-white':'bg-gray-200 hover:bg-indigo-200'}' onclick='goToPage(${i})'>${i}</button>`;
                        }
                        if (currentPage < totalPages) pagHTML += `<button class='px-3 py-1 rounded bg-gray-200 hover:bg-indigo-200' onclick='goToPage(${currentPage+1})'>&raquo;</button>`;
                    }
                    pagination.innerHTML = pagHTML;
                }
            }
            window.goToPage = function(page) {
                const tahun = document.getElementById('tahunSelect').value;
                const jalur = document.getElementById('jalurSelect').value;
                const search = document.getElementById('searchInput').value;
                renderTA(tahun, jalur, search, page);
            }
            // Fungsi untuk memperbarui tampilan berdasarkan input filter
            function updateTA() {
                const tahun = document.getElementById('tahunSelect').value;
                const jalur = document.getElementById('jalurSelect').value;
                const search = document.getElementById('searchInput').value;
                renderTA(tahun, jalur, search, 1);
            }

            // Menambahkan event listener ke setiap elemen filter
            document.getElementById('tahunSelect').addEventListener('change', updateTA);
            document.getElementById('jalurSelect').addEventListener('change', updateTA);
            document.getElementById('searchInput').addEventListener('input', updateTA);

            // Menampilkan data awal saat halaman pertama kali dimuat
            renderTA('2024', 'all', '', 1);
        </script>
    </section>
</x-layout>
