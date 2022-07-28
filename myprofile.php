<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<srcript src="https://code.jquery.com/jquery-3.6.0.min.js"></srcript>
<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {
    $eid = intval($_SESSION['eid']);
    if (isset($_POST['update'])) {

        $email = $_POST['email'];
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $mobileno = $_POST['mobileno'];
        $Password = $_POST['Password'];
        $sql = "update tblemployees set EmailId=:email,FirstName=:fname,LastName=:lname,Gender=:gender,Address=:address,Phonenumber=:mobileno,Password=:Password where id=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email);
        $query->bindParam(':fname', $fname);
        $query->bindParam(':lname', $lname);
        $query->bindParam(':gender', $gender);
        $query->bindParam(':address', $address);
        $query->bindParam(':mobileno', $mobileno);
        $query->bindParam(':Password', $Password);
        $query->bindParam(':eid', $eid);
        $query->execute();
        if ($query) {

            echo "<script>
        swal('แก้ไขข้อมูลเรียบร้อยแล้ว', 'ท่านได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว', 'success').then(
            function() {
              window.location.href = 'myprofile.php';
            }
          );
        </script>";
        }
        // $msg = "คุณได้ทำการแก้ไข้ข้อมูลพนักงานแล้ว";
    }


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>Admin | Update Employee</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>

        <!-- font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped&display=swap" rel="stylesheet">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped&display=swap');
        </style>
        <style>
            body {
                font-family: 'IBM Plex Sans Thai Looped', sans-serif;
            }
        </style>

        <!-- icon -->
        <link rel="icon" type="image/png" href="assets/images/icon-company.jpg" />
    </head>

    <body>

        <?php include('includes/header.php'); ?>

        <?php include('includes/sidebar.php'); ?>
        <div class="loader-bg"></div>
        <main class="mn-inner">
            <div class="row">
                
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <form id="example-form" method="post" name="updatemp">
                                <div>
                                    <h3 style="text-align:center;">ข้อมูลส่วนตัวของฉัน</h3>
                                    <section>
                                        <div class="wizard-content">
                                            <div class="row">
                                                <div class="col m12">
                                                    <div class="row">
                                                        <?php
                                                        $eid = intval($_SESSION['eid']);
                                                        $sql = "SELECT * from  tblemployees where id=:eid";
                                                        $query = $dbh->prepare($sql);
                                                        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        $genderArray = array("ชาย", "หญิง");
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {               ?>



                                                                <div class="input-field col m6 s12">
                                                                    <label for="firstName">ชื่อ</label>
                                                                    <input id="firstName" name="firstName" value="<?php echo htmlentities($result->FirstName); ?>" type="text" required>
                                                                </div>

                                                                <div class="input-field col m6 s12">
                                                                    <label for="lastName">นามสกุล</label>
                                                                    <input id="lastName" name="lastName" value="<?php echo htmlentities($result->LastName); ?>" type="text" autocomplete="off" required>
                                                                </div>
                                                                <div class="input-field col m6 s12">

                                                                    <select name="gender" autocomplete="off">
                                                                        <?php

                                                                        foreach ($genderArray as $x => $resgenderArray) {
                                                                            $selected = ($result->Gender == $resgenderArray) ? "selected" : "";
                                                                            echo "<option value = '{$resgenderArray}' {$selected}>{$resgenderArray}</option>";
                                                                        }

                                                                        ?>

                                                                    </select>
                                                                </div>
                                                                <div class="input-field m6 col s12">
                                                                    <label for="phone">เบอร์โทรการติดต่อ</label>
                                                                    <input id="phone" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber); ?>" maxlength="10" autocomplete="off" required>
                                                                </div>
                                                                <div class="input-field col m6 s12">
                                                                    <label for="email">Email</label>
                                                                    <input name="email" type="email" id="email" value="<?php echo htmlentities($result->EmailId); ?>" autocomplete="off" required>
                                                                    <span style="font-size:12px;"></span>
                                                                </div>
                                                                <div class="input-field col m6 s12">
                                                                    <label for="Password">รหัสผ่าน</label>
                                                                    <input name="Password" type="Password" value="<?php echo htmlentities($result->Password); ?>" autocomplete="off" required>
                                                                    <span style="font-size:12px;"></span>
                                                                </div>



                                                    </div>
                                                </div>

                                                <div class="col m12">
                                                    <div class="row">

                                                        <div class="input-field col m12 s12">
                                                            <label for="address">ที่อยู่</label>
                                                            <input id="address" name="address" type="text" value="<?php echo htmlentities($result->Address); ?>" autocomplete="off" required>
                                                        </div>



                                                <?php }
                                                        } ?>

                                                <div class="input-field col s12">
                                                    <button type="submit" name="update" id="update" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>

                                                </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>


                                    </section>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        </div>
        <div class="left-sidebar-hover"></div>

        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/form_elements.js"></script>

    </body>

    </html>
<?php } ?>