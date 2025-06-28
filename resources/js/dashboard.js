document.addEventListener('DOMContentLoaded', () => {
    const pengumumanToggle = document.getElementById('togglePengumumanDashboard');
    const panduanToggle = document.getElementById('togglePanduanDashboard');
    const panduanContainer = document.getElementById('panduanContainer');

    // Pengumuman button event listener
    pengumumanToggle.addEventListener('click', () => {
        if (!pengumumanToggle.classList.contains('bg-white') && panduanToggle.classList.contains('bg-white')) {
            pengumumanToggle.classList.toggle('text-darkBlue');
            pengumumanToggle.classList.toggle('bg-white');
            panduanToggle.classList.toggle('text-darkBlue');
            panduanToggle.classList.toggle('bg-white');
            panduanContainer.classList.add('hidden');
        }
    });
    
    // Panduan button event listener
    panduanToggle.addEventListener('click', () => {
        if (pengumumanToggle.classList.contains('bg-white') && !panduanToggle.classList.contains('bg-white')) {
            pengumumanToggle.classList.toggle('text-darkBlue');
            pengumumanToggle.classList.toggle('bg-white');
            panduanToggle.classList.toggle('text-darkBlue');
            panduanToggle.classList.toggle('bg-white');
            panduanContainer.classList.remove('hidden');
        }
    });
});