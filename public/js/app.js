document.addEventListener('DOMContentLoaded', () => {
    const navDropdowns = document.querySelectorAll('.nav-item-dropdown');
    const profileTrigger = document.querySelector('.profile-trigger');
    const profileDropdownMenu = document.querySelector('.dropdown-menu');

    navDropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.nav-link-dropdown-toggle');
        const menu = dropdown.querySelector('.nav-dropdown-menu');
        if (toggle && menu) {
            toggle.addEventListener('click', event => {
                event.preventDefault();
                event.stopPropagation();
                closeAllNavDropdowns(menu);
                menu.classList.toggle('active');
                toggle.classList.toggle('dropdown-active');
            });
        }
    });

    if (profileTrigger && profileDropdownMenu) {
        profileTrigger.addEventListener('click', event => {
            event.stopPropagation();
            closeAllNavDropdowns();
            profileDropdownMenu.classList.toggle('active');
        });
    }

    function closeAllNavDropdowns(exceptMenu = null) {
        document.querySelectorAll('.nav-dropdown-menu.active').forEach(openMenu => {
            if (openMenu !== exceptMenu) {
                openMenu.classList.remove('active');
                const toggle = openMenu.previousElementSibling;
                if (toggle) {
                    toggle.classList.remove('dropdown-active');
                }
            }
        });
    }

    document.addEventListener('click', () => {
        closeAllNavDropdowns();
        if (profileDropdownMenu) {
            profileDropdownMenu.classList.remove('active');
        }
    });
});
