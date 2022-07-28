
<?php

session_start();
include('includes/config.php');
if (isset($_POST['signin'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT EmailId,Password,id FROM tblemployees WHERE EmailId=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname);
    $query->bindParam(':password', $password);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            // $status = $result->Status;
            $_SESSION['emplogin']=$_POST['username'];
            $_SESSION['eid'] = $result['id'];
           
        }
        echo "<script>window.location.href='myprofile.php'</script>";
    } else {
        echo '
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <srcript src="https://code.jquery.com/jquery-3.6.0.min.js"></srcript>
';
        echo "<script>
swal('รหัสผ่านไม่ถูกต้อง', 'โปรดตรวจสอบรหัสผ่านของท่านอีกครั้ง', 'warning').then(
    function() {
      window.location.href = 'index.php';
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
    <title>ระบบยืมคืนพัสดุ</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <meta name="description" content="Responsive Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />


    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css" />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


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

    <div class="loader-bg">

    </div>
    <div class="loader">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
            <div class="spinner-layer spinner-spinner-teal lighten-1">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="mn-content fixed-sidebar">
        <header class="mn-header navbar-fixed">
            <nav class="cyan darken-1">
                <div class="nav-wrapper row">
                    <section class="material-design-hamburger navigation-toggle">
                        <a href="#" data-activates="slide-out" class="button-collapse show-on-large material-design-hamburger__icon">
                            <span class="material-design-hamburger__layer"></span>
                        </a>
                    </section>
                    <div class="header-title col s8">
                        <span class="chapter-title">ระบบยืมคืนพัสดุ</span>
                    </div>


                    </form>


                </div>
            </nav>
        </header>


        <aside id="slide-out" class="side-nav white fixed">
            <div class="side-nav-wrapper">
                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion" style="">
                    <div class="center">
                        <img width="50%;" height="50%" src="assets/images/icon-company.jpg" class="circle" alt="">
                    </div><br>
                    <li class="no-padding"><a class="waves-effect waves-grey" href="index.php"><i class="material-icons">account_box</i>เข้าสู่ระบบพนักงาน</a></li>
                    <li class="no-padding"><a class="waves-effect waves-grey" href="forgot-password.php"><i class="material-icons">account_box</i>ลืมรหัสผ่าน</a></li>

                    <li class="no-padding"><a class="waves-effect waves-grey" href="admin/"><i class="material-icons">account_box</i>เข้าสู่ระบบผู้ดูแล</a></li>

                </ul>
            </div>
        </aside>

        <main class="mn-inner">
            <br><br><br><br>
            <div class="center">
                <div class="col s12">
                    <div>
                        <h4>ระบบยืมคืสพัสดุ</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l8 offset-l2 offset-m3">
                    <div class="card white darken-1">

                        <div class="card-content ">
                            <div class="center">
                                <span class="card-title" style="font-size:20px;">กรุณาล็อกอินเพื่อเข้าสู่ระบบ ยืม-คืน พัสดุ</span>
                            </div>
                         
                            <div class="row">
                                <form class="col s12" name="signin" method="post">
                                    <div class="input-field col s12"><input id="username" type="text" name="username" class="validate" autocomplete="off" required>
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="password" type="password" class="validate" name="password" autocomplete="off" required>
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="col s12 right-align m-t-sm">

                                        <input type="submit" name="signin" value="Sign in" class="waves-effect waves-light btn teal">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>

    </div>
    <div class="left-sidebar-hover"></div>

    <!-- Javascripts -->
    <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="assets/js/alpha.min.js"></script>


</body>
<!-- sadsad -->

</html>