    <?php

        session_start();

        if(!isset($_SESSION['user-id'])){
            header("Location: ../../../frontend/views/php/login.php");
            exit();
        }

        include_once '../../../backend/includes/dbconn_inc.php';

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $sql = "SELECT * FROM changeshift_csc WHERE cs_id = $id;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo 'sql failed';
            }
            else{
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                $row = mysqli_fetch_assoc($result);

                $shiftid = $row['cs_id'];
                $company = $row['cs_company'];
                $department = $row['cs_dept'];
                $firstname = $row['cs_firstname'];
                $middlename = $row['cs_middlename'];
                $lastname = $row['cs_lastname'];
                $origin = $row['cs_shiftorigin'];
                $new = $row['cs_shiftnew'];
                $reason = $row['cs_reason'];
                $approved = $row['cs_approved'];
                $noted = $row['cs_noted'];
                $date = $row['cs_date'];

                $formatdate = date("Y-m-d", strtotime($date));  
            }
        }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Change Shift Request</title>

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
                <form action="../../../backend/includes/csedit_inc.php" method="post" id="csEdit-form">
                    <div class="ot-header">
                        <h3><a href="../../views/php/main.php"><i class="fa-solid fa-arrow-left"></i></a>Edit Change Shift Request</h3>
                        <div class="btn-container">
                            <a href="../../views/php/main.php"><input type="button" value="Discard" class="cancelBtn modal-btn" id="cancel-btn"></a>
                            <button class="update-btn modal-btn" id="otEdit-update" type="submit" name="shift-update">Update</button>
                        </div>
                    </div>
    
                    <input type="hidden" name="id" value="<?php echo $shiftid;?>">

                    <div class="employee-container">
                        <h3>Employee Details</h3>
                        <div class="emp-layout main">
                            <div class="left-side-emp section">
                                <!-- COMPANY FIELD -->
                                <div class="fields">
                                    <label class="dis-input" for="shift-company">Company <span> *</span></label>
                                    <select class="dis-input" name="shift_company" id="shift-company" required autofocus>
                                        <option value="" selected disabled>Select company</option>
                                        <option value="Comfac" <?php if($company === "Comfac") echo "selected";?>>Comfac Corporation</option>
                                        <option value="CSC" <?php if($company === "CSC") echo "selected";?>>Cornersteel Systems Corporation</option>
                                        <option value="ESCO" <?php if($company === "ESCO") echo "selected";?>>ESCO</option>
                                    </select>
                                </div>

                                <!-- DEPARTMENT FIELD -->
                                <div class="fields">
                                    <label class="dis-input" for="shift-department">Department <span> *</span></label>
                                    <select class="dis-input" class="dis-input" name="shift_department" id="shift-department" required>
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
                                    <label class="dis-input" for="shift-firstname">Firstname <span> *</span></label>
                                    <input class="dis-input" type="text" name="shift_firstname" id="shift-firstname" value="<?php echo $firstname; ?>" required>
                                </div>
                            </div>

                            <div class="right-side-emp section">
                                
                                <!-- MIDDLE NAME -->
                                <div class="fields">
                                    <label class="dis-input" for="shift-midname">Middlename</label>
                                    <input class="dis-input" type="text" name="shift_midname" id="shift-midname" value="<?php echo $middlename; ?>">
                                </div>

                                <!-- LASTNAME FIELD -->
                                <div class="fields">
                                    <label class="dis-input" for="shift-lastname">Lastname <span> *</span></label>
                                    <input class="dis-input" type="text" name="shift_lastname" id="shift-lastname" value="<?php echo $lastname; ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="time-container">
                    <h3>Shift Details</h3>
                        <div class="time-layout main">
                            <div class="left-side-time section">
                                <!-- ORIGINAL SHIFT FIELD -->
                                <div class="fields">
                                    <label class="dis-input" for="shift-orig"> Original shift<span> *</span></label>
                                    <select class="dis-input" name="shift_orig" id="shift-orig" required>
                                        <option value="" selected disabled>Select shift</option>
                                        <option value="8:00AM - 5:00PM" <?php if($origin === "8:00AM - 5:00PM") echo "selected";?>>Shift type 1: 8:00AM - 5:00PM</option>
                                        <option value="9:00AM - 7:00PM" <?php if($origin === "9:00AM - 7:00PM") echo "selected";?>>Shift type 2: 9:00AM - 7:00PM</option>
                                        <option value="6:00AM - 3:00PM" <?php if($origin === "6:00AM - 3:00PM") echo "selected";?>>Shift type 3: 6:00AM - 3:00PM</option>
                                    </select>
                                </div> 

                                <!-- NEW SHIFT FIELD -->
                                <div class="fields">
                                    <label class="dis-input" for="shift-new"> New shift<span> *</span></label>
                                    <select class="dis-input" name="shift_new" id="shift-new" required>
                                        <option value="" selected disabled>Select shift</option>
                                        <option value="8:00AM - 5:00PM" <?php if($new === "8:00AM - 5:00PM") echo "selected";?>>Shift type 1: 8:00AM - 5:00PM</option>
                                        <option value="9:00AM - 7:00PM" <?php if($new === "9:00AM - 7:00PM") echo "selected";?>>Shift type 2: 9:00AM - 7:00PM</option>
                                        <option value="6:00AM - 3:00PM" <?php if($new === "6:00AM - 3:00PM") echo "selected";?>>Shift type 3: 6:00AM - 3:00PM</option>
                                    </select>
                                </div>

                                <!-- DATE EFFECTIVE -->
                                <div class="fields">
                                    <label class="dis-input" for="shift-date">Date Effective <span> *</span></label>
                                    <input class="dis-input" type="date" id="shift-date" name="shift_date" value="<?php echo $formatdate; ?>" required>
                                </div>
                            </div>
                            
                            <div class="right-side-time section">
                            <!-- REASON FIELD -->
                                <div class="fields">
                                    <label class="dis-input" for="shift-reason">Reason<span> *</span></label>
                                    <textarea class="dis-input" name="shift_reason" id="shift-reason" cols="30" rows="9" maxlength="150" placeholder="(150 characters only)" required><?php echo $reason; ?></textarea>
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
                                    <label class="dis-input" for="shift-approvedBy">Approved By <span> *</span></label>
                                    <input class="dis-input" type="text" name="shift_approvedBy" id="shift-approvedBy"  value="<?php echo $approved; ?>" required>
                                </div>
                            </div>

                            <div class="right-side-approve section">
                                <!-- NOTED BY FIELD -->
                                <div class="fields">
                                    <label class="dis-input" for="shift-noteBy">Noted By <span> *</span></label>
                                    <input class="dis-input" type="text" name="shift_noteBy" id="shift-noteBy" value="<?php echo $noted; ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    </body>
    </html>