<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<srcript src="https://code.jquery.com/jquery-3.6.0.min.js"></srcript>
<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {
    // Code for change password 
    if (isset($_POST['add'])) {
        $typePercelAmount = $_POST['typePercelAmount'];
       
        $id = $_GET['id'];

        //update ถ้าข้อมูลไม่ซ้ำกันก็สามารถอัพเดตได้
        $sql = "update tbtypepercel set typePercelAmount=:typePercelAmount where TypePercelIdAuto=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':typePercelAmount', $typePercelAmount);
        $query->bindParam(':id', $id);
        $query->execute();
        echo "<script>
    swal('สำเร็จ', 'ท่านได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว', 'success').then(
        function() {
          window.location.href = 'addamountpercel.php';
        }
      );
    </script>";
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM tbtypepercel  WHERE TypePercelIdAuto=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id);
    $query->execute();
    $resultPercel = $query->fetch(PDO::FETCH_ASSOC);
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
                        <h5 style="text-align:center;">ข้อมูลพัสดุที่ต้องการยืม</h5>

                        <p style="text-align:center; color:red;">หลังจากการยืมรอแอดมิน ยืนยันสถานะผ่านการอนุมัติ</p>
                        <br>
                        <!-- -------------------------เริ่มข้อมูลพัสดุที่ต้องการยืม---------------------------------- -->
                        <div class="row" style="border:solid; border-width:1.5px;">
                        <h5 style="text-align:center">รายละเอียดพัสดุ</h5>
                            <form class="col s12 m12 l12" name="chngpwd" method="post">
                                <div class="row">
                                    <?php
                                    $sqlPer = "SELECT * from  tbpercel";
                                    $queryPer = $dbh->prepare($sqlPer);
                                    $queryPer->execute();

                                    ?>
                                    <div class="input-field col l12 s12 m12">

                                        <select name="PercelIdAuto" id="" disabled>

                                            <?php
                                            while ($row = $queryPer->fetch(PDO::FETCH_ASSOC)) {
                                                $selected = ($row['PercelIdAuto'] == $resultPercel['PercelIdAuto']) ? "selected" : "";
                                                echo "<option value = '{$row['PercelIdAuto']}' {$selected}>{$row['PercelName']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                   
                                    <div class="input-field col l12 s12 m12">
                                        <input id="TypePercelId" type="text" class="validate" autocomplete="off" name="TypePercelId" value="<?php echo $resultPercel['TypePercelId'];  ?>" required disabled>
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="TypePercelName" type="text" class="validate" autocomplete="off" name="TypePercelName" value="<?php echo $resultPercel['TypePercelName'];  ?>" required disabled>
                                    </div>
                                    <div class="col l12 s12 m12" style="margin-top:20px;">
                                        <label>จำนวนพัสดุที่มีอยู่สามารถยืมได้</label>
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="typePercelAmount" type="text" class="validate" autocomplete="off" name="typePercelAmount" value="<?php echo $resultPercel['typePercelAmount'];  ?>" required disabled>
                                    </div>

                                    




                                </div>

                            </form>
                        </div>
                        <!-- ------------------ จบข้อมูลพัสดุที่ต้องการยืม ----------------------------- -->
                        <div class="row" style="border:solid; border-width:1.5px;">
                        <h5 style="text-align:center">กรอกข้อมูลเพื่อยืมพัสดุ</h5>
                            <form class="col s12 m12 l12" name="chngpwd" method="post">
                                <div class="row">
                                    <?php
                                    $sqlPer = "SELECT * from  tbpercel";
                                    $queryPer = $dbh->prepare($sqlPer);
                                    $queryPer->execute();

                                    ?>
                                   
                                    <div class="col l12 s12 m12">
                                            หน้างานที่ต้องการยืม
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="TypePercelId" type="text" class="validate" autocomplete="off" name="TypePercelId" required >
                                    </div>
                                    <div class="col l12 s12 m12">
                                            ไปยัง
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="TypePercelName" type="text" class="validate" autocomplete="off" name="TypePercelName"  required >
                                    </div>
                                    <div class="col l12 s12 m12">
                                            วันที่ขอยืม
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="TypePercelId" type="date" class="validate" autocomplete="off" name="TypePercelId" required >
                                    </div>
                                    <div class="col l12 s12 m12">
                                            วันที่คืน
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="TypePercelName" type="date" class="validate" autocomplete="off" name="TypePercelName"  required >
                                    </div>
                                    <div class="col l12 s12 m12">
                                            รายละเอียดอื่น ๆ ข้อมูลเพิ่มเติมสามารถระบุได้ (หากมี)
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="TypePercelName" type="text" class="validate" autocomplete="off" name="TypePercelName"  required >
                                    </div>
                                  
                                  

                                    <div class="input-field col s12">
                                        <button type="submit" name="add" class="waves-effect waves-light btn indigo m-b-xs">ยืมพัสดุ</button>

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