document.addEventListener('DOMContentLoaded', () => {
    const settingsButton = document.getElementById('settingsToggle');
    const settingsMenu = document.getElementById('settingsMenu');
    const settingsButtonMobile = document.getElementById('settingsToggleMobile');
    const settingsMenuMobile = document.getElementById('settingsMenuMobile');

    const isMobile = window.innerWidth < 640;

    if (!isMobile) {
        settingsButton.addEventListener('click', (e) => {
            e.stopPropagation();
            settingsMenu.classList.toggle('hidden');
        });

        settingsMenu.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        document.body.addEventListener('click', () => {
            if (!settingsMenu.classList.contains('hidden')) {
                settingsMenu.classList.add('hidden');
            }
        });
    } else {
        settingsButtonMobile.addEventListener('click', (e) => {
            e.stopPropagation();
            settingsMenuMobile.classList.toggle('hidden');
        });

        settingsMenuMobile.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        document.body.addEventListener('click', () => {
            if (!settingsMenuMobile.classList.contains('hidden')) {
                settingsMenuMobile.add('hidden');
            }
        })
    }
});