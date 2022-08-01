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
        <title>Admin | Show Percel</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
        <!-- <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">


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
        <link rel="icon" type="image/png" href="../assets/images/icon-company.jpg" />
    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <?php include('includes/sidebar.php'); ?>
        <main class="mn-inner">
            <div class="row">


                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <h5 style="text-align:center;">เพิ่ม - ลด จำนวนพัสดุ</h5>
                            <p style="margin-bottom:20px;">
                            จำนวนพัสดุแต่ละประเภท จะถูกลดลงโดยอัตโนมัติเมื่อมีการยืมพัสดุ และหน้านี้จะเป็นหน้าพัสดุที่พร้อมใช้งานสามารถทำการ เพิ่ม - ลด จำนวนพัสดุ ได้ให้ตรงตามความต้องการ 
                            </p>
                            <table id="example" class="display responsive-table">
                                <thead>
                                    <tr>
                                        <th>รหัส</th>
                                        <th>พัสดุ</th>
                                        <th>ประเภท</th>
                                        <th>จำนวน</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $sql = "SELECT a.typePercelAmount,a.TypePercelName,a.TypePercelIdAuto,a.TypePercelId,b.PercelName FROM tbtypepercel as a INNER JOIN tbpercel as b ON a.PercelIdAuto = b.PercelIdAuto;";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {               ?>
                                            <tr>
                                                <td> <?php echo htmlentities($result->TypePercelId); ?></td>
                                                <td><?php echo htmlentities($result->PercelName); ?></td>
                                                <td><?php echo htmlentities($result->TypePercelName); ?></td>
                                                <td><?php echo htmlentities($result->typePercelAmount); ?></td>
                                                <td>
                                                    <a href="updateAmount.php?id=<?php echo $result->TypePercelIdAuto;  ?>"><i class="material-icons">mode_edit</i></a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } ?>
                                </tbody>
                            </table>
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
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>


        <script>
            deleteTypePercel = (id) => {
                console.log(id);
                swal({
                    title: "คุณต้องการลบข้อมูลนี้ ใช่หรือไม่",
                    text: "หากทำการลบข้อมูลบัญชีนี้จะหายไปจากระบบ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "GET",
                            url: "deleteTypePercel.php",
                            data: {
                                deleteId: id
                            },
                            dataType: "html",
                            success: function() {
                                swal('สำเร็จ', 'ท่านได้ลบข้อมูลเรียบร้อยแล้ว', 'success').then(
                                    function() {
                                        window.location.href = 'showtypepercel.php';
                                    }
                                );
                            }
                        })
                    } else {

                    }


                });
            }
        </script>
    </body>

    </html>
<?php } ?>