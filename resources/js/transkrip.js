document.addEventListener('DOMContentLoaded', () => {
    const transkripFile = document.getElementById('transkrip'); // your <input type="file" id="transkrip">
    const pdfPreview = document.getElementById('pdfPreview');

    transkripFile.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (!file || file.type !== 'application/pdf')
        {
            pdfPreview.classList.add('hidden');
            return;
        } 

        const fileURL = URL.createObjectURL(file);

        pdfPreview.src = fileURL;
        pdfPreview.classList.remove('hidden'); // Show iframe
    });
});