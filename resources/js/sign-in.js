document.addEventListener('DOMContentLoaded', function () {
    const signinTab = document.getElementById('signin-tab');
    const registerTab = document.getElementById('register-tab');
    const signinForm = document.getElementById('signin-form');
    const registerForm = document.getElementById('register-form');

    const toggleTabs = (isRegister) => {
        if (isRegister) {
            registerTab.classList.add('bg-primary-softwhite', 'text-primary-sage');
            registerTab.classList.remove('bg-white', 'text-primary-lightgray');
            signinTab.classList.add('bg-white', 'text-primary-lightgray');
            signinTab.classList.remove('bg-primary-softwhite', 'text-primary-sage');
            registerForm.classList.remove('hidden');
            signinForm.classList.add('hidden');
            window.location.hash = '#register-form';  // Set hash
        } else {
            signinTab.classList.add('bg-primary-softwhite', 'text-primary-sage');
            signinTab.classList.remove('bg-white', 'text-primary-lightgray');
            registerTab.classList.add('bg-white', 'text-primary-lightgray');
            registerTab.classList.remove('bg-primary-softwhite', 'text-primary-sage');
            signinForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
            window.location.hash = '';  // Clear hash
        }
    };

    // Initially check the URL hash and show the appropriate form
    if (window.location.hash === '#register-form') {
        toggleTabs(true);
    } else {
        toggleTabs(false);
    }

    // Event listeners for tab switching
    signinTab.addEventListener('click', () => toggleTabs(false));
    registerTab.addEventListener('click', () => toggleTabs(true));
});
