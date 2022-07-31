<?php
// include('includes/config.php');
session_start();
include('includes/config.php');
if (isset($_SESSION['multiple'])) {
    // $sell_id = $_SESSION['multiple'];
    // $sql2 = "SELECT (sum_teacher) as 'total' FROM (
    //     SELECT sum(sell_amount*sell_price) as sum_teacher FROM sell_phone  WHERE sell_id IN ({$sell_id})) sum_tea;";
    // $sql = "SELECT * FROM sell_phone WHERE sell_id IN ({$sell_id});";
    // $res = $conn->query($sql);
    // $res2 = $conn->query($sql2);
    // $row = $res->fetch_assoc();
    // $row2 = $res2->fetch_assoc();
    // while($eiei = $res-> fetch_assoc()){
    //     echo $eiei['sell_name'];
    // }
    $id = $_SESSION['multiple'];
    $sql = "    SELECT a.BorrowId,a.Work1,a.Work2,a.BorrowAmount,a.BorrowRequest
        ,a.BorrowReturn,a.Other,b.StatusBorrowName,c.TypePercelId,a.StatusBorrow,a.NoteBorrow,
        e.FirstName,e.LastName,e.Phonenumber,a.TimeRequest,c.typePercelAmount
        , c.TypePercelName,d.PercelName FROM tbborrow as a 
    INNER JOIN tbstatusborrow as b ON a.StatusBorrow = b.StatusBorrow 
    INNER JOIN tbtypepercel as c ON a.TypePercelIdAuto = c.TypePercelIdAuto 
        INNER JOIN tbpercel as d ON d.PercelIdAuto = c.PercelIdAuto
        INNER JOIN tblemployees as e ON a.id = e.id
            WHERE BorrowId IN ({$id})
            ORDER BY a.StatusBorrow ASC
                                ";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id);
    $query->execute();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <link rel="stylesheet" href="css/print.css" media="print">
    <link rel="stylesheet" href="css/style.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Sarabun', sans-serif;
        }

        th {
            font-family: 'Sarabun', sans-serif;
            padding: 5px;
            text-align: center;

        }

        td {
            font-family: 'Sarabun', sans-serif;
            padding: 5px;
            text-align: left;
            font-size: 14px;

        }

        @page {
            margin: 0;
            size: A4;
        }
        body {
            font-family: 'Kanit', sans-serif;
            background: #ffffff;
            color: #34495e;
        }

        #print {
            
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet" />
</head>

<body onload="window.print()">
    <!-- <div class="center">
        <button id="print" onclick="window.print()">ดาวโหลด หรือ พิมพ์เอกสาร</button>
    </div> -->
    <div class="container">
        <header>
            <br><br><br>
            <h2>ข้อมูลการยืมพัสดุ</h2>
            <br><br>
            <img src="../assets/images/icon-company.jpg" alt="Avatar" style="width:100px">
            <br><br><br>
        </header>
        <section>

            <table style="width:85%">
                <thead>
                    <tr>
                        <th>รหัส</th>
                        <th>รายการ</th>
                        <th>จำนวนที่ยืม</th>
                        <th>ผู้ยืม</th>
                        <th>เบอร์โทร</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($query as $rows) {
                    ?>
                        <tr>
                            <td style="text-align: center;" class="price"><?php echo $rows['TypePercelId']; ?></td>
                            <td style="text-align: center;"><?php echo "{$rows['TypePercelId']} {$rows['TypePercelName']}"; ?></td>
                            <td style="text-align: center;" class="price"><?php echo $rows['BorrowAmount'] ?></td>
                            <td style="text-align: center;" class="price"><?php echo "{$rows['FirstName']} {$rows['LastName']}"; ?></td>
                            <td style="text-align: center;" class="price"><?php echo $rows['Phonenumber'] ?></td>
                        <?php

                    }
                        ?>
                        </tr>


                </tbody>
            </table>

        </section>
    </div>
</body>

</html>