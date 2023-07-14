<?php

    //----------------------------------------------------------------------------//
    //           DOCUMENT HANDLING ALL THE PHP FUNCTIONS OF THE WEBSITE           //
    //----------------------------------------------------------------------------//

    //---------------CHECKS IF USER EXISTS IN DATABASE----------------//

        function ExistingUser($conn, $username, $email){

            //--- SELECT QUERY ---//
            $sql = "SELECT * from user_csc WHERE user_name = ? OR user_email = ?;";
            $stmt = mysqli_stmt_init($conn);

            //--- CHECKS IF THE VARIABLES '$sql' AND '$stmt' IF PREPARE STATEMENT IS SUCCESSFULL ---//
            if(!mysqli_stmt_prepare($stmt, $sql)){

                //--- TAKES USER BACK TO THE SIGNUP PAGE 'signup.php' WHENEVER PREPARE STATEMENT FAILS ---//
                header("Location: ../../frontend/views/php/signup.php?SignUpstmt=failed");
                exit();
            }

            //--- BINDS THE VARIABLE TO BE SELECTED USING BIND PARAMETER STATEMENT ---//
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);

            //--- EXECUTE STATEMENT ---//
            mysqli_stmt_execute($stmt);

            //--- ASSIGNING THE RETRIEVED RESULT TO A VARIABLE ---//
            $resultData = mysqli_stmt_get_result($stmt);

            //--- CHECKS IF THE VARIABLES FETCHED ANY ROW/DATA ---//
            if($row = mysqli_fetch_assoc($resultData)){

                //--- RETURNS THE ROW/DATA FETCHED ---//
                return $row;
            }
            else{

                //--- RETURNS FALSE ---//
                $result = false;    
                return $result;
            }

            mysqli_stmt_close($stmt);
        }

        //----------------------------------------------------------------//
        //-----------------------SIGN-UP FUNCTION-------------------------//

        function UserSignup($conn, $firstname, $lastname, $username, $email, $company, $department, $password){

            //--- INSERT QUERY ---//
            $sql = "INSERT INTO user_csc (user_firstname, user_lastname, user_name, user_email, user_company, user_dept, user_password) VALUES (?, ?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);

            //--- CHECKS IF THE VARIABLES '$sql' AND '$stmt' IF PREPARE STATEMENT IS SUCCESSFULL ---//
            if(!mysqli_stmt_prepare($stmt, $sql)){

                //--- TAKES USER BACK TO THE SIGNUP PAGE 'signup.php' WHENEVER PREPARE STATEMENT FAILS ---//
                header("Location: ../../frontend/views/php/signup.php?error=signstmtfailed");
                exit();
            }

            //--- BINDS THE VARIABLE TO BE INSERTED USING BIND PARAMETER STATEMENT ---//
            mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $username, $email, $company, $department, $password);
            
            //--- EXECUTE STATEMENT ---//            
            mysqli_stmt_execute($stmt);

            //--- CLOSES STATEMENT ---//
            mysqli_stmt_close($stmt);

            //--- TAKES USER BACK TO THE SIGNUP PAGE 'signup.php' WHEN   SIGNUP IS SUCCESSFULL ---//
            header("Location: ../../frontend/views/php/login.php?SignUp=successful");

        }   

        //----------------------------------------------------------------//
        //----------------------MAIN LOGIN FUNCTION-----------------------//

        function UserLogin($conn, $user, $password) {

            //--- ASSIGNED THE FUNCTION TO A VARIABLE ---//
            $existingUser = ExistingUser($conn, $user, $user);

            //--- CHECKS IF USERNAME/EMAIL INPUTTED EXISTS IN DATABASE ---//
            if($existingUser === false){

                //--- TAKES USER BACK TO THE LOGIN PAGE 'login.php' WHEN THE USER DOESNOT EXIST ---//
                header("Location: ../../frontend/views/php/login.php?error=usernotfound");
                exit();
            } 

            //--- CHECKS IF PASSWORD INPUTTED MATCHES USERS PASSWORD IN DATABASE ---//
            else if($existingUser['user_password'] != $password){

                //--- TAKES USER BACK TO THE LOGIN PAGE 'login.php' WHEN THE PASSWORD INPUTTED DOESNOT MATCH ANY PASSWORDS IN THE DATABASE ---//
                header("Location: ../../frontend/views/php/login.php?error=incorrectpassword&login_user=". $user);
                exit();
            } 
            else{

                //--- STARTS SESSION --->
                session_start();
                
                //--- ASSIGNS THE SESSION VARIABLE TO THE LOGGED IN USER'S ID, USERNAME, AND EMAIL ---//
                $_SESSION['user-id'] = $existingUser['user_id'];
                $_SESSION['user-name'] = $existingUser['user_name'];
                $_SESSION['user-email'] = $existingUser['user_email'];

                //--- TAKES USER BACK TO THE LOGIN PAGE 'login.php' WHENE LOGIN IS SUCCESSFULL ---//
                header("Location: ../../frontend/views/php/main.php?Login=successful");
                exit();
            }
        }

        //----------------------------------------------------------------//
        //---------------FUNCTION FOR OVERTIME TOTAL HOURS----------------//

        function TotalHours($timefrom, $timeto) {

            //--- SPLITS THE TIME STRING INTO DIFFERENT STRINGS AND ASSIGNED THEM INTO A VARIABLE---//
            $from_part = explode(" ", $timefrom);
            $to_part = explode(" ", $timeto);

            //--- EXTRACT HOURS AND MINS FROM THE 'from' TIME ---//
            $from_hour = (int)substr($from_part[0], 0, 2);
            $from_min = (int)substr($from_part[0], 3, 2);

            //--- CONVERTS THE 'from' TIME PERIOD TO UPPERCASE ---//
            $from_period = strtoupper($from_part[1]);
            
            //--- EXTRACT HOURS AND MINS FROM THE 'to' TIME ---//
            $to_hour = (int)substr($to_part[0], 0, 2);
            $to_min = (int)substr($to_part[0], 3, 2);

            //--- CONVERTS THE 'to' TIME PERIOD TO UPPERCASE ---//
            $to_period = strtoupper($to_part[1]);

            //--- CONVERTING INTO 24 HOUR FORMAT ---//

            //--- CHECKS IF THE VALUE OF '$from_period' IS EQUAL TO 'PM' AND NOT EQUAL TO '12', IF IT IS EQUAL TO '12' THEN ADD 12 ---//
            if ($from_period == 'PM' && $from_hour != 12) {
                $from_hour += 12;
            } 

            //--- ELSE IF THE VALUE OF '$from_period' IS EQUAL TO 'AM' AND EQUAL TO '12', IF IT IS EQUAL TO '12' THEN RETURN '0' ---//
            elseif ($from_period == 'AM' && $from_hour == 12) {
                $from_hour = 0;
            }
            
            //--- CHECKS IF THE VALUE OF '$to_period' IS EQUAL TO 'PM' AND NOT EQUAL TO '12', IF IT IS EQUAL TO '12' THEN ADD 12 ---//
            if ($to_period == 'PM' && $to_hour != 12) {
                $to_hour += 12;
            } 
            //--- ELSE IF THE VALUE OF '$to_period' IS EQUAL TO 'AM' AND EQUAL TO '12', IF IT IS EQUAL TO '12' THEN RETURN '0' ---//
            elseif ($to_period == 'AM' && $to_hour == 12) {
                $to_hour = 0;
            }
            
            //--- CALCULATE THE TIME DIFFERENCE IN HOURS ---//
            $timeDiff = ($to_hour + ($to_min / 60)) - ($from_hour + ($from_min / 60));

            //--- ADDS 24 HOURS IF THE TIME DIFFERENCE SPANS ACROSS THE MIDNIGHT 
            if ($timeDiff < 0) {
                $timeDiff += 24;
            }

            //--- RETURNS THE TIME CALCULATED TIME DIFFERENCE ---//
            return $timeDiff;

        }

        //----------------------------------------------------------------//
        //---------------FUNCTION FOR OVERTIME APPLICATION----------------//

        function OvertimeFiling($conn, $company, $department, $firstname, $middlename, $lastname, $position, $timefrom,
        $timeto, $tasks, $designation, $approved, $noted){

            //--- ASSIGNED THE FUNCTION TO A VARIABLE ---//
            $overtime = TotalHours($timefrom, $timeto);  

            //--- INSERT QUERY ---//
            $sql = "INSERT INTO overtime_csc (ot_company, ot_dept, ot_firstname, ot_middlename, ot_lastname, ot_position, ot_from, ot_to, ot_hours, ot_task, 
            ot_designation, ot_approved, ot_noted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);

            //--- CHECKS IF THE VARIABLES '$sql' AND '$stmt' IF PREPARE STATEMENT IS SUCCESSFULL ---//
            if(!mysqli_stmt_prepare($stmt, $sql)){

                //--- TAKES USER BACK TO THE MAIN PAGE 'main.php' WHENEVER PREPARE STATEMENT FAILS ---//
                header("Location: ../../frontend/views/php/main.php?error=otstatementfailed");
                exit();
            }

            //--- BINDS THE VARIABLE TO BE INSERTED USING BIND PARAMETER STATEMENT ---//
            mysqli_stmt_bind_param($stmt, "ssssssssdssss", $company, $department, $firstname, $middlename, $lastname, $position, 
            $timefrom, $timeto, $overtime, $tasks, $designation, $approved, $noted);
            
            //--- EXECUTE STATEMENT ---//   
            mysqli_stmt_execute($stmt);

            //--- CLOSES STATEMENT ---//
            mysqli_stmt_close($stmt);

            //--- TAKES USER BACK TO THE MAIN PAGE 'main.php' WHEN FILING OVERTIME IS SUCCESSFULL ---//
            header("Location: ../../frontend/views/php/main.php?OTinsert=successful");
            
        }

        //----------------------------------------------------------------//
        //-------------------FUNCTION FOR EDIT OVERTIME-------------------//

        function OvertimeEdit($conn, $overtimeid, $company, $department, $firstname, $middlename, $lastname, $position, $timefrom,
        $timeto, $tasks, $designation, $approved, $noted){

            //--- ASSIGNED THE FUNCTION TO A VARIABLE ---//
            $overtime = TotalHours($timefrom, $timeto);  

            //--- UPDATE QUERY --//
            $sql = "UPDATE overtime_csc SET ot_company = ?, ot_dept = ?, ot_firstname = ?, ot_middlename = ?, ot_lastname = ?, ot_position = ?, 
            ot_from = ?, ot_to = ?, ot_hours = ?, ot_task = ?, ot_designation = ?, ot_approved = ?, ot_noted = ? WHERE ot_id = $overtimeid;";
            $stmt = mysqli_stmt_init($conn);

            //--- CHECKS IF THE VARIABLES '$sql' AND '$stmt' IF PREPARE STATEMENT IS SUCCESSFULL ---//
            if(!mysqli_stmt_prepare($stmt, $sql)){

                //--- TAKES USER BACK TO THE MAIN PAGE 'main.php' WHENEVER PREPARE STATEMENT FAILS ---//
                header("Location: ../../frontend/views/php/main.php?error=overtimestatementfailed");
                exit();
            }

            //--- BINDS THE VARIABLE TO BE UPDATED USING BIND PARAMETER STATEMENT ---//
            mysqli_stmt_bind_param($stmt, "ssssssssdssss", $company, $department, $firstname, $middlename, $lastname, $position, 
            $timefrom, $timeto, $overtime, $tasks, $designation, $approved, $noted);
            
            //--- EXECUTE STATEMENT ---//
            mysqli_stmt_execute($stmt);

            //--- CHECKES IF THERE ARE ROWS AFFECTED ---//
            if(mysqli_stmt_affected_rows($stmt) > 0){

                //--- TAKES USER BACK TO THE MAIN PAGE 'main.php' WHEN UPDATING OVERTIME IS SUCCESSFULL ---//
                header("Location: ../../frontend/views/php/main.php?OTupdate=successful");
            }
            else{

                //--- TAKES USER BACK TO THE MAIN PAGE 'main.php' WHEN UPDATING OVERTIME FAILS ---//
                header("Location: ../../frontend/views/php/main.php?error=norecordmodified");
            }

            //--- CLOSES STATEMENT ---//
            mysqli_stmt_close($stmt);

            
            
        }

        //----------------------------------------------------------------//
        //-------------------FUNCTION FOR CHANGE SHIFT--------------------//

        function AddEmployee($conn, $company, $department, $firstname, $middlename, $lastname, $age, $phone, $position, $email, $sex){

            //--- INSERT QUERY ---//
            $sql = "INSERT INTO employee_pid (emp_firstname, emp_middlename, emp_lastname, emp_position, emp_dept, emp_company, 
            emp_mobile, emp_email, emp_gender, emp_age) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);

            //--- CHECKS IF THE VARIABLES '$sql' AND '$stmt' IF PREPARE STATEMENT IS SUCCESSFULL ---//
            if(!mysqli_stmt_prepare($stmt, $sql)){

                //--- TAKES USER BACK TO THE MAIN PAGE 'main.php' WHENEVER PREPARE STATEMENT FAILS ---//
                header("Location: ../../frontend/views/php/main.php?error=empstatementfailed");
                exit();
            }

            //--- BINDS THE VARIABLE TO BE INSERTED USING BIND PARAMETER STATEMENT ---//
            mysqli_stmt_bind_param($stmt, "ssssssissi", $firstname, $middlename, $lastname, $position, $department, $company, 
            $phone, $email, $sex, $age);

            //--- EXECUTE STATEMENT ---//
            mysqli_stmt_execute($stmt);

            //--- CLOSES STATEMENT ---//
            mysqli_stmt_close($stmt);

            //--- TAKES USER BACK TO THE MAIN PAGE 'main.php' WHEN FILING CHANGESHIFT IS SUCCESSFULL ---//
            header("Location: ../../frontend/views/php/main.php?Empinsert=successful");

        }

        //----------------------------------------------------------------//
        //-----------------FUNCTION FOR CHANGE SHIFT EDIT-----------------//
        
        function ChangeShiftEdit($conn, $shiftid, $company, $department, $firstname, $middlename, $lastname, $origin, $new, $date, $reason, $approved, $noted){
            
            $effectiveDate = date('Y-m-d', strtotime($date));

            $sql = "UPDATE changeshift_csc SET cs_company = ?, cs_dept = ?, cs_firstname = ?, cs_middlename = ?, cs_lastname = ?, cs_shiftorigin = ?, cs_shiftnew = ?,
            cs_reason = ?, cs_approved = ?, cs_noted = ?, cs_date = ? WHERE cs_id = $shiftid;";
            
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){

                //--- TAKES USER BACK TO THE CHANGE SHIFT PAGE 'changeshift.php' WHENEVER PREPARE STATEMENT FAILS ---//
                header("Location: ../../frontend/views/php/changeshift.php?error=csupdatestmtfailed");
                exit();
            }   

            mysqli_stmt_bind_param($stmt, "sssssssssss", $company, $department, $firstname, $middlename, $lastname, $origin, 
            $new, $reason, $approved, $noted, $effectiveDate);

            mysqli_stmt_execute($stmt);

            if(mysqli_stmt_affected_rows($stmt) > 0){
                header("Location: ../../frontend/views/php/main.php?CSupdate=successful");
            }
            else{
                header("Location: ../../frontend/views/php/main.php?error=norecordmodified");
            }

            mysqli_stmt_close($stmt);   
        }

        //----------------------------------------------------------------//
        //-------------FUNCTION FOR OFFICIAL BUSINESS FILING--------------//

        function OfficialBusiness($conn, $company, $department, $firstname, $middlename, $lastname, $date, $client, $status, $reason, $noted){

            //--- FORMATS THE DATE AND ASSIGNED IT TO A VARIABLE ---//
            $effectiveDate = date('Y-m-d', strtotime($date)); 

            //--- INSERT QUERY ---//
            $sql = "INSERT INTO officialbusiness_csc (ob_company, ob_dept, ob_firstname, ob_middlename, ob_lastname, ob_date, ob_client, ob_status,
            ob_reason, ob_noted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);

            //--- CHECKS IF THE VARIABLES '$sql' AND '$stmt' IF PREPARE STATEMENT IS SUCCESSFULL ---//
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../../frontend/views/php/main.php?error=obstatementfailed");
                exit();
            }

            //--- BINDS THE VARIABLE TO BE INSERTED USING BIND PARAMETER STATEMENT ---//
            mysqli_stmt_bind_param($stmt, "ssssssssss", $company, $department, $firstname, $middlename, $lastname, $effectiveDate, 
            $client, $status, $reason, $noted);

            //--- EXECUTE STATEMENT ---//
            mysqli_stmt_execute($stmt);

            //--- CLOSES STATEMENT ---//
            mysqli_stmt_close($stmt);

            //--- TAKES USER BACK TO THE MAIN PAGE 'main.php' WHEN FILING OFFICIAL BUSINESS IS SUCCESSFULL ---//
            header("Location: ../../frontend/views/php/main.php?OBinsert=successful");

        }
        
        //----------------------------------------------------------------//
        //--------------FUNCTION FOR OFFICIAL BUSINESS EDIT---------------//

        function OfficialBusinessEdit($conn, $offid, $company, $department, $firstname, $middlename, $lastname, $date, $client, $status, $reason, $noted){
            
            $dateEffective = date('Y-m-d', strtotime($date)); 
            $sql = "UPDATE officialbusiness_csc SET ob_company = ?, ob_dept = ?, ob_firstname = ?, ob_middlename = ?, ob_lastname = ?, ob_date = ?, 
            ob_client = ?, ob_status = ?, ob_reason = ?, ob_noted = ? WHERE ob_id = $offid;";

            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../../frontend/views/php/main.php?error=obupdatestmtfailed");
                exit();
            }
            
            mysqli_stmt_bind_param($stmt, 'ssssssssss', $company, $department, $firstname, $middlename, 
            $lastname, $dateEffective, $client, $status, $reason, $noted);

            mysqli_stmt_execute($stmt);

            if(mysqli_stmt_affected_rows($stmt) > 0){
                header("Location: ../../frontend/views/php/main.php?OBupdate=successful");
            }
            else{
                header("Location: ../../frontend/views/php/main.php?error=norecordmodified");
            }

            mysqli_stmt_close($stmt);

        }
        