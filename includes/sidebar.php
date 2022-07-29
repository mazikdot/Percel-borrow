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
                            $sql = "SELECT FirstName,LastName,EmpId from  tblemployees where id=:eid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {               ?>
                                 <p><?php echo htmlentities($result->FirstName . " " . $result->LastName); ?></p>
                                 <span><?php echo htmlentities($result->EmpId) ?></span>
                         <?php }
                            } ?>
                     </div>
                 </div>
             </div>

             <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">

                 <li class="no-padding"><a class="waves-effect waves-grey" href="myprofile.php"><i class="material-icons">account_box</i>My Profiles</a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="listpercel.php"><i class="material-icons">settings_input_svideo</i>ยืมพัสดุ</a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="listhistory.php"><i class="material-icons">settings_input_svideo</i>สถานะการอนุมัติ</a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="returnpercel.php"><i class="material-icons">settings_input_svideo</i>รอส่งคืน</a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="returnpercel.php"><i class="material-icons">settings_input_svideo</i>ส่งคืนสำเร็จ</a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="emp-changepassword.php"><i class="material-icons">settings_input_svideo</i>Change Password</a></li>

                 



                 <li class="no-padding">
                     <a class="waves-effect waves-grey" onclick="return confirm('แน่ใจหรือไหมที่จะออกจากระบบ ?');" href="logout.php"><i class="material-icons">exit_to_app</i>Sign
                         Out</a>
                 </li>


             </ul>
         </div>
     </aside>