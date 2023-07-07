<?php

    //----------------------------------------------------------------------------//
    //           DOCUMENT HANDLING ALL THE SCRIPT FOR THE OVERTIME (ADD)          //
    //----------------------------------------------------------------------------//

    //--- CHECKS IF THE USER CLICKS THE 'overtime-save' NAMED BUTTON ---//
    if(isset($_POST['overtime-save'])){

        //--- VARIABLE DECLARATIONS BASED ON THE USER INPUT ---//
        $company = $_POST['ot_company'];
        $department = $_POST['ot_department'];
        $firstname = $_POST['ot_firstname'];
        $middlename = $_POST['ot_midname'];
        $lastname = $_POST['ot_lastname'];
        $position = $_POST['ot_position'];
        $timefrom = $_POST['ot_timeFrom'];
        $timeto = $_POST['ot_timeTo'];
        $tasks = $_POST['ot_task'];
        $designation = $_POST['ot_designation'];
        $approved = $_POST['ot_approvedBy'];
        $noted = $_POST['ot_noteBy'];

        //--- REQUIRES THE NECESSARY CODE/DOCUMENTS TO PROPERLY FUNCTION ---//
        require_once 'dbconn_inc.php';
        require_once 'functions_inc.php';

        //--- FUNCTION CALLED FROM THE 'functions_inc.php' RESPONSIBLE FOR THE DATA INSERTION TO THE DATABASE ---//
        OvertimeFiling($conn, $company, $department, $firstname, $middlename, $lastname, $position, $timefrom, $timeto, $tasks, $designation, $approved, $noted);

    }
    else{
        //--- TAKES USER BACK TO THE MAIN PAGE 'main.php' WHENEVER DATA INSERTION FAILS ---//
        header("Location: ../../frontend/views/php/main.php?OTinsert=failed");
        exit();
    }

        
