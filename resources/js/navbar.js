document.addEventListener('DOMContentLoaded', () => {
    const hamburgerButton = document.getElementById('hamburgerToggle');
    const hamburgerMenu = document.getElementById('hamburgerMenu');

    if (hamburgerButton && hamburgerMenu) {
        hamburgerButton.addEventListener('click', (e) => {
            e.stopPropagation();
            hamburgerMenu.classList.toggle('hidden');
        });

        hamburgerMenu.addEventListener('click', (e) => {
            e.stopPropagation;
        });

        document.body.addEventListener('click', () => {
            if (!hamburgerMenu.classList.contains('hidden')) {
                hamburgerMenu.classList.add('hidden');
            }
        });

        
    }
});