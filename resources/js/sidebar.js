document.addEventListener('DOMContentLoaded', () => {
    const hamburgerButton = document.getElementById('humburgerToggle');
    const sidebarEl = document.getElementById('sidebar');
    let toggled = false;

    hamburgerButton.addEventListener('click', () => {
        const isMobile = window.innerWidth < 1024;
        toggled = !toggled;

        if (isMobile) {
            sidebarEl.classList.toggle('hidden');
        } else {
            toggleSidebar(sidebarEl);
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

    function handleMouseEnter() {
        hoverSidebar(sidebarEl);
    }
    
    function handleMouseLeave() {
        hoverSidebar(sidebarEl);
    }

    function hoverSidebar(el) {
        const isCollapsed = el.classList.contains('lg:w-1/12');
    
        // Manually toggle classes based on state
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
    
        document.getElementById('logo-War').innerHTML = !isCollapsed ? "W" : "War";
        document.getElementById('logo-Ja').innerHTML = !isCollapsed ? "J" : "Ja";
    
        hamburgerButton.classList.toggle('lg:ml-[18%]', isCollapsed); 
        hamburgerButton.classList.toggle('lg:ml-[9%]', !isCollapsed);
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

        document.getElementById('logo-War').innerHTML = isCollapsed ? "W" : "War";
        document.getElementById('logo-Ja').innerHTML = isCollapsed ? "J" : "Ja";

        hamburgerButton.classList.toggle('lg:ml-[18%]', !isCollapsed); 
        hamburgerButton.classList.toggle('lg:ml-[9%]', isCollapsed);
    }
});
