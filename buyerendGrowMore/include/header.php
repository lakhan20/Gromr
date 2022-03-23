<?php

include 'db_connect.php';

              if(empty( $_COOKIE["idRegister"] )){
                header("Location: index.php");
              }
              else{
                $id=$_COOKIE["idRegister"];
                $sql = "Select * from user where idRegister='$id'";
                $result = mysqli_query($conn,$sql);
                $num = mysqli_num_rows($result);
                
                if($num==1){
                  $row=mysqli_fetch_assoc($result);
            }
              }
	$sql1 = "SELECT * FROM wishlist where User_idRegister = $id";
	$result1 = mysqli_query($conn,$sql1);
    $num1 = mysqli_num_rows($result1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>GrowMore B2B Side</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +91 70000 00000</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> info.growmoreb2b@gmail.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> Navrangpura</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <?php
                    $sql2 = "SELECT is_seller FROM `user` WHERE user.idRegister = $_COOKIE[idRegister]";
                    $result2 = mysqli_query($conn,$sql2);
                    $row2= mysqli_fetch_assoc($result2);
                    if($row2 == 1)
                    {
                        echo'
                    <li><a href="#"> Seller </a></li>';
                    }
                    ?>
                    <li>
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-user-o"></i>
                                <span>My Account</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <ul class="abc">
                                    <li> <a class="dropdown-item" href="#">Your Profile</a></li><br>
                                    <li> <a class="dropdown-item" href="seller.php">Seller</a></li><br>
                                    <li> <a class="dropdown-item" href="order.php">Orders</a></li><br>
                                    <li> <a class="dropdown-item" href="#">Returns</a></li><br>
                                    <li> <a class="dropdown-item" href="logout.php">Log Out</a></li><br>
                                </ul>
                            </div>
                    </li>
                    <!-- <li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li> -->
                </ul>
            </div>

        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="website.php" class="logo">
                                <img src="./img/logo.png" alt="" width="80%">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <!-- <div class="header-search">
                            <form>
                                <input class="input" placeholder="Search here">
                                <button class="search-btn">Search</button>
                            </form>
                        </div> -->
                        <!--Search Form Drawer-->
                        <div class="search">
                            <div class="search__form">


                                <input type="text" class="form-control" name="live_search" id="live_search"
                                    autocomplete="off" placeholder="Search ...">

                                <button type="button" class="search-trigger close-btn"><i
                                        class="anm anm-times-l"></i></button>

                            </div>
                            /
                        </div>
                        <!--End Search Form Drawer-->
                        <!-- <div class="site-header__search"> -->

                        <!-- <button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button> -->
                        <!-- <input type="text" class="form-control" name="live_search" id="live_search" autocomplete="off" placeholder="Search ..."> -->

                        <!-- </div> -->

                        <script type="text/javascript">
                        $(document).ready(function() {
                            $("#live_search").keyup(function() {
                                var query = $(this).val();
                                if (query != "") {
                                    $.ajax({
                                        url: 'ajax-live-search.php',
                                        method: 'POST',
                                        data: {
                                            query: query
                                        },
                                        success: function(data) {
                                            $('#search_result').html(data);
                                            $('#search_result').css('display', 'block');
                                            $("#live_search").focusout(function() {
                                                $('#search_result').css('display',
                                                    'none');
                                            });
                                            $("#live_search").focusin(function() {
                                                $('#search_result').css('display',
                                                    'block');
                                            });
                                        }
                                    });
                                } else {
                                    $('#search_result').css('display', 'none');
                                }
                            });
                        });
                        </script>
                    </div>
                    <!-- /SEARCH BAR -->
                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <div>
                                <a href="wishlist.php">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Wishlist</span>
                                    <div class="qty"><?php echo $num1 ?></div>
                                </a>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <?php include "include/addtocart.php" ?>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <div id="search_result"></div>
    <!-- /HEADER -->