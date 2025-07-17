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

    const profile = document.getElementById('profile');
    const profileContainer = document.getElementById('profileContainer');
    const closeProfile = document.getElementById('closeProfile');

    function toggleContainer(show=true) {
        profileContainer.classList.toggle('opacity-0', !show);
        profileContainer.classList.toggle('pointer-events-none', !show);
        profileContainer.classList.toggle('opacity-100', show);
    }

    document.querySelectorAll('.showProfile').forEach(button => {
        button.addEventListener('click', () => {
            const row = button.closest('.biodataRow');
            const src = row.getAttribute('data-profile');

            profile.src = src;
            toggleContainer(true);
        })
    })

    closeProfile.addEventListener('click', () => toggleContainer(false));

    profileContainer.addEventListener('click', (e) => {
        if (e.target === closeProfile || e.target === profileContainer) {
            toggleContainer(false);
        }
    });
});