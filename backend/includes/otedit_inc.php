<?php

    //----------------------------------------------------------------------------//
    //          DOCUMENT HANDLING ALL THE SCRIPT FOR THE OVERTIME (EDIT)          //
    //----------------------------------------------------------------------------//

    //--- CHECKS IF THE USER CLICKS THE 'overtime-update' NAMED BUTTON ---//
    if(isset($_POST['overtime-update'])){

        //--- VARIABLE DECLARATIONS BASED ON THE USER INPUT ---//
        $overtimeid = $_POST['id'];
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

        //--- FUNCTION CALLED FROM THE 'functions_inc.php' RESPONSIBLE FOR UPDATING DATA IN THE DATABASE ---//
        OvertimeEdit($conn, $overtimeid, $company, $department, $firstname, $middlename, $lastname, $position, $timefrom, $timeto, $tasks, $designation, $approved, $noted);

    }
    else{   
        //--- TAKES USER BACK TO THE MAIN PAGE 'overtime.php' WHENEVER UPDATING DATA FAILS ---//
        header("Location: ../../frontend/views/php/overtime.php?OTupdate=failed");
        exit();
    }

        
