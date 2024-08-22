document.addEventListener('DOMContentLoaded', function() {
    const toggleSwitch = document.getElementById('toggleSwitch');
    toggleSwitch.addEventListener('change', function() {
        if (toggleSwitch.checked) {
            document.body.classList.add('dark-mode');
            localStorage.setItem('dark-mode', 'enabled');
        } else {
            document.body.classList.remove('dark-mode');
            localStorage.setItem('dark-mode', null);
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    let currentTheme = localStorage.getItem('dark-mode');
    if (currentTheme === 'enabled') {
        document.body.classList.add('dark-mode');
        document.getElementById('toggleSwitch').checked = true;
    }
});
