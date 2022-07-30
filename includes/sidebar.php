     <aside id="slide-out" class="side-nav white fixed">
         <div class="side-nav-wrapper">
             <div class="center">
                 <div class="sidebar-profile">

                     <div class="sidebar-profile-image">
                         <img src="assets/images/icon-company.jpg" class="circle" alt="">
                     </div>

                     <div class="sidebar-profile-info">
                         <?php
                            $eid = $_SESSION['eid'];
                            $sql = "SELECT FirstName,LastName from  tblemployees where id=:eid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {               ?>
                                 <p><?php echo htmlentities($result->FirstName . " " . $result->LastName); ?></p>
                         <?php }
                            } ?>
                     </div>
                 </div>
             </div>

             <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">

                 <li class="no-padding"><a class="waves-effect waves-grey" href="myprofile.php"><i class="material-icons">account_box</i>My Profiles</a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="listpercel.php"><i class="material-icons">settings_input_svideo</i>ยืมพัสดุ</a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="listhistory.php"><i class="material-icons">settings_input_svideo</i>สถานะการอนุมัติ
                 <?php
                            //นับจำนวนสถานะรอการอนุมัติ
                            $id=$_SESSION['eid'];
                            $sqlCount2 = "SELECT COUNT(StatusBorrow) as StatusBorrow FROM tbborrow WHERE StatusBorrow = 1 AND BorrowAmount > 0 AND id=:id";
                            $queryCount2 = $dbh->prepare($sqlCount2);
                            $queryCount2->bindParam(':id', $id);
                            $queryCount2->execute();
                            $resultsCount2 = $queryCount2->fetch(PDO::FETCH_ASSOC);
                            if ($resultsCount2['StatusBorrow'] > 0) { ?>
                             <span style="border-radius: 50%; background-color:burlywood; color:white;" class="badge"><?php echo $resultsCount2['StatusBorrow']; ?></span>
                         <?php }
                            ?>

                </a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="returnpercel.php"><i class="material-icons">settings_input_svideo</i>รอส่งคืน
                         <?php
                            //นับจำนวนสถานะรอการอนุมัติ
                            $sqlCount1 = "SELECT COUNT(StatusBorrow) as StatusBorrow FROM tbborrow WHERE StatusBorrow = 2 AND BorrowAmount > 0 AND id=:id";
                            $queryCount1 = $dbh->prepare($sqlCount1);
                            $queryCount1->bindParam(':id', $id);
                            $queryCount1->execute();
                            $resultsCount1 = $queryCount1->fetch(PDO::FETCH_ASSOC);
                            if ($resultsCount1['StatusBorrow'] > 0) { ?>
                             <span style="border-radius: 50%; background-color:red; color:white;" class="badge"><?php echo $resultsCount1['StatusBorrow']; ?></span>
                         <?php }
                            ?>

                     </a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="returnpercellsuccess.php"><i class="material-icons">settings_input_svideo</i>ส่งคืนสำเร็จ</a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="emp-changepassword.php"><i class="material-icons">settings_input_svideo</i>Change Password</a></li>





                 <li class="no-padding">
                     <a class="waves-effect waves-grey" onclick="return confirm('แน่ใจหรือไหมที่จะออกจากระบบ ?');" href="logout.php"><i class="material-icons">exit_to_app</i>Sign
                         Out</a>
                 </li>


             </ul>
         </div>
     </aside>