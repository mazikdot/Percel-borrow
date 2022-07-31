<?php
session_start();
include('includes/config.php');
if (isset($_POST['signin'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {
        echo '
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <srcript src="https://code.jquery.com/jquery-3.6.0.min.js"></srcript>
';
        echo "
  <script>
  swal('เกิดข้อผิดพลาดโปรดลองใหม่!','กดปุ่มเพื่อลองใหม่!','warning');
  </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>ระบบยืมคืนพัสดุออนไลน์</title>

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

    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

</head>

<button class="btn btn-primary" type="button"><a href="../index.php">
        <font color="FFFFFF">กลับสู่หน้าหลัก
    </a></font> </button>

<body class="signin-page">
    <div class="mn-content valign-wrapper">
        <main class="mn-inner container">
            <h4 align="center"><a>ระบบยืมคืนพัสดุ</a></h4>
            <div class="valign">
                <div class="row">
                    <div class="col s12 m6 l4 offset-l4 offset-m3">
                        <div class="card white darken-1">
                            <div class="card-content ">
                                <div style="text-align:center;">
                                <img width="40%" height="40%" src="../assets/images/icon-company.jpg" alt="Avatar">

                                </div>
                                <span style="text-align:center;" class="card-title">Sign In</span>
                                <div class="row">
                                    <form class="col s12" name="signin" method="post">
                                        <div class="input-field col s12">
                                            <input id="username" type="text" name="username" class="validate" autocomplete="off" required>
                                            <label for="email">Username</label>
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

    <!-- Javascripts -->
    <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="../assets/js/alpha.min.js"></script>

    <!-- font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap');
    </style>

</body>

</html>