<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<srcript src="https://code.jquery.com/jquery-3.6.0.min.js"></srcript>
<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['add'])) {
        $TypePercelId = $_POST['TypePercelId'];
        $TypePercelName = $_POST['TypePercelName'];
        $PercelIdAuto = $_POST['PercelIdAuto'];

        $sql1 = "SELECT * from  tbtypepercel where TypePercelName=:TypePercelName OR TypePercelId=:TypePercelId";
        $query1 = $dbh->prepare($sql1);
        $query1->bindParam(':TypePercelName', $TypePercelName, PDO::PARAM_STR);
        $query1->bindParam(':TypePercelId', $TypePercelId, PDO::PARAM_STR);
        $query1->execute();
        $results1 = $query1->fetchAll(PDO::FETCH_ASSOC);
        if (count($results1)) {
            echo "<script>
            swal('ขอภัยค่ะ', 'มีรหัส หรือ ชนิดพัสดุอยู่แล้วโปรดตรวจสอบอีกครั้ง', 'warning').then(
                function() {
                  window.location.href = 'addtypepercel.php';
                }
              );
            </script>";
        } else {
            $sql = "INSERT INTO tbtypepercel(TypePercelId,TypePercelName,PercelIdAuto) VALUES(:TypePercelId,:TypePercelName,:PercelIdAuto)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':TypePercelId', $TypePercelId, PDO::PARAM_STR);
            $query->bindParam(':TypePercelName', $TypePercelName, PDO::PARAM_STR);
            $query->bindParam(':PercelIdAuto', $PercelIdAuto, PDO::PARAM_STR);

            $query->execute();
            $lastInsertId = $dbh->lastInsertId();

            if ($lastInsertId) {
                echo "<script>
            swal('สำเร็จ', 'ท่านได้ทำการเพิ่มชนิดพัสดุเรียบร้อยแล้ว', 'success').then(
                function() {
                  window.location.href = 'addtypepercel.php';
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
    <title>เพิ่มชนิดพัสดุ</title>

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
    <link rel="icon" type="image/jpg" href="../assets/images/icon-company.jpg" />
</head>

<body>
    <?php include('includes/header.php'); ?>

    <?php include('includes/sidebar.php'); ?>
    <main class="mn-inner">
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <h5 style="text-align:center;">เพิ่มชนิดของพัสดุ</h5>
                        <p style="text-align:center;">เนื่องจากพัสดุ มีหลายประเภท เช่น แบบเหล็ก เหล็กพาสติก แบบฉาก ตัวหนอน จำเป็นที่จะต้องแยกประเภทเพื่อการใช้งานที่สะดวก
                            <br> ดังนั้นควรเลือก พัสดุ และประเภทของพัสดุให้ตรงกัน เช่น A แบบ (A01 แบบพลาสติก 20 * 150)
                        </p>

                        <div class="row">
                            <form class="col s12 s12 m12" name="chngpwd" method="post">
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
                                                echo "<option value = '{$row['PercelIdAuto']}'>{$row['PercelId']} {$row['PercelName']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col l12 s12 m12">
                                        <label for="TypePercelId">รหัส เช่น A01 หรือ B01 และอื่น ๆ </label>
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="TypePercelId" type="text" class="validate" autocomplete="off" name="TypePercelId" required>
                                    </div>
                                    <div class="col l12 s12 m12">
                                        <label for="TypePercelName">ชนิดพัสดุ เช่น ประเภท A แบบพลาสติก 20 * 150 หรือ ประเภท B ขานั่งร้าน</label>
                                    </div>
                                    <div class="input-field col l12 s12 m12">
                                        <input id="TypePercelName" type="text" class="validate" autocomplete="off" name="TypePercelName" required>
                                    </div>


                                    <div class="input-field col s12 l12 m12">
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