document.addEventListener('DOMContentLoaded', function () {
    // Avatar menu toggle
    const avatarMenuButton = document.getElementById('avatar-menu-button');
    const avatarMenu = document.getElementById('avatar-menu');

    if(avatarMenuButton && avatarMenu) {
        avatarMenuButton.addEventListener('click', () => {
            avatarMenu.classList.toggle('hidden');
            avatarMenuButton.setAttribute('aria-expanded', avatarMenu.classList.contains('hidden') ? 'false' : 'true');
        });

        // Close avatar menu when clicking outside
        document.addEventListener('click', (event) => {
            if (!avatarMenuButton.contains(event.target) && !avatarMenu.contains(event.target)) {
                avatarMenu.classList.add('hidden');
                avatarMenuButton.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuCloseButton = document.getElementById('mobile-menu-close');

    // Open the mobile menu by sliding it in from the right
    mobileMenuButton.addEventListener('click', () => {
       //add class translate-x-0 to mobileMenu and remove translate-x-full
        mobileMenu.classList.remove('translate-x-full');
        mobileMenu.classList.add('translate-x-0');
    });

    // Close the mobile menu by sliding it out to the right
    mobileMenuCloseButton.addEventListener('click', () => {
        //add class translate-x-full to mobileMenu and remove translate-x-0
        mobileMenu.classList.remove('translate-x-0');
        mobileMenu.classList.add('translate-x-full');
    });
});
