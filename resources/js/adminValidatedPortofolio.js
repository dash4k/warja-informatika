document.querySelectorAll('.portofolioRow .showPortofolio').forEach(button => {
    button.addEventListener('click', (e) => {
        const row = e.currentTarget.closest('.portofolioRow');
        const mahasiswaId = row.dataset.id;
        const portfolios = window.portofolios[mahasiswaId] || [];
        
        const nim = document.getElementById('nim');

        const tbody = document.getElementById('portofolioList');
        tbody.innerHTML = ''; // clear previous content

        portfolios.forEach(p => {
            nim.innerHTML = `${p.nim ?? '-'}`;
            const tr = document.createElement('tr');
            tr.className = 'text-sm';

            tr.innerHTML = `
                <td class="border px-1 py-1">${p.nama ?? '-'}</td>
                <td class="border px-1 py-1">${p.tanggal ?? '-'}</td>
                <td class="border px-1 py-1">${p.tempat ?? '-'}</td>
                <td class="border px-1 py-1">${p.bobot ?? '-'}</td>
                <td class="border px-1 py-1">${String(p.jalur ?? '-').toUpperCase()}</td>
                <td class="border px-1 py-1">
                    <a href="${p.sertifikat_url ?? '#'}" target="_blank" class="text-darkBlue hover:text-lightBlue hover:cursor-pointer transition-all duration-100" title="Sertifikat">
                        <i class="fa-solid fa-link"></i>
                    </a>
                </td>
            `;

            tbody.appendChild(tr);
        });

        // Show modal
        const modal = document.getElementById('portofolioContainer');
        modal.classList.remove('opacity-0', 'pointer-events-none');
    });
});

document.getElementById('closePortofolio').addEventListener('click', () => {
    const modal = document.getElementById('portofolioContainer');
    modal.classList.add('opacity-0', 'pointer-events-none');
});

document.getElementById('portofolioContainer').addEventListener('click', (e) => {
    if (e.target === e.currentTarget) {
        const modal = document.getElementById('portofolioContainer');
        modal.classList.add('opacity-0', 'pointer-events-none');
    }
});

console.log(window.portofolios);