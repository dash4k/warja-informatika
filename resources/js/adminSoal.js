import Chart from 'chart.js/auto';

function clearSoalForm() {
    const pertanyaan = document.getElementById('pertanyaan');
    if (pertanyaan) pertanyaan.value = '';

    const inputA = document.getElementById('a');
    if (inputA) inputA.value = '';
    const inputB = document.getElementById('b');
    if (inputB) inputB.value = '';
    const inputC = document.getElementById('c');
    if (inputC) inputC.value = '';
    const inputD = document.getElementById('d');
    if (inputD) inputD.value = '';

    const jawaban = document.getElementById('jawaban');
    if (jawaban) jawaban.value = 'A';

    const pertanyaanErrorMessage = document.getElementById('pertanyaanErrorMessage');
    if (pertanyaanErrorMessage) pertanyaanErrorMessage.textContent = '';
    const aErrorMessage = document.getElementById('aErrorMessage');
    if (aErrorMessage) aErrorMessage.textContent = '';
    const bErrorMessage = document.getElementById('bErrorMessage');
    if (bErrorMessage) bErrorMessage.textContent = '';
    const cErrorMessage = document.getElementById('cErrorMessage');
    if (cErrorMessage) cErrorMessage.textContent = '';
    const dErrorMessage = document.getElementById('dErrorMessage');
    if (dErrorMessage) dErrorMessage.textContent = '';

    console.log("Form fields explicitly cleared.");
}

function setSoalFormMode(mode, soalId = null) {
    const soalForm = document.getElementById('soalForm');
    if (!soalForm) {
        console.error("Error: soalForm element not found.");
        return;
    }

    const methodInputName = '_method';
    let hiddenMethodInput = soalForm.querySelector(`input[name="${methodInputName}"]`);

    if (mode === 'add') {
        soalForm.action = window.storeSoalUrl;
        soalForm.method = 'POST'; 

        // Remove hidden _method input if it exists
        if (hiddenMethodInput) {
            hiddenMethodInput.remove();
        }
        console.log("Form set to ADD mode. Action:", soalForm.action);

    } else if (mode === 'edit' && soalId) {
        soalForm.action = window.updateSoalUrl.replace('__id__', soalId); 
        soalForm.method = 'POST'; 

        if (!hiddenMethodInput) {
            hiddenMethodInput = document.createElement('input');
            hiddenMethodInput.type = 'hidden';
            hiddenMethodInput.name = methodInputName;
            soalForm.appendChild(hiddenMethodInput);
        }
        hiddenMethodInput.value = 'PUT';
        console.log("Form set to EDIT mode. Action:", soalForm.action, "Method:", hiddenMethodInput.value);

    } else {
        console.error("Invalid form mode or missing soalId for edit mode.");
    }
}


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

    const previewButtons = document.querySelectorAll('.showButton');
    const modal = document.getElementById('previewModal');
    const closeModal = document.getElementById('closeModal');
    const soalList = document.getElementById('soalList');
    const modalTitle = document.getElementById('modalTitle');

    previewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const jalur = row.dataset.jalur;
            const soalData = JSON.parse(row.dataset.soals || '[]');

            soalList.innerHTML = '';

            modalTitle.textContent = `Daftar Soal ${jalur}`;

            if (soalData.length > 0) {
                soalData.forEach((soal, index) => {
                    const li = document.createElement('li');
                    li.classList.add('mb-3', 'list-none');

                    const question = document.createElement('div');
                    question.classList.add('p-2', 'bg-gray-50', 'rounded', 'shadow-sm', 'question-item-card');

                    const questionText = document.createElement('p');
                    questionText.innerHTML = `<strong>Pertanyaan ${index + 1}:</strong> ${soal.pertanyaan}`;
                    questionText.classList.add('pb-4');

                    const pilihanList = document.createElement('ul');
                    pilihanList.classList.add('list-none', 'ml-4', 'text-sm');

                    if (soal.pilihan && typeof soal.pilihan === 'object') {
                        Object.entries(soal.pilihan).forEach(([key, value]) => {
                            const optItem = document.createElement('li');
                            optItem.textContent = `${key}. ${value}`;
                            pilihanList.appendChild(optItem);
                        });
                    }

                    const jawaban = document.createElement('p');
                    jawaban.innerHTML = `<div><strong>Jawaban:</strong> ${soal.jawaban}</div>`;
                    jawaban.classList.add('pt-4', 'flex', 'flex-row', 'justify-between', 'gap-2');

                    const actions = document.createElement('div');
                    actions.classList.add('flex', 'flex-row', 'justify-center', 'gap-1');

                    const deleteForm = document.createElement('form');
                    deleteForm.method = 'POST';

                    const soalId = soal.id;
                    const deleteUrlTemplate = row.dataset.deleteUrl;
                    deleteForm.action = deleteUrlTemplate.replace('__id__', soalId);
                    deleteForm.innerHTML = `
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="px-2 py-1 font-regular hover:cursor-pointer bg-red-600 text-white hover:bg-red-300 hover:text-black transition-all duration-100">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    `;

                    const editButton = document.createElement('button');
                    editButton.type = 'button';
                    editButton.classList.add('editButton', 'bg-yellow-300', 'text-black', 'hover:text-yellow-300', 'hover:bg-black', 'px-2', 'py-1', 'rounded', 'hover:cursor-pointer', 'transition-all', 'duration-100');
                    editButton.dataset.soalId = soal.id;
                    editButton.innerHTML = `<i class="fa-solid fa-pen-to-square"></i>`;

                    actions.appendChild(deleteForm);
                    actions.appendChild(editButton);
                    
                    question.appendChild(questionText);
                    question.appendChild(pilihanList);
                    question.appendChild(jawaban);
                    jawaban.appendChild(actions); 
                    
                    li.appendChild(question);
                    soalList.appendChild(li);
                });
            } else {
                const li = document.createElement('li');
                li.textContent = 'Belum ada soal untuk jalur ini.';
                soalList.appendChild(li);
            }

            modal.classList.remove('opacity-0');
            modal.classList.remove('pointer-events-none');
            modal.classList.add('opacity-100');
        });
    });

    closeModal.addEventListener('click', () => {
        modal.classList.add('opacity-0');
        modal.classList.add('pointer-events-none');
        modal.classList.remove('opacity-100');
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
            modal.classList.remove('opacity-100');
        }
    });

    // Form
    const formContainer = document.getElementById('formContainer');
    const soalForm = document.getElementById('soalForm');
    const cancelButton = document.getElementById('cancelButton');
    const addButton = document.getElementById('addButton');

    addButton.addEventListener('click', () => {
        clearSoalForm(); 
        setSoalFormMode('add');
        formContainer.classList.remove('opacity-0');
        formContainer.classList.remove('pointer-events-none');
        formContainer.classList.add('opacity-100');
        console.log("Add button clicked, showing formContainer.");
    });

    cancelButton.addEventListener('click', () => {
        formContainer.classList.add('opacity-0');
        formContainer.classList.add('pointer-events-none');
        formContainer.classList.remove('opacity-100');
        clearSoalForm(); 
        setSoalFormMode('add'); 
        console.log("Cancel button clicked, hiding formContainer.");
    });

    formContainer.addEventListener('click', (e) => {
        if (e.target === formContainer) {
            formContainer.classList.add('opacity-0');
            formContainer.classList.add('pointer-events-none');
            formContainer.classList.remove('opacity-100');
            clearSoalForm(); 
            setSoalFormMode('add'); 
            console.log("Clicked outside form, hiding formContainer.");
        }
    });

    setSoalFormMode('add');
});

