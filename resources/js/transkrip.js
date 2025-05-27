import * as pdfjsLib from 'pdfjs-dist';

// Vite will copy this worker to /dist when bundling
pdfjsLib.GlobalWorkerOptions.workerSrc = '/node_modules/pdfjs-dist/build/pdf.worker.min.mjs';

document.addEventListener('DOMContentLoaded', () => {
    const transkripFile = document.getElementById('transkrip');
    const pdfContainer = document.getElementById('pdfContainer');

    transkripFile.addEventListener('change', async (event) => {
        const file = event.target.files[0];
        if (!file || file.type !== 'application/pdf') return;

        const fileReader = new FileReader();

        fileReader.onload = async function () {
            pdfContainer.innerHTML = ''; // Clear previous preview

            const typedarray = new Uint8Array(this.result);

            try {
                const pdf = await pdfjsLib.getDocument(typedarray).promise;
                console.log('PDF loaded with', pdf.numPages, 'pages');

                for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                    const page = await pdf.getPage(pageNum);
                    const viewport = page.getViewport({ scale: 1.2 });

                    const canvas = document.createElement('canvas');
                    canvas.style.marginBottom = '20px';
                    const context = canvas.getContext('2d');

                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    await page.render({ canvasContext: context, viewport }).promise;
                    pdfContainer.appendChild(canvas);
                }

                pdfContainer.classList.add("border-1 border-black")
            } catch (err) {
                console.error('PDF render error:', err);
            }
        };

        fileReader.readAsArrayBuffer(file);
    });
});
