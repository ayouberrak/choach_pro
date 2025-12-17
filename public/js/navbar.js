        const profileBtn = document.getElementById('profileDropdown');
        const menu = document.getElementById('menuContent');

        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            menu.classList.toggle('active');
        });

        window.addEventListener('click', () => {
            menu.classList.remove('active');
        });