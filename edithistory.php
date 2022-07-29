<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<srcript src="https://code.jquery.com/jquery-3.6.0.min.js"></srcript>
<?php
session_start();
include('includes/config.php');

//Fetch One Data 
$id = $_GET['id'];
$sql = " SELECT a.BorrowId,a.Work1,a.Work2,a.BorrowAmount,a.BorrowRequest
,a.BorrowReturn,a.Other,b.StatusBorrowName,c.TypePercelId,c.typePercelAmount
, c.TypePercelName,d.PercelName FROM tbborrow as a 
INNER JOIN tbstatusborrow as b ON a.StatusBorrow = b.StatusBorrow 
INNER JOIN tbtypepercel as c ON a.TypePercelIdAuto = c.TypePercelIdAuto 
INNER JOIN tbpercel as d ON d.PercelIdAuto = c.PercelIdAuto
WHERE BorrowId=:id;";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $id);
$query->execute();
$resultEdit = $query->fetch(PDO::FETCH_ASSOC);
// End Fetch One Data

if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {
    // Code for change password 
    if (isset($_POST['add'])) {



        $Work1 = $_POST['Work1'];
        $Work2 = $_POST['Work2'];
        $BorrowAmount = $_POST['BorrowAmount'];
        $BorrowRequest = $_POST['BorrowRequest'];
        $BorrowReturn = $_POST['BorrowReturn'];
        $Other = $_POST['Other'];
        if ($resultEdit['typePercelAmount'] < $BorrowAmount) {
            echo "<script>
            swal('พัสดุไม่เพียงต่อการยืม', 'โปรดตรวจสอบจำนวนการยืมอีกครั้ง', 'warning').then(
                function() {
                  window.location.href = 'listhistory.php';
                }
              );
            </script>";
        } else {
            $sql = "update tbborrow set Work1=:Work1,Work2=:Work2,BorrowAmount=:BorrowAmount
            ,BorrowRequest=:BorrowRequest,BorrowReturn=:BorrowReturn,Other=:Other
            ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':Work1', $Work1, PDO::PARAM_STR);
            $query->bindParam(':Work2', $Work2, PDO::PARAM_STR);
            $query->bindParam(':BorrowAmount', $BorrowAmount, PDO::PARAM_STR);
            $query->bindParam(':BorrowRequest', $BorrowRequest, PDO::PARAM_STR);
            $query->bindParam(':BorrowReturn', $BorrowReturn, PDO::PARAM_STR);
            $query->bindParam(':Other', $Other, PDO::PARAM_STR);
            $query->execute();
            if ($query) {
                echo "<script>
                swal('สำเร็จ', 'ท่านได้ทำการแก้ไขข้อมูลการยืมเรียบร้อยแล้ว', 'success').then(
                    function() {
                      window.location.href = 'listhistory.php';
                    }
                  );
                </script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>Employee | Change Password</title>

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
    <link href="assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
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
                        <h5 style="text-align:center;">แก้ไขรายละเอียดการยืม</h5>

                        <br>

                        <div class="row" style="border:solid; border-width:1.5px;">
                            <form class="col s12 m12 l12" style="margin-top:20px;" name="chngpwd" method="post">
                                <div class="row">


                                    <div class="col l12 s12 m12">
                                        หน้างานที่ต้องการยืม
                                    </div>
                                    <div class="input-field col l12 s12 m12">

                                        <input id="Work1" value="<?php echo $resultEdit['Work1']; ?>" type="text" class="validate" autocomplete="off" name="Work1" required>
                                    </div>
                                    <div class="col l12 s12 m12">
                                        ไปยัง
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="Work2" type="text" value="<?php echo $resultEdit['Work2']; ?>" class="validate" autocomplete="off" name="Work2" required>
                                    </div>
                                    <div class="col l12 s12 m12">
                                        จำนวนที่ต้องการยืม
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="BorrowAmount" type="number" value="<?php echo $resultEdit['BorrowAmount']; ?>" class="validate" autocomplete="off" name="BorrowAmount" required>
                                    </div>
                                    <div class="col l12 s12 m12">
                                        วันที่ขอยืม
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="BorrowRequest" type="date" value="<?php echo $resultEdit['BorrowRequest']; ?>" class="validate" autocomplete="off" name="BorrowRequest" required>
                                    </div>
                                    <div class="col l12 s12 m12">
                                        วันที่คืน
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="BorrowReturn" type="date" value="<?php echo $resultEdit['BorrowReturn']; ?>" class="validate" autocomplete="off" name="BorrowReturn" required>
                                    </div>
                                    <div class="col l12 s12 m12">
                                        รายละเอียดอื่น ๆ ข้อมูลเพิ่มเติมสามารถระบุได้ (หากมี)
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="Other" type="text" class="validate" value="<?php echo $resultEdit['Other']; ?>" autocomplete="off" name="Other" required>
                                    </div>



                                    <div class="input-field col s12">
                                        <button type="submit" name="add" class="waves-effect waves-light btn indigo m-b-xs">แก้ไข</button>

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
    <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="assets/js/alpha.min.js"></script>
    <script src="assets/js/pages/form_elements.js"></script>
    <script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/pages/table-data.js"></script>

</body>

</html>