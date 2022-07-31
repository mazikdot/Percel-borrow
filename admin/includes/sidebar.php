    <aside id="slide-out" class="side-nav white fixed">
        <div class="side-nav-wrapper">
            <div class="center">
                <div class="sidebar-profile">
                    <div class="sidebar-profile-image">
                        <img src="../assets/images/profile-image.png" class="circle" alt="">
                    </div>
                    <div class="sidebar-profile-info">
                        <p>Admin</p>
                    </div>
                </div>
            </div>

            <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                <li class="no-padding"><a class="waves-effect waves-grey" href="dashboard.php"><i class="material-icons">settings_input_svideo</i>หน้าหลัก</a></li>
                <li class="no-padding">
                    <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">add</i>จัดการจำนวนพัสดุ<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="addamountpercel.php">เพิ่มลดจำนวนพัสดุ</a></li>
                        </ul>
                    </div>
                </li>
                <li class="no-padding">
                    <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">code</i>จัดการพัสดุ<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="addpercel.php">เพิ่มพัสดุ</a></li>
                            <li><a href="showpercel.php">รายการชื่อพัสดุ</a></li>
                            <li><a href="addtypepercel.php">เพิ่มประเภทพัสดุ</a></li>
                            <li><a href="showtypepercel.php">รายการประเภทพัสดุ</a></li>
                        </ul>
                    </div>
                </li>
                <li class="no-padding">
                    <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">account_box</i>จัดการพนักงาน<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="addemployee.php">เพิ่มรายชื่อพนักงาน</a></li>
                            <li><a href="manageemployee.php">รายชื่อพนักงานทั้งหมด</a></li>

                        </ul>
                    </div>
                </li>

                <li class="no-padding">
                    <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">desktop_windows</i>อนุมัติพัสดุ<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="approveall.php">รายการอนุมัติทั้งหมด</a></li>
                            <li><a href="waitapprove.php" style="color: blue">รอการอนุมัติ
                                    <?php

                                    //นับจำนวนสถานะรอการอนุมัติ
                                    $sqlCount1 = "SELECT COUNT(StatusBorrow) as StatusBorrow FROM tbborrow WHERE StatusBorrow = 1";
                                    $queryCount1 = $dbh->prepare($sqlCount1);
                                    $queryCount1->execute();
                                    $resultsCount1 = $queryCount1->fetch(PDO::FETCH_ASSOC);
                                    if ($resultsCount1['StatusBorrow'] > 0) { ?>
                                        <span style="border-radius: 50%; background-color:blue; color:white;" class="badge"><?php echo $resultsCount1['StatusBorrow']; ?></span>
                                    <?php }
                                    ?>
                                </a></li>
                            <li>

                                <a href="approve.php" style="color: green">อนุมัติการเบิก

                                    <?php

                                    //นับจำนวนสถานะผ่านการอนุมัติ
                                    $sqlCount2 = "SELECT COUNT(StatusBorrow) as StatusBorrow FROM tbborrow WHERE StatusBorrow = 2 AND BorrowAmount > 0";
                                    $queryCount2 = $dbh->prepare($sqlCount2);
                                    $queryCount2->execute();
                                    $resultsCount2 = $queryCount2->fetch(PDO::FETCH_ASSOC);
                                    if ($resultsCount2['StatusBorrow'] > 0) { ?>
                                        <span style="border-radius: 50%; background-color:green; color:white;" class="badge"><?php echo $resultsCount2['StatusBorrow']; ?></span>
                                    <?php } ?>
                                </a>

                            </li>
                            <li><a href="refuseborrow.php" style="color: red">ปฎิเสธการเบิก
                                    <?php

                                    //นับจำนวนสถานะปฎิเสธ
                                    $sqlCount3 = "SELECT COUNT(StatusBorrow) as StatusBorrow FROM tbborrow WHERE StatusBorrow = 3";
                                    $queryCount3 = $dbh->prepare($sqlCount3);
                                    $queryCount3->execute();
                                    $resultsCount3 = $queryCount3->fetch(PDO::FETCH_ASSOC);
                                    if ($resultsCount3['StatusBorrow'] > 0) { ?>
                                        <span style="border-radius: 50%; background-color:red; color:white;" class="badge"><?php echo $resultsCount3['StatusBorrow']; ?></span>
                                    <?php } ?>

                                </a></li>
                            <li><a href="editstatusall.php" style="color: white; background-color:#FF99FF;">แก้ไขสถานะการเบิก</a></li>

                        </ul>
                    </div>
                </li>

                <li class="no-padding">
                    <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">assignment_turned_in</i>สถานะยืม - คืน<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="waitpercel.php">รอการคืนพัสดุ
                                    <?php

                                    //นับจำนวนสถานะรอการอนุมัติ
                                    $sqlCount4 = "SELECT COUNT(StatusBorrow) as StatusBorrow FROM tbborrow WHERE StatusBorrow = 2 AND BorrowAmount > 0";
                                    $queryCount4 = $dbh->prepare($sqlCount4);
                                    $queryCount4->execute();
                                    $resultsCount4 = $queryCount4->fetch(PDO::FETCH_ASSOC);
                                    if ($resultsCount4['StatusBorrow'] > 0) { ?>
                                        <span style="border-radius: 50%; background-color:blue; color:white;" class="badge"><?php echo $resultsCount4['StatusBorrow']; ?></span>
                                    <?php }
                                    ?>

                                </a></li>
                            <li><a href="refusesuccess.php">คืนพัสดุสำเร็จ</a></li>

                        </ul>
                    </div>
                </li>
                <li class="no-padding">
                    <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">local_printshop</i>พิมพ์เอกสาร<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="printdoc.php">ข้อมูลการยืมพัสดุ
                                </a></li>
                        </ul>
                    </div>
                </li>


                <li class="no-padding">
                    <a class="waves-effect waves-grey" onclick="return confirm('แน่ใจหรือไหมที่จะออกจากระบบ ?');" href="logout.php"><i class="material-icons">exit_to_app</i>Sign Out</a>
                </li>




            </ul>
        </div>
    </aside>