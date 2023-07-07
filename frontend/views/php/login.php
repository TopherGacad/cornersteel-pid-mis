<?php
    //--- START SESSION ---//
    session_start();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="../../public/css/login.css">
    <link rel="icon" href="../../public/assets/comfac-logo-transparent.png">
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/aa37050208.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "../../../backend/includes/popup_handlers_inc.php"?>
    
    <div class="login-page-container">
        
        <!-- PAGE HEADER -->
        <div class="head-container">
            <img class="main-logo" src="../../public/assets/comfac-logo.png" alt="comfac global group logo">
        </div>
        
        <!-- LOGIN FORM -->
        <div class="login-contain">
            <div class="login-header">
                <img class="form-logo" src="../../public/assets/comfac-logo.png"alt="">
                <p class="login-title">Sign in to HR-MIS Extension</p>
            </div>
    
            <form action="../../../backend/includes/login_inc.php" method="post">

                <!-- USERNAME FIELD -->
                <div class="fields email-field">
                    <label for="login-username">Username</label>
                    <input 
                        id="login-username" 
                        name="login_user"
                        type="text" 
                        placeholder="juan@example.com"
                        autofocus
                        required>
                </div>
                
                <!-- PASSWORD FIELD -->
                <div class="fields">
                    <label for="login-pass">Password</label>
                    <input
                        id="login-pass"
                        name="login_pass" 
                        type="password"
                        placeholder="8-16 characters only"
                        minlength="8"
                        maxlength="16"
                        required>
                </div>

                <!-- FORGOT PASSWORD LINK -->
                <div class="forgot-pass-container">
                    <div class="see-pass-container">
                        <input class="see-pass" type="checkbox" id="see-pass">
                        <label class="see-pass-label" for="see-pass">See password</label>
                    </div>
                    <a href="">Forgot password?</a>
                </div>
                
                <!-- BTN & LINK CONTAINER -->
                <div class="link-container">
                    <input class="Btn-login" type="submit" value="Sign in" name="login_submit">
                    <p>Don't have an account? <a href="../../views/php/signup.php">Register here.</a></p>
                </div>
            </form>
        </div>
    </div>
    
    <!-- LOGIN SCRIPT -->
    <script src="../../js/login.js"></script>
</body>
</html>