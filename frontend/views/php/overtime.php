<?php
    //--- STARTS SESSION ---//
    session_start();

    //--- REQUIRES USER TO LOGIN IN ORDER TO PROCEED ---//
    if(!isset($_SESSION['user-id'])){
        header("Location: ../../../frontend/views/php/login.php");
        exit();
    }

    //--- INCLUDES THE DATABASE CONNECTION FILE ---//
    include_once '../../../backend/includes/dbconn_inc.php';

    //--- GETS THE ID VALUE FROM URL UPON CLICKING THE EDIT ICON ---//
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        //--- SELECT QUERY ---//
        $sql = "SELECT * FROM overtime_csc WHERE ot_id = $id;";

        //--- INITIALIZE STATEMENT ---//
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo 'sql failed';
        }
        else{

        //--- EXECUTE STATEMENT ---//
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

        //--- FETCHES ROW DATA BASED ON THE ID ---//
            $row = mysqli_fetch_assoc($result);

        //--- VARIABLE DECLARATION BASED ON THE DATA FETCHED ---//
            $overtimeid = $row['ot_id'];
            $company = $row['ot_company'];
            $department = $row['ot_dept'];
            $firstname = $row['ot_firstname'];
            $middlename = $row['ot_middlename'];
            $lastname = $row['ot_lastname'];
            $position = $row['ot_position'];
            $timefrom = $row['ot_from'];
            $timeto = $row['ot_to'];
            $tasks = $row['ot_task'];     
            $designation = $row['ot_designation'];
            $approved = $row['ot_approved'];
            $noted = $row['ot_noted'];

        //--- FORMATTING TIME TO THE REQUIRED FORMAT ---//
            $formatfrom = date('H:i', strtotime($row['ot_from']));
            $formatto = date('H:i', strtotime($row['ot_to']));
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Overtime</title>

    <!-- STYLESHEET -->
    <link rel="stylesheet" href="../../public/css/editpage.css">
    <!-- WEB ICON -->
    <link rel="icon" href="../../public/assets/comfac-logo-transparent.png">
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/aa37050208.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include "../../../backend/includes/popup_handlers_inc.php"?>

    <!-- PAGE HEADER -->
    <div class="head-container">
        <img class="main-logo" src="../../public/assets/comfac-logo.png" alt="comfac global group logo">
    </div>

        <div class="content-container">
            <form action="../../../backend/includes/otedit_inc.php" method="post" id="otEdit-form">
                <div class="ot-header">
                    <h3><a href="../../views/php/main.php"><i class="fa-solid fa-arrow-left"></i></a>Edit Overtime Request</h3>
                    <div class="btn-container">
                        <a href="../../views/php/main.php"><input type="button" value="Discard" class="cancelBtn modal-btn" id="cancel-btn"></a>
                        <button class="update-btn modal-btn" id="otEdit-update" type="submit" name="overtime-update">Update</button>
                    </div>
                </div>

                <!-- FOR EVERY PHP TAGS INSIDE THE INPUT TAGS, IT ECHOS/DISPLAYS THE VALUE FETCHED FROM THE DATABASE 
                ROW. AS FOR THE IF STATEMENTS IN OPTIONS, IT CHECKS WHETHER THE VARIABLE MATCHES THE VALUE OF THE OPTION 
                ACCORDINGLY, IF YES THEN IT ECHOS 'SELECTED', HENCE MAKING THE 'SELECT' TAG SELECT THE THE SAID OPTION -->

                <input type="hidden" name="id" value="<?php echo $overtimeid; ?>">

                <div class="employee-container">
                    <h3>Employee Details</h3>
                    <div class="emp-layout main">
                        <div class="left-side-emp section">
                            <!-- COMPANY FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ot-company">Company <span> *</span></label>
                                <select class="dis-input" name="ot_company" id="ot-company">required autofocus>
                                    <option value=""disabled>Select company</option>
                                    <option value="Comfac" <?php if($company === "Comfac") echo "selected";?>>Comfac Corporation</option>
                                    <option value="CSC" <?php if($company === "CSC") echo "selected";?>>Cornersteel Systems Corporation</option>
                                    <option value="ESCO" <?php if($company === "ESC") echo "selected";?>>ESCO</option>
                                </select>
                            </div>
                            
                            <!-- DEPARTMENT FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ot-department">Department <span> *</span></label>
                                <select class="dis-input" name="ot_department" id="ot-department" required>
                                    <option value="" disabled>Select company</option>
                                    <option value="Accounts" <?php if($department == "Accounts") echo "selected";?>>Accounts</option>
                                    <option value="Sales" <?php if($department == "Sales") echo "selected";?>>Sales</option>
                                    <option value="Legal" <?php if($department == "Legal") echo "selected";?>>Legal</option>
                                    <option value="PID" <?php if($department == "PID") echo "selected";?>>Project Installation Dep</option>
                                    <option value="HR" <?php if($department == "HR") echo "selected";?>>Human Resources</option>
                                </select>
                            </div>

                            <!-- POSITION FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ot-position">Position <span> *</span></label>
                                <input class="dis-input" type="text" name="ot_position" id="ot-position" value="<?php echo $position; ?>" required>
                            </div> 
                        </div>

                        <div class="right-side-emp section">
                            <!-- FIRSTNAME FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ot-firstname">Firstname <span> *</span></label>
                                <input class="dis-input" type="text" name="ot_firstname" id="ot-firstname" required value="<?php echo $firstname; ?>">
                            </div>

                            <!-- MIDDLENAME FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ot-midname">Middlename</label>
                                <input class="dis-input" type="text" name="ot_midname" id="ot-midname" value="<?php echo $middlename; ?>">
                            </div>

                            <!-- LASTNAME FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ot-lastname">Lastname <span> *</span></label>
                                <input class="dis-input" type="text" name="ot_lastname" id="ot-lastname" value="<?php echo $lastname; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="time-container">
                <h3>Time Details</h3>
                    <div class="time-layout main">
                        <div class="left-side-time section">
                                <!-- TIME FROM FIELDS -->
                                <div class="fields">
                                    <label class="dis-input" for="ot-timeFrom">Time (from) <span> *</span></label>
                                    <input class="dis-input" type="time" name="ot_timeFrom" id="ot-timeFrom" value="<?php echo $formatfrom; ?>" required>
                                </div>
                                <!-- TIME TO FIELD -->
                                <div class="fields">
                                    <label class="dis-input" for="ot-timeTo">Time (to) <span> *</span></label>
                                    <input class="dis-input" type="time" name="ot_timeTo" id="ot-timeTo" value="<?php echo $formatto; ?>" required>
                                </div>
                        </div>
                        
                        <div class="right-side-time section">
                            <!-- TASK FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ot-task">Work to Perform/ Task</label>
                                <textarea class="dis-input" name="ot_task" id="ot_task" cols="30" rows="9" maxlength="150"><?php echo $tasks; ?></textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="approval-container">
                    <h3>Approval Details</h3>
                    <div class="main">
                        <div class="left-side-approve section">
                            <!-- APPROVED BY FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ot-approvedBy">Approved By <span> *</span></label>
                                <input class="dis-input" type="text" name="ot_approvedBy" id="ot-approvedBy" value="<?php echo $approved; ?>" required>
                            </div>

                            <!-- NOTED BY FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ot-noteBy">Noted By <span> *</span></label>
                                <input class="dis-input" type="text" name="ot_noteBy" id="ot-noteBy" value="<?php echo $noted; ?>" required>
                            </div>
                        </div>

                        <div class="right-side-approve section">
                             <!-- DESIGNATION FIELD -->
                            <div class="fields">
                                <label for="ot-designation">Designation <span> *</span></label>
                                <select name="ot_designation" id="ot-designation" required>
                                    <option value="" disabled>Select Designation</option>
                                    <option value="Administrative Officer" <?php if($designation == "Administrative Officer") echo "selected";?>>Administrative Officer</option>
                                    <option value="Accountant" <?php if($designation == "Accountant") echo "selected";?>>Accountant</option>
                                    <option value="HR Manager" <?php if($designation == "HR Manager") echo "selected";?>>HR Manager</option>
                                    <option value="Software Developer" <?php if($designation == "Software Developer") echo "selected";?>>Software Developer</option>
                                    <option value="Supervisor" <?php if($designation == "Supervisor") echo "selected";?>>Supervisor</option>
                                    <option value="Secretary" <?php if($designation == "Secretary") echo "selected";?>>Secretary</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script src="../../js/main.js"></script>
</body>
</html>