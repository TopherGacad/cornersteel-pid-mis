<?php

    //----------------------------------------------------------------------------//
    //           DOCUMENT HANDLING ALL THE SCRIPT FOR THE EMPLOYEES (ADD)         //
    //----------------------------------------------------------------------------//
    
    //--- CHECKS IF THE USER CLICKS THE 'shift-save' NAMED BUTTON ---//
    if(isset($_POST['emp-save'])){

        //--- VARIABLE DECLARATIONS BASED ON THE USER INPUT ---//
        $company = $_POST['employ_company'];
        $department = $_POST['employ_department'];
        $firstname = $_POST['employ_firstname'];
        $middlename = $_POST['employ_midname'];
        $lastname = $_POST['employ_lastname'];
        $age = $_POST['employ_age'];
        $phone = $_POST['employ_mobile'];
        $position = $_POST['employ_position'];
        $email = $_POST['employ_email'];
        $sex = $_POST['employ_sex'];

        //--- REQUIRES THE NECESSARY CODE/DOCUMENTS TO PROPERLY FUNCTION ---//
        require_once 'dbconn_inc.php';
        require_once 'functions_inc.php';

        //--- FUNCTION CALLED FROM THE 'functions_inc.php' RESPONSIBLE FOR THE DATA INSERTION TO THE DATABASE ---//
        AddEmployee($conn, $company, $department, $firstname, $middlename, $lastname, $age, $phone, $position, $email, $sex);
    }
    else{
        //--- TAKES USER BACK TO THE MAIN PAGE 'main.php' WHENEVER DATA INSERTION FAILS ---//
        header("Location: ../../frontend/views/php/main.php?Empinsert=failed");
        exit();
    }
    
            