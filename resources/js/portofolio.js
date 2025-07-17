document.addEventListener('DOMContentLoaded', () => {
    const addButton = document.getElementById('addButton');
    const cancelButton = document.getElementById('cancelButton');

    const formContainer = document.getElementById('formContainer');
    const portofolioForm = document.getElementById('portofolioForm');

    const inputs = {
        nama: document.getElementById('namaKegiatan'),
        bobot: document.getElementById('bobot'),
        jalur: document.getElementById('jalur'),
        mulai: document.getElementById('tanggalMulai'),
        berakhir: document.getElementById('tanggalBerakhir'),
        tempat: document.getElementById('tempatKegiatan'),
    };
    
    function toggleForm(show = true) {
        formContainer.classList.toggle('opacity-0', !show);
        formContainer.classList.toggle('pointer-events-none', !show);
        formContainer.classList.toggle('opacity-100', show);
    }

    function resetFormAction() {
        const defaultAction = portofolioForm.dataset.defaultAction;
        portofolioForm.action = defaultAction;

        const method = portofolioForm.querySelector('input[name="_method"]');
        if (method) method.remove();
    }

    function setFormActionForEdit(id) {
        portofolioForm.action = `/portofolio/${id}`;
        portofolioForm.method = "POST";
        
        const existingMethodInput = portofolioForm.querySelector('input[name="_method"]');
        if (existingMethodInput) {
            existingMethodInput.remove();
        }

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        portofolioForm.appendChild(methodInput);
    }

    function populateForm(data) {
        inputs.nama.value = data.nama;
        inputs.bobot.value = data.bobot;
        inputs.bobot.jalur = data.jalur;
        inputs.mulai.value = data.mulai;
        inputs.berakhir.value = data.berakhir;
        inputs.tempat.value = data.tempat;
    }

    addButton.addEventListener('click', () => {
        portofolioForm.reset();
        resetFormAction();
        toggleForm(true);
    });

    cancelButton.addEventListener('click', () => toggleForm(false));

    document.querySelectorAll('.editButton').forEach(button => {
        button.addEventListener('click', () => {
            const row = button.closest('.portofolioRow');
            const data = {
                id: row.dataset.id,
                nama: row.dataset.nama,
                bobot: row.dataset.bobot,
                jalur: row.dataset.jalur,
                mulai: row.dataset.mulai,
                berakhir: row.dataset.berakhir,
                tempat: row.dataset.tempat,
            };
            populateForm(data);
            setFormActionForEdit(data.id);
            toggleForm(true);
        });
    });

    formContainer.addEventListener('click', (e) => {
        if (e.target === formContainer) {
            toggleForm(false);
        }
    })
});