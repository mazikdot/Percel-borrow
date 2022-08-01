<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<srcript src="https://code.jquery.com/jquery-3.6.0.min.js"></srcript>
<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['add'])) {
        $PercelIdAuto = $_POST['PercelIdAuto'];
        $TypePercelId = $_POST['TypePercelId'];
        $TypePercelName = $_POST['TypePercelName'];
        $id = $_GET['id'];
       
            //update ถ้าข้อมูลไม่ซ้ำกันก็สามารถอัพเดตได้
            $sql = "update tbtypepercel set PercelIdAuto=:PercelIdAuto,TypePercelId=:TypePercelId,TypePercelName=:TypePercelName where TypePercelIdAuto=:id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':PercelIdAuto', $PercelIdAuto);
            $query->bindParam(':TypePercelId', $TypePercelId);
            $query->bindParam(':TypePercelName', $TypePercelName);
            $query->bindParam(':id', $id);
            $query->execute();
            echo "<script>
    swal('สำเร็จ', 'ท่านได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว', 'success').then(
        function() {
          window.location.href = 'showtypepercel.php';
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
    <!-- <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
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
    <style>
        /* fallback */
@font-face {
  font-family: 'Material Icons';
  font-style: normal;
  font-weight: 400;
  src: url(https://fonts.gstatic.com/s/materialicons/v135/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2) format('woff2');
}

.material-icons {
  font-family: 'Material Icons';
  font-weight: normal;
  font-style: normal;
  font-size: 24px;
  line-height: 1;
  letter-spacing: normal;
  text-transform: none;
  display: inline-block;
  white-space: nowrap;
  word-wrap: normal;
  direction: ltr;
  -webkit-font-feature-settings: 'liga';
  -webkit-font-smoothing: antialiased;
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
                                    $sqlPer = "SELECT * from  tbpercel";
                                    $queryPer = $dbh->prepare($sqlPer);
                                    $queryPer->execute();

                                    ?>
                                    <div class="input-field col l12">

                                        <select name="PercelIdAuto" id="">

                                            <?php
                                            while ($row = $queryPer->fetch(PDO::FETCH_ASSOC)) {
                                                $selected = ($row['PercelIdAuto'] == $resultPercel['PercelIdAuto']) ? "selected" : "";
                                                echo "<option value = '{$row['PercelIdAuto']}' {$selected}>{$row['PercelName']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="input-field col l12">
                                        <input id="TypePercelId" type="text" class="validate" autocomplete="off" name="TypePercelId" value="<?php echo $resultPercel['TypePercelId'];  ?>" required>
                                        <label for="TypePercelId">รหัส เช่น A01 หรือ B01 และอื่น ๆ </label>
                                    </div>
                                    <div class="input-field col l12">
                                        <input id="TypePercelName" type="text" class="validate" autocomplete="off" name="TypePercelName" value="<?php echo $resultPercel['TypePercelName'];  ?>" required>
                                        <label for="TypePercelName">ชนิดพัสดุ เช่น ประเภท A แบบพลาสติก 20 * 150 หรือ ประเภท B ขานั่งร้าน</label>
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