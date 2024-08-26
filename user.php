<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log("POST request received");
    if (isset($_POST['chosen'])) {
        $chosen = $_POST['chosen'];
        $_SESSION['chosen'] = $chosen;
        echo "Chosen value updated to: " . $chosen;
        exit;
    } elseif (isset($_POST['chosenGender'])) {
        $chosenGender = $_POST['chosenGender'];
        $_SESSION['chosenGender'] = $chosenGender;
        echo "Chosen gender updated to: " . $chosenGender;
        exit;
    } else {
        error_log("POST data not set correctly");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Test</title>
        <link rel="stylesheet" type="text/css" href="../Rating-PHP/Assets/main.css">
        <link rel="stylesheet" type="text/css" href="../Rating-PHP/Assets/toggle.css">
    </head>
    <body>

        <!-- toggle switch -->
        <label class="switch">
            <input type="checkbox" id="toggleSwitch">
            <span class="slider round"></span>
        </label>

        <div id="rateBox" class="loginBox">
        <h1 id="rate" class="loginH1">Rate The Man</h1>
        </div>

        <a href="login.php" class="logout">Logout</a>

        <div class="genderSel">
            <div class="male">
                <h2 id="male">Male</h2>
            </div>
            <div class="female">
                <h2 id="female">Female</h2>
            </div>
        </div>

       
        <div class="emojis">
            <div class="emoji">
                <img id="sadOut" src="../Rating-PHP/Assets/Images/sadOutline.png" alt="emoji1">
            </div>
            <div class="emoji">
            <img  id="angryOut" src="../Rating-PHP/Assets/Images/angryOutline.png" alt="emoji1">
            </div>
            <div class="emoji">
                <img  id="jeffOut" src="../Rating-PHP/Assets/Images/jeffOutline.png" alt="emoji1">
            </div>
        </div>

        <form method="POST">
        <input id="submit" type="submit" name="submit" value="Submit">
        </form>

        <?php
              if (isset($_SESSION['chosen'])) {
                $chosen = $_SESSION['chosen'];
            } else {
                $chosen = "Not set";
            }

            if (isset($_SESSION['chosenGender'])) {
                $chosenGender = $_SESSION['chosenGender'];
            } else {
                $chosenGender = "Not set";
            }

            date_default_timezone_set('Europe/Helsinki');

            if (isset($_POST['submit'])) {   
            $file = fopen("../Rating-PHP/ratings.txt", "a") or die("Unable to open file!");
            
            $time = date("Y-m-d H:i:s");
            $txt =  $chosenGender . "," . $chosen . "," . $time . ",\n";
            fwrite($file, $txt);
            fclose($file);
            echo "<h1 id='filedata'>Data written to ratings.txt: " . " successfully!</h1>";
        }
        ?>
        <script src="../Rating-PHP/Assets/JS/checkDark.js"></script>
        <script src="../Rating-PHP/Assets/JS/changeSmile.js"></script>
        <script src="../Rating-PHP/Assets/JS/selectGender.js"></script>

    </body>