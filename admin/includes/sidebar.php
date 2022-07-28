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
                     <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">apps</i>จัดการจำนวนพัสดุ<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
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
                     <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">desktop_windows</i>รายการลาพนักงาน<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                     <div class="collapsible-body">
                         <ul>
                             <li><a href="leaves.php">รายการลาพนักงานทั้งหมด</a></li>
                             <li><a href="pending-leavehistory.php" style="color: blue">รอการดำเนินการ</a></li>
                             <li><a href="approvedleave-history.php" style="color: green">รายการที่อนุมัติ</a></li>
                             <li><a href="notapproved-leaves.php" style="color: red">รายการที่ไม่อนุมัติ</a></li>

                         </ul>
                     </div>
                 </li>




                 <li class="no-padding">
                     <a class="waves-effect waves-grey" onclick="return confirm('แน่ใจหรือไหมที่จะออกจากระบบ ?');" href="logout.php"><i class="material-icons">exit_to_app</i>Sign Out</a>
                 </li>




             </ul>
         </div>
     </aside>