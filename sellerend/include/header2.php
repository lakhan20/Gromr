<?php
include "connection.php";
?>
<head>
<style>
  .a{
   
    margin-left: 6px;
    float:left;
    
  }
  #f{
   background: #fff;
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   z-index: 999px;
   box-shadow: 0px 0px 6px 0px rgba(0, 0, 0, 0.5);
     }
  
</style>
<meta charset="utf-8">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title></title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- <div class="wrapper"> -->

  <header class="main-header" id="f">
    <!-- Logo -->
    <a href="home.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Seller</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Seller</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

              <?php


              if(empty( $_COOKIE["idRegister"] ) || $_COOKIE['isSeller']==0){
                header("Location: index.php");
              }

              else{
                // echo $_COOKIE['isSeller'];
                $id=$_COOKIE["idRegister"];
               

                
                $sql = "Select * from user where idRegister='$id'";
                $result = mysqli_query($conn,$sql);
                $num = mysqli_num_rows($result);
                
                if($num==1){
                  $row=mysqli_fetch_assoc($result);  
              
              echo '
              <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                  <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown">
      
              <span > Welcome ' .  $row["name"] .' ..!! </span>
              </a>
              ';
            
            }
              }
              ?>


            <ul class="dropdown-menu">
             
           
                  <!-- <small>Member since Nov. 2012</small> -->
              
              <!-- </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
              <div class="a">
                  <a href="bankDetails.php" class="btn btn-default btn-flat">Bank Details</a>
                </div>
                <div class="a">
                  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="a">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          <!-- </li> -->
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul> -->
      </div>
    </nav>
            </div>
  </header>
  