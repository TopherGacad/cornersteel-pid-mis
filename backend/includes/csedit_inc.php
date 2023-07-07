<?php

    //----------------------------------------------------------------------------//
    //        DOCUMENT HANDLING ALL THE SCRIPT FOR THE CHANGE SHIFT (EDIT)        //
    //----------------------------------------------------------------------------//

    if(isset($_POST['shift-update'])){

        //--- VARIABLE DECLARATIONS BASED ON THE USER INPUT ---//
        $shiftid = $_POST['id'];
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

        require_once 'dbconn_inc.php';
        require_once 'functions_inc.php';

        ChangeShiftEdit($conn, $shiftid, $company, $department, $firstname, $middlename, $lastname, $origin, $new, $date, $reason, $approved, $noted);

    }
    else{
        header("Location: ../../frontend/views/php/main.php?CSupdate=failed");
        exit();
    }
