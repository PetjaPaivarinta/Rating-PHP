let adminStatus = localStorage.getItem('admin');

console.log(adminStatus);

document.addEventListener('DOMContentLoaded', function() {
    if (adminStatus !== 'enabled') {
        window.location.href = 'login.php';
    }
});