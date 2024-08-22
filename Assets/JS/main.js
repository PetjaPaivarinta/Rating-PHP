
let countdown = document.getElementById('countdown');
let timeStart = 30;
countdown.innerHTML = "You will be automatically redirected";
setInterval(function() {
    timeStart--;
    countdown.innerHTML = "Time left: " + timeStart;
    if (timeStart <= 0) {
        window.location.href = "login.php";
    }
}, 1000);
