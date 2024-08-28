<?php
    function disableAdmin() {
        $adminDisabled = ['admin' => 'disabled'];
        file_put_contents('admin_status.json', json_encode($adminDisabled));
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <h1 id="rate" class="loginH1">Login</h1>
    </div>
    
    <a href="login.php" class="logout">Logout</a>

    
        <div id="formBox">
            <form name="f1" method="POST">
                <select id="mySelect" name="userType" required>
                    <option id="selPlac" value="" selected disabled>Select user type</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                    <input id="password" type="password" name="password" placeholder="Password">
                    <input id="login" type="submit" name="submit1" value="Login">
            </form>
            <p id="timeout"></p>
        </div>

        <?php
            ob_start();
            include 'db.php';

            session_start();

            if (!isset($_SESSION['counter'])) {
                $_SESSION['counter'] = 3; // Set initial attempts
            }

            if (!isset($_SESSION['timeout'])) {
                $_SESSION['timeout'] = 0; // Set initial timeout
            }

            if (time() < $_SESSION['timeout']) {
                echo "<script>alert('Please wait before trying again.')</script>";
                exit();
            }

            if (isset($_POST['submit1'])) {
                $userType = $_POST['userType'];
                $password = $_POST['password'];
                $hashedPassword = sha1($password);

                if ($userType == 'user') {
                    header("Location: user.php");
                    exit();
                } else {
                    $query = "SELECT * FROM users WHERE password = '$hashedPassword'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $_SESSION['userType'] = $userType;  

                         // Write admin status to JSON file
                        $adminStatus = ['admin' => 'enabled'];
                        file_put_contents('admin_status.json', json_encode($adminStatus));

                        echo "<script>alert('Login successful')</script>";
                        echo "<script>
                                    window.location.href = 'admin.php';
                            </script>";
                    } else {
                            echo "<script>alert('Too many failed attempts. Please try again in a minute')</script>";
                    }
                }
            }
        ?>
    <script src="../Rating-PHP/Assets/JS/showLogin.js"></script>
    <script src="../Rating-PHP/Assets/JS/checkDark.js"></script>
</body>