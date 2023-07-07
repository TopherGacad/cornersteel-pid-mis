<?php

    //----------------------------------------------------------------------------//
    //           DOCUMENT HANDLING ALL THE  setTimeout(function() { alert SCRIPTS FOR THE POPUPS           //
    //----------------------------------------------------------------------------//


    //----------------------------------------------------------------//
    //---------------------- ALL THE ERROR URLS ----------------------//

    //--- GETS THE ERROR VALUE FROM URL UPON ENCOUNTERING AN ERROR ---//
    if(isset($_GET["error"])){

        //--- VALIDATES IF THE VALUE MATCHES THE CONDITION ---//
        if($_GET["error"] == "passwordUnmatch"){

            //--- ECHOS AN  setTimeout(function() { alert SCRIPT BASED ON THE ERROR VALUE ---//
            echo '<script>  setTimeout(function() { alert("Password doesn\'t match"); } , 0); </script>';
        }

        else if($_GET["error"] == "signstmtfailed"){
            echo '<script>  setTimeout(function() { alert("Sign-up statement failed"); } , 0); </script>';
        }

        else if($_GET["error"] == "invalidusername"){
            echo '<script>  setTimeout(function() { alert("Invalid Username"); } , 0); </script>';
        }

        else if($_GET["error"] == "useralreadyexist"){
            echo '<script>  setTimeout(function() { alert("User already exist"); } , 0); </script>';
        }

        else if($_GET["error"] == "incorrectpassword"){
            echo '<script>  setTimeout(function() { alert("Incorrect Password"); } , 0); </script>';
        }

        else if($_GET["error"] == "usernotfound"){
            echo '<script>  setTimeout(function() { alert("User not found"); } , 0); </script>';
        }

        else if($_GET["error"] == "otstatementfailed"){
            echo '<script>  setTimeout(function() { alert("Overtime statement failed"); } , 0); </script>';
        }

        else if($_GET["error"] == "csstatementfailed"){
            echo '<script>  setTimeout(function() { alert("Change shift statement failed"); } , 0); </script>';
        }

        else if($_GET["error"] == "obstatementfailed"){
            echo '<script>  setTimeout(function() { alert("Official business statement failed"); } , 0); </script>';
        }

        else if($_GET["error"] == "otupdatestmtfailed"){
            echo '<script>  setTimeout(function() { alert("Overtime update statement failed"); } , 0); </script>';
        }

        else if($_GET["error"] == "csupdatestmtfailed"){
            echo '<script>  setTimeout(function() { alert("Change shift update statement failed"); } , 0); </script>';
        }

        else if($_GET["error"] == "obupdatestmtfailed"){
            echo '<script>  setTimeout(function() { alert("Official business update statement failed"); } , 0); </script>';
        }

        else if($_GET["error"] == "norecordmodified"){
            echo '<script>  setTimeout(function() { alert("No modified record"); } , 0); </script>';
        }
    }

    //----------------------------------------------------------------//
    //------------- SUCCESS AND FAILURE URLS FOR SIGN UP -------------//

    if(isset($_GET['SignUp'])){

        if($_GET["SignUp"] == "successful"){
            echo '<script>  setTimeout(function() { alert("Signed-up Successfully"); } , 0); </script>';
        }

        else if($_GET["SignUp"] == "failed"){
            echo '<script>  setTimeout(function() { alert("Sign-up Failed"); } , 0); </script>';
        }

    }

    //----------------------------------------------------------------//
    //-------------- SUCCESS AND FAILURE URLS FOR LOGIN --------------//
    
    if(isset($_GET['Login'])){

        if($_GET["Login"] == "successful"){
            echo '<script>  setTimeout(function() { alert("Logged-in Successfully"); } , 0); </script>';
        }

        else if($_GET["Login"] == "failed"){
            echo '<script>  setTimeout(function() { alert("Log-in Failed"); } , 0); </script>';
        }

    }

    //----------------------------------------------------------------//
    //-------- SUCCESS AND FAILURE URLS FOR OVERTIME (INSERT) --------//

    if(isset($_GET['OTinsert'])){

        if($_GET["OTinsert"] == "successful"){
            echo '<script>  setTimeout(function() { alert("Overtime filed Successfully"); } , 0); </script>';
        }

        else if($_GET["OTinsert"] == "failed"){
            echo '<script>  setTimeout(function() { alert("Overtime filing Failed"); } , 0); </script>';
        }

    }

    //----------------------------------------------------------------//
    //------ SUCCESS AND FAILURE URLS FOR CHANGE SHIFT (INSERT) ------//

    if(isset($_GET['CSinsert'])){

        if($_GET["CSinsert"] == "successful"){
            echo '<script>  setTimeout(function() { alert("Change shift filed Successfully"); } , 0); </script>';
        }

        else if($_GET["CSinsert"] == "failed"){
            echo '<script>  setTimeout(function() { alert("Change shift filing Failed"); } , 0); </script>';
        }

    }

    //----------------------------------------------------------------//
    //-------- SUCCESS AND FAILURE URLS FOR OFFICIAL BUSINESS (INSERT) --------//

    if(isset($_GET['OBinsert'])){

        if($_GET["OBinsert"] == "successful"){
            echo '<script>  setTimeout(function() { alert("Official business filed Successfully"); } , 0); </script>';
        }

        else if($_GET["OBinsert"] == "failed"){
            echo '<script>  setTimeout(function() { alert("Official business filing Failed"); } , 0); </script>';
        }

    }

    //----------------------------------------------------------------//
    //-------- SUCCESS AND FAILURE URLS FOR OVERTIME (UPDATE) --------//

    if(isset($_GET['OTupdate'])){

        if($_GET["OTupdate"] == "successful"){
            echo '<script>  setTimeout(function() { alert("Overtime updated Successfully"); } , 0); </script>';
        }

        else if($_GET["OTupdate"] == "failed"){
            echo '<script>  setTimeout(function() { alert("Overtime update Failed"); } , 0); </script>';
        }

    }

    //----------------------------------------------------------------//
    //------ SUCCESS AND FAILURE URLS FOR CHANGE SHIFT (UPDATE) ------//

    if(isset($_GET['CSupdate'])){

        if($_GET["CSupdate"] == "successful"){
            echo '<script>  setTimeout(function() { alert("Change shift updated Successfully"); } , 0); </script>';
        }

        else if($_GET["CSupdate"] == "failed"){
            echo '<script>  setTimeout(function() { alert("Change shift update Failed"); } , 0); </script>';
        }

    }

    //----------------------------------------------------------------//
    //--- SUCCESS AND FAILURE URLS FOR OFFICIAL BUSINESS (UPDATE) ----//

    if(isset($_GET['OBupdate'])){

        if($_GET["OBupdate"] == "successful"){
            echo '<script>  setTimeout(function() { alert("Official business updated Successfully"); } , 0); </script>';
        }

        else if($_GET["OBupdate"] == "failed"){
            echo '<script>  setTimeout(function() { alert("Official business update Failed"); } , 0); </script>';
        }

    }

    //----------------------------------------------------------------//
    //--------- SUCCESS AND FAILURE URLS FOR RECORD DELETION ---------//

    if(isset($_GET['deletion'])){

        if($_GET["deletion"] == "successful"){
            echo '<script>  setTimeout(function() { alert("Record successfully deleted"); } , 0); </script>';
        }

        else if($_GET["deletion"] == "failed"){
            echo '<script>  setTimeout(function() { alert("Record deletion failed"); } , 0); </script>';
        }

    }

    //----------------------------------------------------------------//
    //--------- SUCCESS AND FAILURE URLS FOR RECORD DELETION ---------//

    if(isset($_GET['Logout'])){

        if($_GET["Logout"] == "successful"){
            echo '<script>  setTimeout(function() { alert("Logged out successfully"); } , 0); </script>';
        }

        else if($_GET["Logout"] == "failed"){
            echo '<script>  setTimeout(function() { alert("Logging out failed"); } , 0); </script>';
        }

    }

    //----------------------------------------------------------------//


