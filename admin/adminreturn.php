<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<srcript src="https://code.jquery.com/jquery-3.6.0.min.js"></srcript>
<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $BorrowId = $_GET['id'];
    $sql = "SELECT a.refuseAmount,a.BorrowId,a.BorrowAmount,b.typePercelAmount,b.TypePercelIdAuto FROM tbborrow as a 
    INNER JOIN tbtypepercel as b ON a.TypePercelIdAuto=b.TypePercelIdAuto
    WHERE a.BorrowId=:BorrowId";
    $query = $dbh->prepare($sql);
    $query->bindParam(':BorrowId', $BorrowId);
    $query->execute();
    $resultBorrow = $query->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['add'])) {
        //ลดจำนวนสินค้าในตารางยืม
        $refuse = $_POST['refuse'];
        $BorrowAmount = $resultBorrow['BorrowAmount'];
        //จำนวนสินค้าที่คืน
        $Resrefuse = $resultBorrow['refuseAmount'] + $refuse;

        $resulttbborrow = $BorrowAmount - $refuse;
        $sql1 = "update tbborrow set BorrowAmount=:resulttbborrow,refuseAmount=:Resrefuse where BorrowId=:BorrowId";
        $query1 = $dbh->prepare($sql1);
        $query1->bindParam(':resulttbborrow', $resulttbborrow);
        $query1->bindParam(':Resrefuse', $Resrefuse);
        $query1->bindParam(':BorrowId', $BorrowId); 
        $query1->execute();

        //เพิ่มจำนวนกับไปยังสินค้าเดิม
        $resultTypePercel = $resultBorrow['typePercelAmount'] + $refuse;
        $TypePercelIdAuto = $resultBorrow['TypePercelIdAuto'];
        $sql2 = "update tbtypepercel set typePercelAmount=:resultTypePercel where TypePercelIdAuto=:TypePercelIdAuto";
        $query2 = $dbh->prepare($sql2);
        $query2->bindParam(':resultTypePercel', $resultTypePercel);
        $query2->bindParam(':TypePercelIdAuto', $TypePercelIdAuto); 
        $query2->execute();

        echo "<script>
        swal('สำเร็จ', 'ท่านได้ทำการคืนพัสดุเรียบร้อยแล้ว', 'success').then(
            function() {
              window.location.href = 'returnpercel.php';
            }
          );
        </script>";
    }
       
    }
   ?>


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
                        <p style="color:blue; text-align:center; font-size:16px;">ระบุจำนวนพัสดุที่ต้องการส่งคืน</p>
                        <div class="row">
                            <form style="margin-top:20px;" class="col s12 m12 l12" name="chngpwd" method="post">
                                <div class="row">

                                    <div class="input-field col l12 s12 m12">
                                        <input  disabled id="BorrowAmount" value="<?php echo $resultBorrow['BorrowAmount']; ?>" type="text" class="validate" autocomplete="off"  required>
                                        <label for="BorrowAmount">จำนวนพัสดุชิ้นนี้ที่ยืมมา</label>
                                    </div>
                                    <div class="input-field col l12 m12 s12" style="margin-top:30px;">
                                        <input id="refuse" type="text" value="<?php echo $resultBorrow['BorrowAmount']; ?>" class="validate" autocomplete="off" name="refuse" required>
                                        <label for="refuse">จำนวนที่ต้องการส่งคืน (หากส่งคืนครบทุกจำนวนกดปุ่ม คืนพัสดุได้เลย)</label>
                                    </div>


                                    <div class="input-field col s12 l12 m12">
                                        <button type="submit" name="add" class="waves-effect waves-light btn indigo m-b-xs">คืนพัสดุ</button>

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
