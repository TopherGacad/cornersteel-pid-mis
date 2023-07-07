<?php

    //----------------------------------------------------------------------------//
    //         DOCUMENT HANDLING ALL THE SCRIPT FOR THE CHANGE SHIFT (ADD)        //
    //----------------------------------------------------------------------------//
    
    //--- CHECKS IF THE USER CLICKS THE 'shift-save' NAMED BUTTON ---//
    if(isset($_POST['shift-save'])){

        //--- VARIABLE DECLARATIONS BASED ON THE USER INPUT ---//
        $company = $_POST['shift_company'];
        $department = $_POST['shift_department'];
        $firstname = $_POST['shift_firstname'];
        $middlename = $_POST['shift_midname'];
        $lastname = $_POST['shift_lastname'];
        $date = $_POST['shift_date'];
        $origin = $_POST['shift_orig'];
        $new = $_POST['shift_new'];
        $reason = $_POST['shift_reason'];
        $approved = $_POST['shift_approvedBy'];
        $noted = $_POST['shift_noteBy'];

        //--- REQUIRES THE NECESSARY CODE/DOCUMENTS TO PROPERLY FUNCTION ---//
        require_once 'dbconn_inc.php';
        require_once 'functions_inc.php';

        //--- FUNCTION CALLED FROM THE 'functions_inc.php' RESPONSIBLE FOR THE DATA INSERTION TO THE DATABASE ---//
        ChangeShift($conn, $company, $department, $firstname, $middlename, $lastname, $origin, $new, $reason, $approved, $noted, $date);
    }
    else{
        //--- TAKES USER BACK TO THE MAIN PAGE 'main.php' WHENEVER DATA INSERTION FAILS ---//
        header("Location: ../../frontend/views/php/main.php?CSinsert=failed");
        exit();
    }
    
            