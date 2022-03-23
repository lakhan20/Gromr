<?php
include "include/connection.php";
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin| Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="index.php"><b>Admin</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your Admin</p>
            <form method="POST">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="u_email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="u_password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit" id="submit">Sign
                            In</button>
                    </div>
                </div>
            </form>
            <?php
             if(isset($_POST['submit']))
             { 
              $u_email = $_POST['u_email'];
              $u_password = $_POST['u_password'];
              $login_select = "SELECT * FROM `admin` WHERE email_id='$u_email' AND pass='$u_password'";
              $result_login_select = mysqli_query($conn, $login_select);
            
              if (mysqli_num_rows($result_login_select) > 0)
              {
                $row = mysqli_fetch_assoc($result_login_select);
                setcookie("idadmin",$row['idadmin'],time() + 84600,"/");
                
                // $_SESSION["u_id"] = $row['idadmin'];
                // $_SESSION["u_name"] = $row['first_name'];
                // $_SESSION["u_email"] = $row['email_id'];
                // $_SESSION["u_surname"] = $row['last_name'];
                //$_SESSION["u_contact"] = $row['u_contact'];
               //$_SESSION["u_image"] = $row['image'];
                //$_SESSION["isadmin"] = $row['isadmin'];
                
                
                header("Location: home.php");
                
              }
              else
              {
                
                header("Location: index.php");
                
              }
            }
          ?>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
    </script>
</body>

</html>