document.addEventListener('click', (e) => {
    if (e.target.closest('.editButton')) {
        console.log("Edit button clicked!");

        clearSoalForm(); 

        const modal = document.getElementById('previewModal');
        modal.classList.add('opacity-0');
        modal.classList.add('pointer-events-none');
        modal.classList.remove('opacity-100');
        console.log("Preview modal hidden.");

        const editButton = e.target.closest('.editButton');
        const soalId = editButton.dataset.soalId;
        console.log("Soal ID:", soalId);
        
        setSoalFormMode('edit', soalId);

        const questionDiv = editButton.closest('.question-item-card'); 
        console.log("Found questionDiv:", questionDiv);

        if (!questionDiv) {
            console.error("Error: Could not find parent .question-item-card div for edit button. Stopping.");
            return; 
        }

        const questionTextElement = questionDiv.querySelector('p.pb-4');
        let pertanyaan = '';
        if (questionTextElement) {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = questionTextElement.innerHTML;
            const strongTag = tempDiv.querySelector('strong');
            if (strongTag) {
                strongTag.remove();
            }
            pertanyaan = tempDiv.textContent.trim(); 
        }
        console.log("Extracted Pertanyaan:", pertanyaan);

        const pilihanItems = questionDiv.querySelectorAll('ul li');
        const pilihan = {};
        pilihanItems.forEach(item => {
            const [key, ...valParts] = item.textContent.split('.');
            pilihan[key.trim()] = valParts.join('.').trim();
        });
        console.log("Extracted Pilihan:", pilihan);

        const jawabanContentDiv = questionDiv.querySelector('p.pt-4 > div'); 
        let jawabanText = '';
        if (jawabanContentDiv) {
            const tempAnsDiv = document.createElement('div');
            tempAnsDiv.innerHTML = jawabanContentDiv.innerHTML;
            const strongAnsTag = tempAnsDiv.querySelector('strong');
            if (strongAnsTag) {
                strongAnsTag.remove();
            }
            jawabanText = tempAnsDiv.textContent.trim();
        }
        console.log("Extracted Jawaban:", jawabanText);

        const inputPertanyaan = document.getElementById('pertanyaan');
        if (inputPertanyaan) inputPertanyaan.value = pertanyaan;
        
        const inputA = document.getElementById('a');
        if (inputA) inputA.value = pilihan['A'] || '';

        const inputB = document.getElementById('b');
        if (inputB) inputB.value = pilihan['B'] || '';

        const inputC = document.getElementById('c');
        if (inputC) inputC.value = pilihan['C'] || '';

        const inputD = document.getElementById('d');
        if (inputD) inputD.value = pilihan['D'] || '';

        const selectJawaban = document.getElementById('jawaban');
        if (selectJawaban) selectJawaban.value = jawabanText;

        console.log("Form fields prefilled.");

        const formContainer = document.getElementById('formContainer');
        if (formContainer) {
            formContainer.classList.remove('opacity-0', 'pointer-events-none');
            formContainer.classList.add('opacity-100');
        } else {
            console.error("Error: formContainer element not found.");
        }
    }
});