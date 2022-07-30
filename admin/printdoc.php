<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<srcript src="https://code.jquery.com/jquery-3.6.0.min.js"></srcript>
<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>Admin | Total Leave </title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

        <link href="../assets/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css" />
        <!-- Theme Styles -->
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
                            <h5>พิมพ์เอกสาร</h5>
                            <p style="color:red;">สามารถพิมพ์เอกสารข้อมูลการยืมพัสดุ หรือ ดาวโหลดเป็นไฟล์ pdf </p>
                            <form method="post">
                                <button type="submit" name="stud_delete_multiple_btn" style="margin-top:20px;" class="btn btn-danger">พิมพ์รายการที่เลือก</a></button>
                            </button>
                            <div class="col s12 m12 l12" style="margin-top:25px;">
                            <input  type="checkbox" onclick="toggle(this);" /> พิมพ์รายการทั้งหมดให้ติ๊กตรงนี้แล้วกดปุ่มพิมพ์รายการที่เลือก <span style="color:red;">ถ้าจะเลือกแค่บางรายการให้ติ๊กในตารางแล้วกดปุ่มพิมพ์รายการที่เลือก</span>
                            </div>



                                <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="350">หน้างาน</th>
                                            <th width="350">พัสดุที่ยืม</th>
                                            <th width="180">วันที่ยืม - คืน</th>
                                            <th width="180">ข้อมูลผู้ยืม</th>
                                            <th width="100">จำนวนที่ยืม</th>
                                            <th width="100">สถานะ</th>
                                            <th width="100">พิมพ์เอกสาร</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $sql = "    SELECT a.BorrowId,a.Work1,a.Work2,a.BorrowAmount,a.BorrowRequest
                                ,a.BorrowReturn,a.Other,b.StatusBorrowName,c.TypePercelId,a.StatusBorrow,a.NoteBorrow,
                                e.FirstName,e.LastName,e.Phonenumber,a.TimeRequest,c.typePercelAmount
                                , c.TypePercelName,d.PercelName FROM tbborrow as a 
                                INNER JOIN tbstatusborrow as b ON a.StatusBorrow = b.StatusBorrow 
                                INNER JOIN tbtypepercel as c ON a.TypePercelIdAuto = c.TypePercelIdAuto 
                                INNER JOIN tbpercel as d ON d.PercelIdAuto = c.PercelIdAuto
                                INNER JOIN tblemployees as e ON a.id = e.id
                                WHERE b.StatusBorrowName = 'อนุมัติการเบิก'AND a.BorrowAmount > 0
                                ORDER BY a.StatusBorrow ASC
                                ";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                        $cnt = 1;
                                        $arrayAllPrint = [];
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {
                                                $arrayAllPrint = array($result['BorrowId']);
                                        ?>
                                                <tr>
                                                    <td> <b><?php echo htmlentities($cnt); ?></b></td>
                                                    <td> ยืมจากหน้างาน : <?php echo $result['Work1'];    ?>
                                                        ไปยังหน้างาน : <?php echo $result['Work2'];    ?>
                                                    </td>
                                                    <td><?php echo "{$result['TypePercelId']} {$result['PercelName']}";  ?> <?php echo "{$result['TypePercelName']}  " ?></td>
                                                    <td><?php echo "วันที่ยืม : {$result['BorrowRequest']} วันที่คืน : {$result['BorrowReturn']} ";  ?></td>
                                                    <td><?php echo "{$result['FirstName']} {$result['LastName']} เบอร์โทรศัพท์ : {$result['Phonenumber']}"; ?></td>
                                                    <td><?php echo $result['BorrowAmount']; ?></td>
                                                    <td>
                                                        <span style="color:red;">รอการคืน</span>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="print[]" value="<?= $result['BorrowId']; ?>">
                                                        เลือกพิมพ์
                                                    </td>
                                                </tr>
                                        <?php $cnt++;
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        </div>


        <?php
        //พิมพ์เฉพาะรายการที่เลือก
        if (isset($_POST['stud_delete_multiple_btn'])) {
            $res = $_POST['print'];
            $extract_id = implode(',', $res);
            if ($extract_id == "") {
                echo "<script>
                    swal('กรุณาเลือกข้อมูล', 'ท่านยังไม่ได้ทำการเลือกข้อมูลกรุณาเลือกข้อมูลที่ต้องการปริ้นก่อนกดปุ่มพิมพ์', 'warning').then(
                        function() {
                          window.location.href = 'printdoc.php';
                        }
                      );
                    </script>";
            } else {
                $_SESSION['multiple'] = $extract_id;
                echo "<script>window.location.href = 'printmultiple.php'</script>";
            }
        }

        if (isset($_POST['multipleprint'])) {
            $extract_id = implode(',', $arrayAllPrint);
            $_SESSION['multiple'] = $extract_id;
            // echo "<script>window.location.href='printmultiple.php'</script>";
        }
        ?>
        <div class="left-sidebar-hover"></div>



        <script>
            function toggle(source) {
                console.log('test');
                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] != source)
                        checkboxes[i].checked = source.checked;
                }
            }
        </script>


        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
        <script src="assets/js/pages/ui-modals.js"></script>
        <script src="assets/plugins/google-code-prettify/prettify.js"></script>

    </body>

    </html>
<?php } ?>