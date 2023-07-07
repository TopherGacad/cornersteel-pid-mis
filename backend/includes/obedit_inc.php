<?php

    //----------------------------------------------------------------------------//
    //      DOCUMENT HANDLING ALL THE SCRIPT FOR THE OFFICIAL BUSINESS (EDIT)     //
    //----------------------------------------------------------------------------//

    if(isset($_POST['offbusiness-update'])){

        $offid = $_POST['id'];
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

        require_once 'dbconn_inc.php';
        require_once 'functions_inc.php';

        OfficialBusinessEdit($conn, $offid, $company, $department, $firstname, $middlename, $lastname, $date, $client, $status, $reason, $noted);
    }
    else{
        header("Location: ../../frontend/views/php/main.php?OBupdate=failed");
        exit();
    }