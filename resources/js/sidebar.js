document.addEventListener('DOMContentLoaded', () => {
    const hamburgerButton = document.getElementById('humburgerToggle');
    const resumeButton = document.getElementById('resumeButton');
    const resumeContainer = document.getElementById('resumeContainer');
    const validatedButton = document.getElementById('validatedButton');
    const validatedContainer = document.getElementById('validatedContainer');
    const unvalidatedButton = document.getElementById('unvalidatedButton');
    const unvalidatedContainer = document.getElementById('unvalidatedContainer');
    const sidebarEl = document.getElementById('sidebar');
    let toggled = false;

    // Resume section
    if (resumeButton && resumeContainer) {
        resumeButton.addEventListener('click', () => {
            const isCollapsed = sidebarEl.classList.contains('lg:w-1/12');
            if (!isCollapsed) {
                resumeContainer.classList.toggle('hidden');
            }
        });
    }

    // Validated section
    if (validatedButton && validatedContainer) {
        validatedButton.addEventListener('click', () => {
            const isCollapsed = sidebarEl.classList.contains('lg:w-1/12');
            if (!isCollapsed) {
                validatedContainer.classList.toggle('hidden');
            }
        });
    }

    // Unvalidated section
    if (unvalidatedButton && unvalidatedContainer) {
        unvalidatedButton.addEventListener('click', () => {
            const isCollapsed = sidebarEl.classList.contains('lg:w-1/12');
            if (!isCollapsed) {
                unvalidatedContainer.classList.toggle('hidden');
            }
        });
    }

    // Hamburger toggle
    if (hamburgerButton && sidebarEl) {
        hamburgerButton.addEventListener('click', () => {
            const isMobile = window.innerWidth < 1024;
            toggled = !toggled;

            if (isMobile) {
                sidebarEl.classList.toggle('hidden');
            } else {
                toggleSidebar(sidebarEl);
                if (resumeContainer) resumeContainer.classList.add('hidden');
                if (validatedContainer) validatedContainer.classList.add('hidden');
                if (unvalidatedContainer) unvalidatedContainer.classList.add('hidden');
            }

            if (!isMobile) {
                if (toggled) {
                    sidebarEl.addEventListener('mouseenter', handleMouseEnter);
                    sidebarEl.addEventListener('mouseleave', handleMouseLeave);
                } else {
                    sidebarEl.removeEventListener('mouseenter', handleMouseEnter);
                    sidebarEl.removeEventListener('mouseleave', handleMouseLeave);
                }
            }
        });
    }

    function handleMouseEnter() {
        hoverSidebar(sidebarEl);
    }

    function handleMouseLeave() {
        hoverSidebar(sidebarEl);
        if (resumeContainer) resumeContainer.classList.add('hidden');
        if (validatedContainer) validatedContainer.classList.add('hidden');
        if (unvalidatedContainer) unvalidatedContainer.classList.add('hidden');
    }

    function hoverSidebar(el) {
        const isCollapsed = el.classList.contains('lg:w-1/12');

        el.classList.toggle('lg:w-1/12', !isCollapsed);
        el.classList.toggle('lg:w-1/6', isCollapsed);

        setTimeout(() => {
            document.querySelectorAll('.sideBarMenuLabel').forEach(el => {
                el.classList.toggle('hidden', !isCollapsed);
            });
        }, 100);

        document.querySelectorAll('.sideBarMenuAnchor').forEach(el => {
            el.classList.toggle('justify-center', !isCollapsed);
        });

        const logoWar = document.getElementById('logo-War');
        const logoJa = document.getElementById('logo-Ja');

        if (logoWar && logoJa) {
            logoWar.innerHTML = !isCollapsed ? "W" : "War";
            logoJa.innerHTML = !isCollapsed ? "J" : "Ja";
        }

        if (hamburgerButton) {
            hamburgerButton.classList.toggle('lg:ml-[18%]', isCollapsed); 
            hamburgerButton.classList.toggle('lg:ml-[9%]', !isCollapsed);
        }
    }

    function toggleSidebar(el, forceCollapse = null) {
        const isCollapsed = forceCollapse !== null
            ? forceCollapse
            : el.classList.toggle('lg:w-1/12');

        el.classList.toggle('lg:w-1/12', isCollapsed);
        el.classList.toggle('lg:w-1/6', !isCollapsed);

        setTimeout(() => {
            document.querySelectorAll('.sideBarMenuLabel').forEach(el => {
                el.classList.toggle('hidden', isCollapsed);
            });
        }, 100);

        document.querySelectorAll('.mainMainContentDashboard').forEach(el => {
            el.classList.toggle('lg:w-7/9', !isCollapsed);
            el.classList.toggle('lg:ml-[20%]', !isCollapsed);
            el.classList.toggle('lg:w-8/9', isCollapsed);
            el.classList.toggle('lg:ml-[11%]', isCollapsed);
        });

        document.querySelectorAll('.sideBarMenuAnchor').forEach(el => {
            el.classList.toggle('justify-center', isCollapsed);
        });

        const logoWar = document.getElementById('logo-War');
        const logoJa = document.getElementById('logo-Ja');

        if (logoWar && logoJa) {
            logoWar.innerHTML = isCollapsed ? "W" : "War";
            logoJa.innerHTML = isCollapsed ? "J" : "Ja";
        }

        if (hamburgerButton) {
            hamburgerButton.classList.toggle('lg:ml-[18%]', !isCollapsed); 
            hamburgerButton.classList.toggle('lg:ml-[9%]', isCollapsed);
        }
    }
});