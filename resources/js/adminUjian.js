import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', () => {
    const addButton = document.getElementById('addButton');
    const cancelButton = document.getElementById('cancelButton');

    const formContainer = document.getElementById('formContainer');
    const ujianForm = document.getElementById('ujianForm');

    const editMahasiswaContainer = document.getElementById('editMahasiswaContainer');
    const editMahasiswaForm = document.getElementById('editMahasiswa');
    const ujianMahasiswaData = JSON.parse(editMahasiswaForm.dataset.ujianMahasiswa);

    const inputs = {
        title: document.getElementById('title'),
        deskripsi: document.getElementById('deskripsi'),
        tanggalMulai: document.getElementById('tanggalMulai'),
        waktuMulai: document.getElementById('waktuMulai'),
        durasiUjian: document.getElementById('durasiUjian'),
    };
    
    function toggleForm(show = true) {
        formContainer.classList.toggle('opacity-0', !show);
        formContainer.classList.toggle('pointer-events-none', !show);
        formContainer.classList.toggle('opacity-100', show);
    }

    function resetFormAction() {
        const defaultAction = ujianForm.dataset.defaultAction;
        ujianForm.action = defaultAction;

        const method = ujianForm.querySelector('input[name="_method"]');
        if (method) method.remove();

        editMahasiswaContainer.classList.add('hidden')
    }

    function setFormActionForEdit(id) {
        ujianForm.action = `/admin/ujian/${id}`;
        ujianForm.method = "POST";
        
        const existingMethodInput = ujianForm.querySelector('input[name="_method"]');
        if (existingMethodInput) {
            existingMethodInput.remove();
        }

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        ujianForm.appendChild(methodInput);
    }

    function populateForm(data) {
        inputs.title.value = data.title;
        inputs.deskripsi.value = data.deskripsi;
        inputs.tanggalMulai.value = data.tanggalMulai;
        inputs.waktuMulai.value = data.waktuMulai;
        inputs.durasiUjian.value = data.durasiUjian;
    }

    function populateEditMahasiswa(ujianId) {
        editMahasiswaContainer.classList.remove('hidden');

        editMahasiswaForm.innerHTML = '';
        const mahasiswaList = ujianMahasiswaData[ujianId] || [];

        if (mahasiswaList.length === 0) {
            editMahasiswaForm.innerHTML = 'Tidak ada mahasiswa yang mengikuti ujian';
        }
        else {
            mahasiswaList.forEach((item) => {
                const wrapper = document.createElement('div');
                wrapper.classList.add('flex', 'items-center', 'justify-between', 'mb-1', 'gap-2');
    
                const label = document.createElement('span');
                label.textContent = `${item.mahasiswa.nama} (${item.nim})`;
    
                const form = document.createElement('form');
                form.action = `/admin/ujianMahasiswa/${item.id}`;
                form.method = 'POST';
    
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = document.querySelector('input[name="_token"]').value;
    
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
    
                const submitButton = document.createElement('button');
                submitButton.type = 'submit';
                submitButton.classList.add('deleteMahasiswaButton', 'bg-red-300', 'hover:bg-red-200', 'px-2', 'py-1', 'rounded', 'text-xs', 'hover:cursor-pointer');
                submitButton.title = 'Hapus Mahasiswa';
                submitButton.innerHTML = '<i class="fa-solid fa-eraser"></i>';
    
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
    
                    Swal.fire({
                        title: 'Proceed Deletion?',
                        text: 'Mahasiswa ini akan dihapus dari ujian.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
    
                form.appendChild(csrfInput);
                form.appendChild(methodInput);
                form.appendChild(submitButton);
    
                wrapper.appendChild(label);
                wrapper.appendChild(form);
    
                editMahasiswaForm.appendChild(wrapper);
            });
        }
    }

    addButton.addEventListener('click', () => {
        ujianForm.reset();
        resetFormAction();
        toggleForm(true);
    });

    cancelButton.addEventListener('click', () => toggleForm(false));

    formContainer.addEventListener('click', (e) => {
        if (e.target === formContainer) {
            toggleForm(false);
        }
    });

    const editButtons = document.querySelectorAll('.editButton');

    editButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const row = button.closest('.ujianRow');
            const data = {
                id: row.dataset.id,
                title: row.dataset.title,
                deskripsi: row.dataset.deskripsi,
                tanggalMulai: row.dataset['tanggalMulai'],
                waktuMulai: row.dataset['waktuMulai'],
                durasiUjian: row.dataset['durasiUjian'],
            };

            populateForm(data);
            setFormActionForEdit(data.id);
            populateEditMahasiswa(data.id);
            toggleForm(true);
        });
    });

    document.querySelectorAll('.deleteUjianButton').forEach((button) => {
        const ujianDeleteForm = button.closest('form');

        ujianDeleteForm.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Hapus ujian ini?',
                text: 'Seluruh data ujian akan dihapus permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    ujianDeleteForm.submit();
                }
            });
        });
    });
});