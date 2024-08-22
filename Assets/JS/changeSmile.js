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
        sadOut.src = "../RatingPHP_/Assets/Images/sadFill.png";
        angryOut.src = "../RatingPHP_/Assets/Images/angryOutline.png";
        jeffOut.src = "../RatingPHP_/Assets/Images/jeffOutline.png";
        updateChosen("Sad face");
    }
    function changeAngry() {
        angryOut.src = "../RatingPHP_/Assets/Images/angryFill.png";
        sadOut.src = "../RatingPHP_/Assets/Images/sadOutline.png";
        jeffOut.src = "../RatingPHP_/Assets/Images/jeffOutline.png";
        updateChosen("Angry face");
    }
    function changeJeff() {
        jeffOut.src = "../RatingPHP_/Assets/Images/jeffFill.png";
        angryOut.src = "../RatingPHP_/Assets/Images/angryOutline.png";
        sadOut.src = "../RatingPHP_/Assets/Images/sadOutline.png";
        updateChosen("Cool face");
    }

    sadOut.addEventListener("click", changeSad);
    angryOut.addEventListener("click", changeAngry);
    jeffOut.addEventListener("click", changeJeff);
});