<?php

    //----------------------------------------------------------------------------//
    //      DOCUMENT HANDLING ALL THE SCRIPT FOR THE OFFICIAL BUSINESS (ADD)      //
    //----------------------------------------------------------------------------//

    //--- CHECKS IF THE USER CLICKS THE 'offbusiness-save' NAMED BUTTON ---//
    if(isset($_POST['offbusiness-save'])){

        //--- VARIABLE DECLARATIONS BASED ON THE USER INPUT ---//
        $company = $_POST['ob_company'];
        $department = $_POST['ob_department'];
        $firstname = $_POST['ob_firstname'];
        $middlename = $_POST['ob_midname'];
        $lastname = $_POST['ob_lastname'];
        $date = $_POST['ob_date'];
        $client = $_POST['ob_client'];
        $status = $_POST['ob_status'];
        $reason = $_POST['ob_reason'];
        $noted = $_POST['ob_noteBy'];

        //--- REQUIRES THE NECESSARY CODE/DOCUMENTS TO PROPERLY FUNCTION ---//
        require_once 'dbconn_inc.php';
        require_once 'functions_inc.php';

        //--- FUNCTION CALLED FROM THE 'functions_inc.php' RESPONSIBLE FOR THE DATA INSERTION TO THE DATABASE ---//
        OfficialBusiness($conn, $company, $department, $firstname, $middlename, $lastname, $date, $client, $status, $reason, $noted);
        
    }
    else{
        //--- TAKES USER BACK TO THE MAIN PAGE 'main.php' WHENEVER DATA INSERTION FAILS ---//
        header("Location: ../../frontend/views/php/main.php?OBinsert=failed");
        exit();
    }
    
            