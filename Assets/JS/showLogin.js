
let userTypeSelect = document.getElementById('mySelect');
userTypeSelect.addEventListener('change', function() {
    if (this.value === 'admin') {
        showPassword();
    } else if (this.value === 'user') {
        showLogin();
    }
});

function showPassword() {
    let password = document.getElementById('password');
    password.style.display = 'inline';

    let loginBox = document.getElementById('login'); 
    loginBox.style.display = 'inline';

    let select = document.getElementById('selPlac');
    select.style.display = 'none';
}

function showLogin() {
    let password = document.getElementById('password');
    password.style.display = 'none';

    let loginBox = document.getElementById('login'); 
    loginBox.style.display = 'inline';

    let select = document.getElementById('selPlac');
    select.style.display = 'none';
}