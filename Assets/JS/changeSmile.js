document.addEventListener("DOMContentLoaded", function() {
    const sadOut = document.getElementById("sadOut");
    const angryOut = document.getElementById("angryOut");
    const jeffOut = document.getElementById("jeffOut");
    let chosen;

    function updateChosen(value) {
        chosen = value;
        // Send the chosen value to the PHP endpoint using AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "user.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
        };
        xhr.send("chosen=" + chosen);
    }

    function changeSad() {
        sadOut.src = "../Rating-PHP/Assets/Images/sadFill.png";
        angryOut.src = "../Rating-PHP/Assets/Images/angryOutline.png";
        jeffOut.src = "../Rating-PHP/Assets/Images/jeffOutline.png";
        updateChosen("Sad face");
    }
    function changeAngry() {
        angryOut.src = "../Rating-PHP/Assets/Images/angryFill.png";
        sadOut.src = "../Rating-PHP/Assets/Images/sadOutline.png";
        jeffOut.src = "../Rating-PHP/Assets/Images/jeffOutline.png";
        updateChosen("Angry face");
    }
    function changeJeff() {
        jeffOut.src = "../Rating-PHP/Assets/Images/jeffFill.png";
        angryOut.src = "../Rating-PHP/Assets/Images/angryOutline.png";
        sadOut.src = "../Rating-PHP/Assets/Images/sadOutline.png";
        updateChosen("Cool face");
    }

    sadOut.addEventListener("click", changeSad);
    angryOut.addEventListener("click", changeAngry);
    jeffOut.addEventListener("click", changeJeff);
});