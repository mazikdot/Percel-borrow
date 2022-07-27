<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<srcript src="https://code.jquery.com/jquery-3.6.0.min.js"></srcript>
<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['add'])) {
        $PercelName = $_POST['PercelName'];
        //Check ว่ามีพัสดุอยู่ในระบบแล้วหรือยัง

        $sql1 = "SELECT * from  tbpercel where PercelName=:PercelName";
        $query1 = $dbh->prepare($sql1);
        $query1->bindParam(':PercelName', $PercelName, PDO::PARAM_STR);
        $query1->execute();
        $results1 = $query1->fetchAll(PDO::FETCH_ASSOC);
        if(count($results1)){
            echo "<script>
            swal('ขอภัยค่ะ', 'มีพัสดุชื่อนี้ในระบบอยู่แล้วไม่สามารถเพิ่มซ้ำได้', 'warning').then(
                function() {
                  window.location.href = 'addpercel.php';
                }
              );
            </script>";
        } else {
            $sql = "INSERT INTO tbpercel(PercelName) VALUES(:PercelName)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':PercelName', $PercelName, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
    
            if ($lastInsertId) {
                echo "<script>
            swal('สำเร็จ', 'ท่านได้ทำการเพิ่มพัสดุเรียบร้อยแล้ว', 'success').then(
                function() {
                  window.location.href = 'addpercel.php';
                }
              );
            </script>";
            }
        }

       
    }
   } ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>Admin | Add Leave Type</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
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
        <main class="mn-inner">
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <h5>เพิ่มพัสดุ</h5>
                            <div class="row">
                                <form class="col s12" name="chngpwd" method="post">
                                    <div class="row">
                                      
                                        <div class="input-field col s12">
                                            <input id="PercelName" type="text" class="validate" autocomplete="off" name="PercelName" required>
                                            <label for="PercelName">ชื่อพัสดุ เช่น แบบ นั่งร้าน</label>
                                        </div>


                                        <div class="input-field col s12">
                                            <button type="submit" name="add" class="waves-effect waves-light btn indigo m-b-xs">ADD</button>

                                        </div>




                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </main>

        </div>
        <div class="left-sidebar-hover"></div>

        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/form_elements.js"></script>

    </body>

    </html>
