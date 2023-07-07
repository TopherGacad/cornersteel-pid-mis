<?php

    //----------------------------------------------------------------------------//
    //            DOCUMENT HANDLING ALL THE SCRIPT FOR THE USER LOGIN             //
    //----------------------------------------------------------------------------//

    //--- CHECKS IF THE USER CLICKS THE 'login_submit' NAMED BUTTON ---//
    if(isset($_POST['login_submit'])){

        //--- VARIABLE DECLARATIONS BASED ON THE USER INPUT ---//
        $user = $_POST['login_user'];
        $password = $_POST['login_pass'];

        //--- REQUIRES THE NECESSARY CODE TO PROPERLY FUNCTION ---//
        require_once 'dbconn_inc.php';
        require_once 'functions_inc.php';
    
        //--- FUNCTION CALLED FROM THE 'functions_inc.php' RESPONSIBLE FOR USER LOGIN ---//
        UserLogin($conn, $user, $password);
    }
    else{
        //--- TAKES USER BACK TO THE LOGIN PAGE 'login.php' WHENEVER LOGIN FAILS ---//
        header("Location: ../../frontend/views/php/login.php?Login=failed");
        exit();
    }