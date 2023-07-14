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
    <title>Edit Project</title>

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
                <h3><a href="../../views/php/main.php"><i class="fa-solid fa-arrow-left"></i></a>Edit Project</h3>
                    <div class="btn-container">
                        <a href="../../views/php/main.php"><input type="button" value="Discard" class="cancelBtn modal-btn" id="cancel-btn"></a>
                        <button class="update-btn modal-btn" id="obEdit-update" type="submit" name="offbusiness-update">Update</button>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo $offid; ?>">

                <div class="employee-container">
                    <h3>Project Details</h3>
                    <div class="emp-layout main">
                        <div class="left-side-emp section">
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

                             <!-- LOCATION FIELD -->
                            <div class="fields">
                                <label for="proj-loc">Location<span> *</span></label>
                                <input type="text" name="proj_loc" id="proj-loc" required>
                            </div> 
                        </div>

                        <div class="right-side-emp section">
                            
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
                    </div>
                </div>

            </form>
        </div>
</body>
</html>