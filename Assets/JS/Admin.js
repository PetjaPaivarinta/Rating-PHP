document.addEventListener('DOMContentLoaded', function() {
    fetch('admin_status.json')
        .then(response => response.json())
        .then(data => {
            if (data.admin !== 'enabled') {
                window.location.href = 'login.php';
            }
        })
        .catch(error => {
            console.error('Error fetching admin status:', error);
            window.location.href = 'login.php';
        });
});