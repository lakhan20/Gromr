<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?>
<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <!-- ./col -->
            <div class="col-lg-4 col-xs-8">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php
                            $sql = "SELECT * FROM `product`";
                            $result = mysqli_query($conn,$sql);
                            $num = mysqli_num_rows($result);
                            echo $num;
                          ?></h3>
                        <p>PRODUCT</p>
                    </div>
                    <div class="icon">
                        <i class="ion-tshirt"></i>
                    </div>
                    <a href="product.php" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xs-8">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?php
                            $sql = "SELECT * FROM `category`";
                            $result = mysqli_query($conn,$sql);
                            $num = mysqli_num_rows($result);
                            echo $num;
                          ?></h3>
                        <p>CATEGORY</p>
                    </div>
                    <div class="icon">
                        <i class="glyphicon glyphicon-th-large"></i>
                    </div>
                    <a href="category.php" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php
                            $sql = "SELECT * FROM `subcategory`";
                            $result = mysqli_query($conn,$sql);
                            $num = mysqli_num_rows($result);
                            echo $num;
                            ?></h3>
                        <p>SUBCATEGORY</p>
                    </div>
                    <div class="icon">
                        <i class="glyphicon glyphicon-th"></i>
                    </div>
                    <a href="sub_cat.php" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-8">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php
                             $sql = "SELECT * FROM `sales_orders`";
                             $result = mysqli_query($conn,$sql);
                             $num = mysqli_num_rows($result);
                             echo $num;
                          ?>
                        </h3>
                        <p>ORDER</p>
                    </div>
                    <div class="icon">
                        <i class="ion-locked"></i>
                    </div>
                    <a href="order.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php
                            $sql = "SELECT * FROM `user`";
                            $result = mysqli_query($conn,$sql);
                            $num = mysqli_num_rows($result);
                            echo $num;
                            ?></h3>
                        <p>USERS</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="user.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-8">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php
                             $sql = "SELECT * FROM user WHERE is_request=1 AND is_seller=0;
                             ";
                             $result = mysqli_query($conn,$sql);
                             $num = mysqli_num_rows($result);
                             echo $num;
                          ?>
                        </h3>
                        <p>REQUEST</p>
                    </div>
                    <div class="icon">
                        <i class="ion-person-add"></i>
                    </div>
                    <a href="requests.php" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
        </div>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
</div>
<?php
  include "include/footer.php"
  ?>