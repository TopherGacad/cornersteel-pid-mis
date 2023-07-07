<?php

    //----------------------------------------------------------------------------//
    //                  DOCUMENT HANDLING ALL THE SCRIPT LOGOUT                   //
    //----------------------------------------------------------------------------//

    //--- STARTS THE SESSION ---//
    session_start();

    //--- UNSETS THE VALUE OF SESSION ---//
    session_unset();

    //--- DESTROY THE SESSION ---//
    session_destroy();

    //--- LOGS THE USER OUT OF THE PAGE, DIRECTLY TO THE LOGIN PAGE ---//
    header("Location: ../../frontend/views/php/login.php?Logout=successful");