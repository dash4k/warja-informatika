document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.editButton');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const row = button.closest('tr');
            const form = row.querySelector('form');
            if (!form) return;

            const textarea = form.querySelector('textarea');
            
            form.classList.remove('hidden');
            textarea.removeAttribute('disabled');
            button.classList.add('hidden');
            textarea.focus();
        });
    });

    const cancelButtons = document.querySelectorAll('.cancelEditButton');
    cancelButtons.forEach(cancelButton => {
        cancelButton.addEventListener('click', () => {
            const row = cancelButton.closest('tr');
            const form = row.querySelector('form');
            const textarea = form.querySelector('textarea');
            const editButton = row.querySelector('.editButton');

            if (!form || !editButton) {
                console.error('Form or Edit Button not found');
                return;
            }

            form.classList.add('hidden');
            textarea.setAttribute('disabled', 'disabled');

            editButton.classList.remove('hidden');
        });
    });

    const closeNilai = document.getElementById('closeNilai');
    const nilaiContainer = document.getElementById('nilaiContainer')

    const nilais = {
        nim: document.getElementById('nim'),
        etikaProfesi: document.getElementById('etikaProfesi'),
        kewarganegaraan: document.getElementById('kewarganegaraan'),
        bahasaIndonesia: document.getElementById('bahasaIndonesia'),
        matematikaDiskrit1: document.getElementById('matematikaDiskrit1'),
        statistikaDasar: document.getElementById('statistikaDasar'),
        algoritmaPemrograman: document.getElementById('algoritmaPemrograman'),
        sistemDigital: document.getElementById('sistemDigital'),
        matematikaInformatika: document.getElementById('matematikaInformatika'),
        pancasila: document.getElementById('pancasila'),
        pendidikanAgama: document.getElementById('pendidikanAgama'),
        matematikaDiskrit2: document.getElementById('matematikaDiskrit2'),
        pengantarProbabilitas: document.getElementById('pengantarProbabilitas'),
        kewirausahaan: document.getElementById('kewirausahaan'),
        tataTulisKaryaIlmiah: document.getElementById('tataTulisKaryaIlmiah'),
        strukturData: document.getElementById('strukturData'),
        sistemOperasi: document.getElementById('sistemOperasi'),
        organisasiArsitekturKomputer: document.getElementById('organisasiArsitekturKomputer'),
        interaksiManusiaKomputer: document.getElementById('interaksiManusiaKomputer'),
        basisData: document.getElementById('basisData'),
        desainAnalisisAlgoritma: document.getElementById('desainAnalisisAlgoritma'),
        rekayasaPerangkatLunak: document.getElementById('rekayasaPerangkatLunak'),
        pemrogramanBerorientasiObyek: document.getElementById('pemrogramanBerorientasiObyek'),
        komunikasiDataJaringanKomputer: document.getElementById('komunikasiDataJaringanKomputer'),
        teoriBahasaOtomata: document.getElementById('teoriBahasaOtomata'),
        transkrip: document.getElementById('transkrip'),
    }

    function toggleContainer(show=true) {
        nilaiContainer.classList.toggle('opacity-0', !show);
        nilaiContainer.classList.toggle('pointer-events-none', !show);
        nilaiContainer.classList.toggle('opacity-100', show);
    }

    function populateContainer(data) {
        nilais.nim.innerHTML = data.nim;
        nilais.etikaProfesi.innerHTML = data.etikaProfesi;
        nilais.kewarganegaraan.innerHTML = data.kewarganegaraan;
        nilais.bahasaIndonesia.innerHTML = data.bahasaIndonesia;
        nilais.matematikaDiskrit1.innerHTML = data.matematikaDiskrit1;
        nilais.statistikaDasar.innerHTML = data.statistikaDasar;
        nilais.algoritmaPemrograman.innerHTML = data.algoritmaPemrograman;
        nilais.sistemDigital.innerHTML = data.sistemDigital;
        nilais.matematikaInformatika.innerHTML = data.matematikaInformatika;
        nilais.pancasila.innerHTML = data.pancasila;
        nilais.pendidikanAgama.innerHTML = data.pendidikanAgama;
        nilais.matematikaDiskrit2.innerHTML = data.matematikaDiskrit2;
        nilais.pengantarProbabilitas.innerHTML = data.pengantarProbabilitas;
        nilais.kewirausahaan.innerHTML = data.kewirausahaan;
        nilais.tataTulisKaryaIlmiah.innerHTML = data.tataTulisKaryaIlmiah;
        nilais.strukturData.innerHTML = data.strukturData;
        nilais.sistemOperasi.innerHTML = data.sistemOperasi;
        nilais.organisasiArsitekturKomputer.innerHTML = data.organisasiArsitekturKomputer;
        nilais.interaksiManusiaKomputer.innerHTML = data.interaksiManusiaKomputer;
        nilais.basisData.innerHTML = data.basisData;
        nilais.desainAnalisisAlgoritma.innerHTML = data.desainAnalisisAlgoritma;
        nilais.rekayasaPerangkatLunak.innerHTML = data.rekayasaPerangkatLunak;
        nilais.pemrogramanBerorientasiObyek.innerHTML = data.pemrogramanBerorientasiObyek;
        nilais.komunikasiDataJaringanKomputer.innerHTML = data.komunikasiDataJaringanKomputer;
        nilais.teoriBahasaOtomata.innerHTML = data.teoriBahasaOtomata;
        nilais.transkrip.src = data.transkrip;
    }

    document.querySelectorAll('.showNilai').forEach(button => {
        button.addEventListener('click', () => {
            const row = button.closest('.nilaiRow');
            const data = {
                nim: row.getAttribute('data-nim'),
                etikaProfesi: row.getAttribute('data-etika-profesi'),
                kewarganegaraan: row.getAttribute('data-kewarganegaraan'),
                bahasaIndonesia: row.getAttribute('data-bahasa-indonesia'),
                matematikaDiskrit1: row.getAttribute('data-matematika-diskrit-1'),
                statistikaDasar: row.getAttribute('data-statistika-dasar'),
                algoritmaPemrograman: row.getAttribute('data-algoritma-pemrograman'),
                sistemDigital: row.getAttribute('data-sistem-digital'),
                matematikaInformatika: row.getAttribute('data-matematika-informatika'),
                pancasila: row.getAttribute('data-pancasila'),
                pendidikanAgama: row.getAttribute('data-pendidikan-agama'),
                matematikaDiskrit2: row.getAttribute('data-matematika-diskrit-2'),
                pengantarProbabilitas: row.getAttribute('data-pengantar-probabilitas'),
                kewirausahaan: row.getAttribute('data-kewirausahaan'),
                tataTulisKaryaIlmiah: row.getAttribute('data-tata-tulis-karya-ilmiah'),
                strukturData: row.getAttribute('data-struktur-data'),
                sistemOperasi: row.getAttribute('data-sistem-operasi'),
                organisasiArsitekturKomputer: row.getAttribute('data-organisasi-arsitektur-komputer'),
                interaksiManusiaKomputer: row.getAttribute('data-interaksi-manusia-komputer'),
                basisData: row.getAttribute('data-basis-data'),
                desainAnalisisAlgoritma: row.getAttribute('data-desain-analisis-algoritma'),
                rekayasaPerangkatLunak: row.getAttribute('data-rekayasa-perangkat-lunak'),
                pemrogramanBerorientasiObyek: row.getAttribute('data-pemrograman-berorientasi-obyek'),
                komunikasiDataJaringanKomputer: row.getAttribute('data-komunikasi-data-jaringan-komputer'),
                teoriBahasaOtomata: row.getAttribute('data-teori-bahasa-otomata'),
                transkrip: row.getAttribute('data-transkrip'),
            };

            populateContainer(data);
            toggleContainer(true);
        });
    });

    closeNilai.addEventListener('click', () => toggleContainer(false));
});