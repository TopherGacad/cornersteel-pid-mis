<?php

// session_start();

// if(!isset($_SESSION['user-id'])){
//     header("Location: ../../../frontend/views/php/login.php");
//     exit();
// }

    include_once '../../../backend/includes/dbconn_inc.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "SELECT * FROM employee_pid WHERE emp_id = $id;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo 'sql failed';
        }
        else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            $empid = $row['emp_id'];
            $company = $row['emp_company'];
            $department = $row['emp_dept'];
            $firstname = $row['emp_firstname'];
            $middlename = $row['emp_middlename'];
            $lastname = $row['emp_lastname'];
            $age = $row['emp_age'];
            $phone = $row['emp_mobile'];
            $position = $row['emp_position'];
            $email = $row['emp_email'];
            $sex = $row['emp_gender'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Employee Details</title>

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


        <form action="../../../backend/includes/empedit_inc.php" method="post" id="csEdit-form">
            <div class="ot-header">
                <h3><a href="../../views/php/main.php"><i class="fa-solid fa-arrow-left"></i></a>Edit Employee Details</h3>
                <div class="btn-container">
                    <a href="../../views/php/main.php"><input type="button" value="Discard" class="cancelBtn modal-btn" id="cancel-btn"></a>
                    <button class="update-btn modal-btn" id="otEdit-update" type="submit" name="emp-update">Update</button>
                </div>
            </div>

            <input type="hidden" name="id" value="<?php echo $empid;?>">

            <div class="employee-container">
                <h3>Company Details</h3>
                <div class="emp-layout main">
                    <div class="left-side-emp section">
                        <!-- COMPANY FIELD -->
                        <div class="fields">
                            <label class="dis-input" for="shift-company">Company <span> *</span></label>
                            <select class="dis-input" name="employ_company" id="shift-company" required autofocus>
                                <option value="" selected disabled>Select company</option>
                                <option value="Comfac" <?php if($company === "Comfac") echo "selected";?>>Comfac Corporation</option>
                                <option value="CSC" <?php if($company === "CSC") echo "selected";?>>Cornersteel Systems Corporation</option>
                                <option value="ESCO" <?php if($company === "ESCO") echo "selected";?>>ESCO</option>
                            </select>
                        </div>

                        <!-- DEPARTMENT FIELD -->
                        <div class="fields">
                            <label class="dis-input" for="shift-department">Department <span> *</span></label>
                            <select class="dis-input" class="dis-input" name="employ_department" id="shift-department" required>
                                <option value="" selected disabled>Select Department</option>
                                <option value="Accounts" <?php if($department == "Accounts") echo "selected";?>>Accounts</option>
                                <option value="Sales" <?php if($department == "Sales") echo "selected";?>>Sales</option>
                                <option value="Legal" <?php if($department == "Legal") echo "selected";?>>Legal</option>
                                <option value="PID" <?php if($department == "PID") echo "selected";?>>Project Installation Dep</option>
                                <option value="HR" <?php if($department == "HR") echo "selected";?>>Human Resources</option>
                            </select>
                        </div>
                    </div>

                    <div class="right-side-emp section">
                        <!-- DESIGNATION FIELD -->
                        <div class="fields">
                            <label for="shift-new"> Designation/Position<span> *</span></label>
                            <select name="employ_position" id="shift-new" required>
                                <option value="" selected disabled>Select Designation</option>
                                <option value="Administrative Officer" <?php if($position == "Administrative Officer") echo "selected";?>>Administrative Officer</option>
                                <option value="Accountant" <?php if($position == "Accountant") echo "selected";?>>Accountant</option>
                                <option value="HR Manager" <?php if($position == "HR Manager") echo "selected";?>>HR Manager</option>
                                <option value="Software Developer" <?php if($position == "Software Developer") echo "selected";?>>Software Developer</option>
                                <option value="Supervisor" <?php if($position == "Supervisor") echo "selected";?>>Supervisor</option>
                                <option value="Secretary" <?php if($position == "Secretary") echo "selected";?>>Secretary</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="time-container">
            <h3>Employee Details</h3>
                <div class="time-layout main">
                    <div class="left-side-time section">
                        <!-- FIRSTNAME FIELD -->
                        <div class="fields">
                            <label class="dis-input" for="shift-firstname">Firstname <span> *</span></label>
                            <input class="dis-input" type="text" name="employ_firstname" id="shift-firstname" value="<?php echo $firstname; ?>" required>
                        </div>

                       <!-- MIDDLE NAME -->
                       <div class="fields">
                            <label class="dis-input" for="shift-midname">Middlename</label>
                            <input class="dis-input" type="text" name="employ_midname" id="shift-midname" value="<?php echo $middlename; ?>">
                        </div>

                         <!-- LASTNAME FIELD -->
                         <div class="fields">
                            <label class="dis-input" for="shift-lastname">Lastname <span> *</span></label>
                            <input class="dis-input" type="text" name="employ_lastname" id="shift-lastname" value="<?php echo $lastname; ?>" required>
                        </div>
                    </div>
                    
                    <div class="right-side-time section">
                        <!-- AGE FIELD -->
                        <div class="fields">
                            <label for="shift-date">Age<span> *</span></label>
                            <input type="text" id="shift-date" name="employ_age" pattern="[0-9]*" minlength="1" maxlength="3" value="<?php echo $age; ?>" required>
                        </div>

                        <!-- SEX FIELD -->
                        <div class="fields">
                            <label for="shift-approvedBy">Sex<span> *</span></label>
                            <select name="employ_sex" id="shift-approvedBy" required>
                                <option value="" selected disabled>Select Sex</option>
                                <option value="Male" <?php if($sex == "Male") echo "selected";?>>Male</option> ?>>Male</option>
                                <option value="Female" <?php if($sex == "Female") echo "selected";?>>Female</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="approval-container">
                <h3>Contact Details</h3>
                <div class="main">
                    <div class="left-side-approve section">
                        <!-- MOBILE NUMBER FIELD -->
                        <div class="fields"> 
                            <label for="shift-orig">Mobile number<span> *</span></label>
                            <input type="text" id="shift-orig" name="employ_mobile" pattern="[0-9]{11}" maxlength="11" placeholder="eg. 09XXXXXXXXX" value="<?php echo $phone; ?>" required >
                        </div> 
                    </div>

                    <div class="right-side-approve section">
                        <!-- EMAIL FIELD -->
                        <div class="fields">
                            <label for="shift-reason">Email<span> *</span></label>
                            <input type="text" id="shift-reason" name="employ_email" placeholder="eg. example@gmail.com" value="<?php echo $email?>">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>