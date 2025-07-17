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

    const closeDeskripsi = document.getElementById('closeDeskripsi');
    const deskripsiContainer = document.getElementById('deskripsiContainer')

    const portofolio = {
        idPortofolio: document.getElementById('idPortofolio'),
        nama: document.getElementById('nama'),
        tempat: document.getElementById('tempat'),
        tanggal: document.getElementById('tanggal'),
        bobot: document.getElementById('bobot'),
        jalur: document.getElementById('jalur'),
        sertifikat: document.getElementById('sertifikat'),
    }

    function toggleContainer(show=true) {
        deskripsiContainer.classList.toggle('opacity-0', !show);
        deskripsiContainer.classList.toggle('pointer-events-none', !show);
        deskripsiContainer.classList.toggle('opacity-100', show);
    }

    function populateContainer(data) {
        portofolio.idPortofolio.innerHTML = data.idPortofolio;
        portofolio.nama.innerHTML = data.nama;
        portofolio.tempat.innerHTML = data.tempat;
        portofolio.tanggal.innerHTML = data.tanggal;
        portofolio.bobot.innerHTML = data.bobot;
        portofolio.jalur.innerHTML = data.jalur.toUpperCase();
        portofolio.sertifikat.src = data.sertifikat;
    }

    document.querySelectorAll('.showDeskripsi').forEach(button => {
        button.addEventListener('click', () => {
            const row = button.closest('.portofolioRow');
            const data = {
                idPortofolio: row.getAttribute('data-id-portofolio'),
                nama: row.getAttribute('data-nama'),    
                tanggal: row.getAttribute('data-tanggal'),    
                tempat: row.getAttribute('data-tempat'),    
                bobot: row.getAttribute('data-bobot'),    
                jalur: row.getAttribute('data-jalur'),    
                sertifikat: row.getAttribute('data-sertifikat'),    
            };

            populateContainer(data);
            toggleContainer(true);
        });
    });

    closeDeskripsi.addEventListener('click', () => toggleContainer(false));

    deskripsiContainer.addEventListener('click', (e) => {
        if (e.target === deskripsiContainer) {
            toggleContainer(false);
        }
    });
});