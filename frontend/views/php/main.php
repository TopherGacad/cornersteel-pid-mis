<?php
    // //--- STARTS SESSION ---//
    // session_start();

    // //--- REQUIRES USER TO LOGIN IN ORDER TO PROCEED ---//
    // if(!isset($_SESSION['user-id'])){
    //     header("Location: ../../../frontend/views/php/login.php");
    //     exit();
    // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- STYLESHEET -->
    <link rel="stylesheet" href="../../public/css/main.css">
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
        <div class="profile-container">
            <p><strong><abbr title="<?php echo $_SESSION['user-name']?>"><?php echo $_SESSION['user-name']?></abbr></strong></p>
            <i class="fa-solid fa-user"></i>
        </div>
    </div>

    <!-- SIDE NAVBAR -->
    <div class="side-nav">
        <ul>
            <a href="#" ><li id="dash-btn"><i class="nav-icons fa-solid fa-house"></i>Dashboard</li></a>
            <a href="#"><li id="overtime-btn"><i class="nav-icons fa-regular fa-calendar"></i>Bookings</li></a>
            <a href="#" ><li id="shifts-btn"><i class="nav-icons fa-solid fa-user"></i>Employees</li></a>
            <a href="#" ><li id="offBusiness-btn"><i class="nav-icons fa-solid fa-briefcase"></i>Projects</li></a>
            <a href="../../../backend/includes/logout_inc.php" ><li id="logout-btn"><i class="nav-icons fa-solid fa-arrow-right-from-bracket"></i>Logout</li></a>
        </ul>
    </div>

    <!-- DASHBOARD CONTENT -->
     <div class="dash-container" id="dash-container">
        <div class="content-header">
        </div>
        <div class="content-container">
        </div>
    </div>

    <!-- BOOKINGS CONTENT -->
    <div class="overtime-container" id="overtime-container">
        <div class="content-header">
            <input type="text" class="overtime-search" id="overtime-search" placeholder="Type here to search">
            <button class="addOvertime-btn" id="addOvertime-btn"><i class="fa-solid fa-plus"></i>Book Employee</button>
        </div>
        <div class="content-container">
            <table>
                <tr>
                    <th class="name">Name</th>
                    <th class="company">Company*</th>
                    <th>Department*</th>
                    <th>Position*</th>
                    <th>Time from</th>
                    <th>Time to</th>
                    <th class="thours">Total hours</th>
                    <th>Date Created</th>
                    <th class="actions">Action</th>
                </tr>

                <tbody id="overtime-table-body">



                </tbody>
            </table>
        </div>
    </div>

    <!-- EMPLOYEES CONTENT -->
    <div class="shifts-container" id="shifts-container">
        <div class="content-header">
            <input type="text" class="shifts-search" id="shifts-search" placeholder="Type here to search">
            <button class="addShifts-btn" id="addShifts-btn"><i class="fa-solid fa-plus"></i> Add Employee</button>
        </div>
        <div class="content-container">
            <table>
                <tr>
                    <th class="name">Name</th>
                    <th>Company</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th class="contact">Contact No.</th>
                    <th class="sex">Sex</th>
                    <th>Date Created</th>
                    <th class="actions">Action</th>
                </tr>

                <tbody id="shift-table-body">

                <?php 
                    include_once '../../../backend/includes/dbconn_inc.php';         

                    if(isset($_GET['deleteemp'])){
                        $shiftid = $_GET['deleteemp'];
                        
                        $delsql = "DELETE FROM employee_pid WHERE emp_id = ?;";
                        $delstmt = mysqli_stmt_init($conn);

                        if(!mysqli_stmt_prepare($delstmt, $delsql)){
                            echo 'deletion failed';
                        }
                        else{
                            mysqli_stmt_bind_param($delstmt, 'i', $shiftid);
                            mysqli_stmt_execute($delstmt);

                            if(mysqli_stmt_affected_rows($delstmt) > 0){
                                header('Location: main.php?deletion=successful');
                            }
                            else{
                                header('Location: main.php?deletion=failed');
                            }
                        }

                        mysqli_stmt_close($delstmt);
                    }

                    $sql = "SELECT * FROM employee_pid ORDER BY emp_datecreated DESC;";
                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo 'SQL statement failed';
                    }
                    else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        while($row = mysqli_fetch_assoc($result)){
                            $empid = $row['emp_id'];
                            $firstname = $row['emp_firstname'];
                            $lastname = $row['emp_lastname'];
                            $company = $row['emp_company'];
                            $position = $row['emp_position'];
                            $phone = $row['emp_mobile'];
                            $sex = $row['emp_gender'];
                            $date = $row['emp_datecreated'];

                            $creationdate = date('m/d/Y', strtotime($date));

                            echo '
                            <tr>
                                <td class="name"><abbr title="' . $firstname . ' ' . $lastname . '">' . $firstname . ' ' . $lastname . '</abbr></td>
                                <td class="company"><abbr title="' . $company . '">' . $company . '</abbr></td>
                                <td> ' . $company . '</td>
                                <td> ' . $position . '</td>
                                <td class="contact"> ' . $phone .  '</td>
                                <td class="sex"><abbr title="' . $sex . '">' . $sex . '</abbr></td>
                                <td> ' . $creationdate . '</td>     
                                <td class="actions">
                                    <a href="?deleteemployee=' . $empid . '"><i class="act-icon fa-solid fa-trash-can"></i></a>
                                    <a href="../../views/php/editemployee.php?id=' . $empid . '"><i class="act-icon fa-solid fa-pen-to-square"></i></a>
                                </td>
                            </tr>';
                        }
                    }
                ?>

                </tbody>
            </table>
        </div>
    </div>

    <!-- PROJECT CONTENT -->
    <div class="offBusiness-container" id="offBusiness-container">
        <div class="content-header">
            <input type="text" class="offBusiness-search" id="offBusiness-search" placeholder="Type here to search">
            <button class="addOffBusiness-btn" id="addOffBusiness-btn"><i class="fa-solid fa-plus"></i>Add Project</button>
        </div>
        <div class="content-container">
            <table>
                <tr>
                    <th class="name">Project</th>
                    <th class="client">Client</th>
                    <th class="min">Sales Order (SO)</th>
                    <th class="min">Job Order (JO)</th>
                    <th>Location</th>
                    <th>Date Created</th>
                    <th class="actions">Action</th>
                </tr>

                <tbody id="offBusiness-table-body">
    
                  
                  
                  
                  
                  
                  
                  
                  
                </tbody>
            </table>
        </div>
    </div>

    <!-- FORM MODALS -->
    <!-- ADD BOOKINGS MODAL -->
    <div class="bg" id="bg"></div>
    <div class="overtime-modal-container" id="overtime-modal-container">
        <div class="modal-header">
            <h4>ADD OVERTIME</h4>
        </div>
        <form action="../../../backend/includes/overtime_inc.php" method="post" id="overtime-form">

            <!-- LEFT SIDE MODAL -->
            <div class="form-left">
                <!-- COMPANY FIELD -->
                <div class="fields">
                    <label for="ot-company">Company <span> *</span></label>
                    <select name="ot_company" id="ot-company" required autofocus>
                        <option value="" selected disabled>Select company</option>
                        <option value="Comfac">Comfac Corporation</option>
                        <option value="CSC">Cornersteel Systems Corporation</option>
                        <option value="ESCO">ESCO</option>
                    </select>
                </div>

                <!-- DEPARTMENT FIELD -->
                <div class="fields">
                    <label for="ot-department">Department <span> *</span></label>
                    <select name="ot_department" id="ot-department" required>
                        <option value="" selected disabled>Select company</option>
                        <option value="Accounts">Accounts</option>
                        <option value="Sales">Sales</option>
                        <option value="Legal">Legal</option>
                        <option value="PID">Project Installation Dep</option>
                        <option value="HR">Human Resources</option>
                    </select>
                </div>

                <!-- NAME FIELDS -->
                <div class="field-container">
                    <div class="fields">
                        <label for="ot-firstname">Firstname <span> *</span></label>
                        <input type="text" maxlength="25" pattern="[A-Za-z ]{2,25}" name="ot_firstname" id="ot-firstname" placeholder="Juan" required>
                    </div>
    
                    <div class="fields">
                        <label for="ot-midname">Middlename</label>
                        <input type="text" maxlength="15" pattern="[A-Za-z]{2,15}" name="ot_midname" id="ot-midname" placeholder="Reyes">
                    </div>
                </div>

                <!-- LASTNAME FIELD -->
                <div class="fields">
                    <label for="ot-lastname">Lastname <span> *</span></label>
                    <input type="text" maxlength="15" pattern="[A-Za-z]{2,15}" name="ot_lastname" id="ot-lastname" placeholder="Dela Cruz" required>
                </div>

                <!-- POSITION FIELD -->
                <div class="fields">
                    <label for="ot-position">Position <span> *</span></label>
                    <input type="text" name="ot_position" id="ot-position" placeholder="Employee Position" required>
                </div> 

                <!-- TIME FIELDS -->
                <div class="time-container">
                    <div class="fields">
                        <label for="ot-timeFrom">Time (from) <span> *</span></label>
                        <input type="time" name="ot_timeFrom" id="ot-timeFrom" required>
                    </div>
    
                    <div class="fields">
                        <label for="ot-timeTo">Time (to) <span> *</span></label>
                        <input type="time" name="ot_timeTo" id="ot-timeTo" required>
                    </div>
                </div>

                 <!-- MODAL BUTTON CONTAINER -->
                <div class="modal-btn-container">
                    <input type="button" value="Cancel" class="otCancelBtn modal-btn" id="otCancel-btn">
                    <button class="save-btn modal-btn" id="save-btn" type="submit" name="overtime-save">Save</button>
                </div>
            </div>

            <!-- RIGHT SIDE MODAL -->
            <div class="form-right">

                <!-- TASK FIELD -->
                <div class="fields">
                    <label for="ot-task">Work to Perform/ Task</label>
                    <textarea name="ot_task" id="ot-task" cols="30" rows="9" maxlength="150"></textarea>
                </div>

                <!-- DESIGNATION FIELD -->
                <div class="fields">
                    <label for="ot-designation">Designation <span> *</span></label>
                    <select name="ot_designation" id="ot-designation" required>
                        <option value="" selected disabled>Select Designation</option>
                        <option value="Administrative Officer">Administrative Officer</option>
                        <option value="Accountant">Accountant</option>
                        <option value="HR Manager">HR Manager</option>
                        <option value="Software Developer">Software Developer</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Secretary">Secretary</option>
                    </select>
                </div>

                <!-- APPROVED BY FIELD -->
                <div class="fields">
                    <label for="ot-approvedBy">Approved By <span> *</span></label>
                    <input type="text" name="ot_approvedBy" id="ot-approvedBy" required>
                </div>

                <!-- NOTED BY FIELD -->
                <div class="fields">
                    <label for="ot-noteBy">Noted By <span> *</span></label>
                    <input type="text" name="ot_noteBy" id="ot-noteBy" required>
                </div>
            </div>
        </form>
    </div>

    <!-- ADD EMPLOYEES MODAL -->
    <div class="bg" id="bg"></div>
    <div class="shift-modal-container" id="shift-modal-container">
        <div class="modal-header">
            <h4>ADD EMPLOYEES</h4>
        </div>
        <form action="../../../backend/includes/emp_inc.php" method="post" id="shift-form">

            <!-- LEFT SIDE MODAL -->
            <div class="form-left">
                <!-- COMPANY FIELD -->
                <div class="fields">
                    <label for="shift-company">Company <span> *</span></label>
                    <select name="employ_company" id="shift-company" required autofocus>
                        <option value="" selected disabled>Select company</option>
                        <option value="Comfac">Comfac Corporation</option>
                        <option value="CSC">Cornersteel Systems Corporation</option>
                        <option value="ESCO">ESCO</option>
                    </select>
                </div>

                <!-- DEPARTMENT FIELD -->
                <div class="fields">
                    <label for="shift-department">Department <span> *</span></label>
                    <select name="employ_department" id="shift-department" required>
                        <option value="" selected disabled>Select company</option>
                        <option value="Accounts">Accounts</option>
                        <option value="Sales">Sales</option>
                        <option value="Legal">Legal</option>
                        <option value="PID">Project Installation Dep</option>
                        <option value="HR">Human Resources</option>
                    </select>
                </div>

                <!-- NAME FIELDS -->
                <div class="field-container">
                    <div class="fields">
                        <label for="shift-firstname">Firstname <span> *</span></label>
                        <input type="text" name="employ_firstname" id="shift-firstname" placeholder="Juan" required>
                    </div>
    
                    <div class="fields">
                        <label for="shift-midname">Middlename</label>
                        <input type="text" name="employ_midname" id="shift-midname" placeholder="Reyes">
                    </div>
                </div>
                
                <div class="field-container">
                    <!-- LASTNAME FIELD -->
                    <div class="fields">
                        <label for="shift-lastname">Lastname <span> *</span></label>
                        <input type="text" name="employ_lastname" id="shift-lastname" placeholder="Dela Cruz" required>
                    </div>
                    
                    <!-- AGE FIELD -->
                    <div class="fields">
                        <label for="shift-date">Age<span> *</span></label>
                        <input type="text" id="shift-date" name="employ_age" pattern="[1-9]" minlength="1" maxlength="3" required>
                    </div>
                </div>
               
                 <!-- MODAL BUTTON CONTAINER -->
                <div class="modal-btn-container">
                    <input type="button" value="Cancel" class="shiftCancelBtn modal-btn" id="shiftCancel-btn">
                    <button class="save-btn modal-btn" id="save-btn" type="submit" name="emp-save">Save</button>
                </div>
            </div>

            <!-- RIGHT SIDE MODAL -->
            <div class="form-right">
                <!-- MOBILE NUMBER FIELD -->
                <div class="fields">
                    <label for="shift-orig">Mobile number<span> *</span></label>
                    <input type="text" id="shift-orig" name="employ_mobile" pattern="[0-9]{11}" maxlength="11" placeholder="eg. 09XXXXXXXXX" required >
                </div> 

                <!-- DESIGNATION FIELD -->
                <div class="fields">
                    <label for="shift-new"> Designation/Position<span> *</span></label>
                    <select name="employ_position" id="shift-new" required>
                        <option value="" selected disabled>Select Designation</option>
                        <option value="Administrative Officer">Administrative Officer</option>
                        <option value="Accountant">Accountant</option>
                        <option value="HR Manager">HR Manager</option>
                        <option value="Software Developer">Software Developer</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Secretary">Secretary</option>
                    </select>
                </div>

                <!-- EMAIL FIELD -->
                <div class="fields">
                    <label for="shift-reason">Email<span> *</span></label>
                    <input type="text" id="shift-reason" name="employ_email" placeholder="eg. example@gmail.com">
                </div>

                <!-- SEX FIELD -->
                <div class="fields">
                    <label for="shift-approvedBy">Sex<span> *</span></label>
                    <select name="employ_sex" id="shift-approvedBy" required>
                        <option value="" selected disabled>Select Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
        </form>
    </div>


    <!-- ADD PROJECT MODAL -->
    <div class="bg" id="bg"></div>
    <div class="offBusiness-modal-container" id="offBusiness-modal-container">
        <div class="modal-header">
            <h4>ADD PROJECT DETAILS</h4>
        </div>
        <form action="../../../backend/includes/offbusiness_inc.php" method="post" id="offBusiness-form">

            <!-- LEFT SIDE MODAL -->
            <div class="form-left">
                <!-- PROJECT FIELD -->
                <div class="fields">
                    <label for="proj-name">Project <span> *</span></label>
                    <input type="text" id="proj-name" name="proj_name" required>
                </div>

                <!-- CLIENT FIELD -->
                <div class="fields">
                    <label for="proj-client">Client <span> *</span></label>
                    <input type="text" id="proj-client" name="proj_client" required>
                </div>
                
                <div class="field-container">
                    <!-- SALES ORDER FIELD -->
                    <div class="fields">
                        <label for="proj-so">Sales Order(SO) <span> *</span></label>
                        <input type="text" id="proj-so" name="proj_so" required>
                    </div>
                    <!-- JOB ORDER FIELD -->
                    <div class="fields">
                        <label for="proj-jo">Job Order(JO) <span> *</span></label>
                        <input type="text" name="proj_jo" id="proj-jo" required>
                    </div>
                </div>
        
                <!-- LOCATION FIELD -->
                <div class="fields">
                    <label for="proj-loc">Location<span> *</span></label>
                    <input type="text" name="proj_loc" id="proj-loc" required>
                </div> 
                 <!-- MODAL BUTTON CONTAINER -->
                <div class="modal-btn-container">
                    <input type="button" value="Cancel" class="offBusCancelBtn modal-btn" id="offBusCancel-btn">
                    <button class="save-btn modal-btn" id="save-btn" type="submit" name="offbusiness-save">Save</button>
                </div>
            </div>    
        </form>
    </div>
    
    <!-- JAVASCRIPT -->
    <script src="../../js/main.js"></script>
</body>
</html>

<?php
    ob_end_flush();
?>