<?php

    session_start();

    if(!isset($_SESSION['user-id'])){
        header("Location: ../../../frontend/views/php/login.php");
        exit();
    }

    include_once '../../../backend/includes/dbconn_inc.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "SELECT * FROM officialbusiness_csc WHERE ob_id = $id;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo 'sql failed';
        }
        else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            $offid = $row['ob_id'];
            $company = $row['ob_company'];
            $department = $row['ob_dept'];
            $firstname = $row['ob_firstname'];
            $middlename = $row['ob_middlename'];
            $lastname = $row['ob_lastname'];
            $date = $row['ob_date'];
            $client = $row['ob_client'];
            $status = $row['ob_status'];
            $reason = $row['ob_reason'];      
            $noted = $row['ob_noted'];

            $formatdate = date('Y-m-d', strtotime($date));
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Official Business Request</title>

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
            <form action="../../../backend/includes/obedit_inc.php" method="post" id="obEdit-form">
                <div class="ot-header">
                <h3><a href="../../views/php/main.php"><i class="fa-solid fa-arrow-left"></i></a>Edit Official Business Request</h3>
                    <div class="btn-container">
                        <a href="../../views/php/main.php"><input type="button" value="Discard" class="cancelBtn modal-btn" id="cancel-btn"></a>
                        <button class="update-btn modal-btn" id="obEdit-update" type="submit" name="offbusiness-update">Update</button>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo $offid; ?>">

                <div class="employee-container">
                    <h3>Employee Details</h3>
                    <div class="emp-layout main">
                        <div class="left-side-emp section">
                            <!-- COMPANY FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ob-company">Company <span> *</span></label>
                                <select class="dis-input" class="dis-input" class="dis-input" class="dis-input" name="ob_company" id="ob-company" required autofocus>
                                    <option value="" selected disabled>Select company</option>
                                    <option value="Comfac" <?php if($company === "Comfac") echo "selected";?>>Comfac Corporation</option>
                                    <option value="CSC" <?php if($company === "CSC") echo "selected";?>>Cornersteel Systems Corporation</option>
                                    <option value="ESCO" <?php if($company === "ESCO") echo "selected";?>>ESCO</option>
                                </select>
                            </div>

                            <!-- DEPARTMENT FIELD -->
                            <div class="fields">
                                <label class="dis-input" class="dis-input" class="dis-input" for="ob-department">Department <span> *</span></label>
                                <select class="dis-input" class="dis-input" class="dis-input" name="ob_department" id="ob-department" required>
                                    <option value="" selected disabled>Select company</option>
                                    <option value="Accounts" <?php if($department == "Accounts") echo "selected";?>>Accounts</option>
                                    <option value="Sales" <?php if($department == "Sales") echo "selected";?>>Sales</option>
                                    <option value="Legal" <?php if($department == "Legal") echo "selected";?>>Legal</option>
                                    <option value="PID" <?php if($department == "PID") echo "selected";?>>Project Installation Dep</option>
                                    <option value="HR" <?php if($department == "HR") echo "selected";?>>Human Resources</option>
                                </select>
                            </div>

                            <!-- FIRSTNAME FIELD -->
                            <div class="fields">
                                <label class="dis-input" class="dis-input" class="dis-input" for="ob-firstname">Firstname <span> *</span></label>
                                <input class="dis-input" class="dis-input" class="dis-input" type="text" name="ob_firstname" id="ob-firstname" value="<?php echo $firstname; ?>" required>
                            </div>
                        </div>

                        <div class="right-side-emp section">
                            
                            <!-- MIDDLE NAME -->
                            <div class="fields">
                                <label class="dis-input" class="dis-input" class="dis-input" for="ob-midname">Middlename</label>
                                <input class="dis-input" class="dis-input" class="dis-input" type="text" name="ob_midname" id="ob-midname" value="<?php echo $middlename; ?>">
                            </div>

                            <!-- LASTNAME FIELD -->
                            <div class="fields">
                                <label class="dis-input" class="dis-input" for="ob-lastname">Lastname <span> *</span></label>
                                <input class="dis-input" class="dis-input" type="text" name="ob_lastname" id="ob-lastname" value="<?php echo $lastname; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="time-container">
                <h3>Status Details</h3>
                    <div class="time-layout main">
                        <div class="left-side-time section">
                            <!-- STATUS FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ob-status">Status <span> *</span></label>
                                <select class="dis-input" name="ob_status" id="ob-status" required>
                                    <option value="" selected disabled>Select status</option>
                                    <option value="No Login" <?php if($status == "No Login") echo "selected";?>>No Login</option>
                                    <option value="No Logout" <?php if($status == "No Logout") echo "selected";?>>No Logout</option>
                                    <option value="Both" <?php if($status == "Both") echo "selected";?>>Both</option>
                                </select>
                            </div>

                            <!-- DATE FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ob-date">Date <span> *</span></label>
                                <input class="dis-input" type="date" name="ob_date" id="ob-date" value="<?php echo $formatdate; ?>" required>
                            </div>
                        </div>

                        <div class="right-side-time section">
                           <!-- REASON FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ob-reason">Reason<span> *</span></label>
                                <textarea class="dis-input" name="ob_reason" id="ob-reason" cols="30" rows="9" maxlength="150"><?php echo $reason; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="approval-container">
                    <h3>Approval Details</h3>
                    <div class="main">
                        <div class="left-side-approve section">
                             <!-- AUTHORIZE CLIENT FIELD -->
                            <div class="fields">
                                <label class="dis-input" class="dis-input" for="ob-client">Authorize Client <span> *</span></label>
                                <input class="dis-input" class="dis-input" type="text" name="ob_client" id="ob-client" value="<?php echo $client; ?>" required>
                            </div>
                        </div>

                        <div class="right-side-approve section">
                            <!-- NOTED BY FIELD -->
                            <div class="fields">
                                <label class="dis-input" for="ob-noteBy">Noted By <span> *</span></label>
                                <input class="dis-input" type="text" name="ob_noteBy" id="ob-noteBy" value="<?php echo $noted; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</body>
</html>