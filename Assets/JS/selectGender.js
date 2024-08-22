document.addEventListener("DOMContentLoaded", function() {
    let male = document.getElementById('male');
    let female = document.getElementById('female');
    let chosenGender = 0;

    function updateGender(value) {
        chosenGender = value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "user.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send("chosenGender=" + chosenGender);
    }

    male.addEventListener('click', function() {
        male.style.opacity = '1';
        male.style.color = 'red';
        female.style.opacity = '0.1';
        updateGender("Male");
    });

    female.addEventListener('click', function() {
        female.style.opacity = '1';
        female.style.color = 'red';
        male.style.opacity = '0.1';
        updateGender("Female");
    });
});