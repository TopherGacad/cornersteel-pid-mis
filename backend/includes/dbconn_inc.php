<?php

    //----------------------------------------------------------------------------//
    //                   DOCUMENT HANDLING DATABASE CONNECTION                    //
    //----------------------------------------------------------------------------//

    //--- VARIABLE DECLARATION FOR THE DATABASE CONNECTION ---//
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "csc-mis";

    //--- DATABASE CONNECTION FUNCTION ---//
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    //--- CHECKES IF THE CONNECTION IS SUCCESSFULL ---//
    if(!$conn){
        die("Connection Failed: " . mysqli_connect_error());
    }