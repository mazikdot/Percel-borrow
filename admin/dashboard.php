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
        <title>ระบบยืมคืนพัสดุ</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
        <link href="../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">


        <!-- Theme Styles -->
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
        <link rel="icon" type="image/png" href="assets/images/icon-company.jpg" />

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
        <link rel="icon" type="image/png" href="/assets/images/icon-company.jpg" />

    </head>

    <body>
        <div class="loader-bg"></div>
        <?php include('includes/header.php'); ?>

        <?php include('includes/sidebar.php'); ?>
        <!-- ดึงข้อมูล -->

        <?php

        $queryPercel = "SELECT * FROM tbpercel Order by PercelName ASC";
        $resultPercel = $dbh->prepare($queryPercel);
        $resultPercel->execute();


        ?>



        <main class="mn-inner">
            <h5 style="text-align:center;">รายงานจำนวนต่าง ๆ ในระบบ</h5>
            <div class="middle-content">
                <div class="row no-m-t no-m-b">
                    <div class="col s12 m12 l6">
                        <div class="card stats-card">
                            <div class="card-content">
                                
                                <span class="card-title">จำนวนพนักงานทั้งหมด</span>
                                <span class="stats-counter">
                                    <?php
                                    $sql = "SELECT id from tblemployees";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $empcount = $query->rowCount();
                                    ?>

                                    <span class="counter"><?php echo htmlentities($empcount); ?></span></span>
                            </div>
                            <div id="sparkline-bar"></div>
                        </div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="card stats-card">
                            <div class="card-content">
                                <?php
                                $sqlAmout = "SELECT SUM(typePercelAmount) as 'typePercelAmount'
                                FROM tbtypepercel";
                                $query1 = $dbh->prepare($sqlAmout);
                                $query1->execute();
                                $results = $query1->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <span class="card-title">จำนวนพัสดุทั้งหมดในระบบ</span>

                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($results['typePercelAmount']); ?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="card stats-card">
                            <div class="card-content">
                                <?php
                                $sqlBorrow = "SELECT SUM(BorrowAmount) as 'BorrowAmount'
                                FROM tbborrow";
                                $query2 = $dbh->prepare($sqlBorrow);
                                $query2->execute();
                                $results2 = $query2->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <span class="card-title">จำนวนพัสดุที่ทุกคนกำลังยืม</span>

                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($results2['BorrowAmount']); ?></span></span>

                            </div>
                            <div class="progress stats-card-progress">
                                <div class="determinate" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="card stats-card">
                            <div class="card-content">
                                <?php
                                $sqlStatusBorrow = "SELECT COUNT(StatusBorrow) as 'StatusBorrow'
                                FROM tbborrow WHERE StatusBorrow = 1";
                                $query3 = $dbh->prepare($sqlStatusBorrow);
                                $query3->execute();
                                $results3 = $query3->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <span class="card-title">จำนวนที่รอการอนุมัติทั้งหมด</span>

                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($results3['StatusBorrow']); ?></span></span>

                            </div>
                            <div class="progress stats-card-progress">
                                <div class="determinate" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="card stats-card">
                            <div class="card-content">
                                <?php
                                $sqlStatusBorrow1 = "SELECT COUNT(StatusBorrow) as 'StatusBorrow'
                                FROM tbborrow WHERE StatusBorrow = 2 AND BorrowAmount > 0";
                                $query4 = $dbh->prepare($sqlStatusBorrow1);
                                $query4->execute();
                                $results4 = $query4->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <span class="card-title">จำนวนที่ผ่านการอนุมัติทั้งหมด <br> (รอการคืนพัสดุ)</span>

                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($results4['StatusBorrow']); ?></span></span>

                            </div>
                            <div class="progress stats-card-progress">
                                <div class="determinate" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="card stats-card">
                            <div class="card-content">
                                <?php
                                $sqlStatusNot = "SELECT COUNT(StatusBorrow) as 'StatusBorrow'
                                FROM tbborrow WHERE StatusBorrow = 3";
                                $query5 = $dbh->prepare($sqlStatusNot);
                                $query5->execute();
                                $results5 = $query5->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <span class="card-title">จำนวนที่ปฎิเสธ</span>

                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($results5['StatusBorrow']); ?></span></span>

                            </div>
                            <div class="progress stats-card-progress">
                                <div class="determinate" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                </div>

               
            </div>

        </main>

        </div>


        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../assets/plugins/counter-up-master/jquery.counterup.min.js"></script>
        <script src="../assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="../assets/plugins/chart.js/chart.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="../assets/plugins/peity/jquery.peity.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/dashboard.js"></script>

    </body>

    </html>
<?php } ?>