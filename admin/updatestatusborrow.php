<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<srcript src="https://code.jquery.com/jquery-3.6.0.min.js"></srcript>
<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    //ดึงข้อมูลเพื่อเช็คจำนวนที่ยืม กับจำนวนที่มีสินค้าในระบบ
    $BorrowId = $_GET['BorrowId'];
    $sqlCheck = "SELECT a.BorrowId,a.BorrowAmount,b.typePercelAmount,b.TypePercelIdAuto FROM tbborrow as a 
                INNER JOIN tbtypepercel as b ON a.TypePercelIdAuto=b.TypePercelIdAuto
                WHERE a.BorrowId=:BorrowId";
    $queryCheck = $dbh->prepare($sqlCheck);
    $queryCheck->bindParam(':BorrowId', $BorrowId);
    $queryCheck->execute();
    $resultCheck = $queryCheck->fetch(PDO::FETCH_ASSOC);
    // end querycheck
    // start after press button
    if (isset($_POST['add'])) {

        $id = $_GET['BorrowId'];
        $StatusBorrow = $_POST['StatusBorrow'];
        $NoteBorrow = $_POST['NoteBorrow'];
        //เช็คว่าถ้าจะเปลี่ยนสถานะเป็นอนุมัติ จะต้องดึงสินค้ามาเช็คก่อนว่ามีสินค้านั้นพอจริงไหม
        if ($StatusBorrow == 2) {

            //ถ้าสินค้าที่จะยืมมากว่าสินค้าในระบบก็จะไม่สามารถยืมได้
            if ($resultCheck['BorrowAmount'] > $resultCheck['typePercelAmount']) {

                echo "<script>
                    swal('ไม่สำเร็จ', 'เนื่องจากจำนวนสินค้าที่จะอนุมัติของท่านไม่เพียงพอ', 'warning').then(
                        function() {
                          window.location.href = 'editstatusall.php';
                        }
                      );
                    </script>";
            } else {
                //ถ้าเช็คแล้วพบว่า สินค้าที่ยืมมันมีน้อยกว่า หรือเท่ากับก็สามารถแก้ไขสถานะได้
                //ลบสินค้าในระบบออก เมื่อผ่านการยืม
               
                $sql = "update tbborrow set StatusBorrow=:StatusBorrow,NoteBorrow=:NoteBorrow where BorrowId=:id";
                $query = $dbh->prepare($sql);
                $query->bindParam(':StatusBorrow', $StatusBorrow);
                $query->bindParam(':NoteBorrow', $NoteBorrow);
                $query->bindParam(':id', $id);
                $query->execute();

                //อัพเดตจำนวนสินค้าในระบบ
                $TypePercelIdAuto = $resultCheck['TypePercelIdAuto'];
                $resultAmount = $resultCheck['typePercelAmount'] - $resultCheck['BorrowAmount'];
                $sqlUpdateAmount = "update tbtypepercel set typePercelAmount=:resultAmount WHERE
                TypePercelIdAuto=:TypePercelIdAuto";
                $queryUpdateAmount = $dbh->prepare($sqlUpdateAmount);
                $queryUpdateAmount->bindParam(':resultAmount', $resultAmount);
                $queryUpdateAmount->bindParam(':TypePercelIdAuto', $TypePercelIdAuto);
                $queryUpdateAmount->execute();
                

                if ($queryUpdateAmount) {
                    echo "<script>
             swal('สำเร็จ', 'ท่านได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว', 'success').then(
                 function() {
                   window.location.href = 'editstatusall.php';
                 }
               );
             </script>";
                }
            }
        } else {
            //ถ้าไม่ใช่สถานะผ่านการอนุมัติจะไม่มีการเช็ค
            $sql = "update tbborrow set StatusBorrow=:StatusBorrow,NoteBorrow=:NoteBorrow where BorrowId=:id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':StatusBorrow', $StatusBorrow);
            $query->bindParam(':NoteBorrow', $NoteBorrow);
            $query->bindParam(':id', $id);
            $query->execute();
            if ($query) {
                echo "<script>
     swal('สำเร็จ', 'ท่านได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว', 'success').then(
         function() {
           window.location.href = 'editstatusall.php';
         }
       );
     </script>";
            }
        }
    }

    $id = $_GET['BorrowId'];
    $sql = "SELECT BorrowId,StatusBorrow,NoteBorrow FROM tbborrow  WHERE BorrowId=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id);
    $query->execute();
    $resultBorrow = $query->fetch(PDO::FETCH_ASSOC);
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
                        <h5 style="text-align:center;">แก้ไขข้อมูลประเภทของพัสดุ</h5>


                        <div class="row">
                            <form class="col s12" name="chngpwd" method="post">
                                <div class="row">
                                    <?php
                                    $sqlPer = "SELECT * from  tbstatusborrow";
                                    $queryPer = $dbh->prepare($sqlPer);
                                    $queryPer->execute();

                                    ?>
                                    <div class="col m12 l12 s12">
                                        <p style="color:red;">สถานะเดิม (หากต้องการเปลี่ยนแปลงสถานะการยืม ให้เลือกตามความต้องการแล้วกดปุ่ม UPDATE)</p>
                                    </div>
                                    <div class="input-field col l12 m12 s12">

                                        <select name="StatusBorrow">

                                            <?php
                                            while ($row = $queryPer->fetch(PDO::FETCH_ASSOC)) {
                                                $selected = ($row['StatusBorrow'] == $resultBorrow['StatusBorrow']) ? "selected" : "";
                                                echo "<option value ='{$row['StatusBorrow']}' {$selected}>{$row['StatusBorrowName']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col m12 l12 s12">
                                        <span>หมายเหตุอื่น ๆ เพื่อแจ้งให้ผู้ใช้ทราบ (ถ้ามี)</span>
                                        <input id="NoteBorrow" value="<?php echo $resultBorrow['NoteBorrow'];  ?>" name="NoteBorrow" type="text" autocomplete="off">

                                    </div>



                                    <div class="input-field col s12">
                                        <button type="submit" name="add" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>

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